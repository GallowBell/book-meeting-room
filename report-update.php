<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* $reservation_id = $_POST['reservation_id'];
    $meeting_name = $_POST['meeting_name'];
    $meeting_room = $_POST['meeting_room'];
    $organizer_name = $_POST['organizer_name'];
    $reservation_date = $_POST['reservation_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $notes = $_POST['notes']; */

    $reservation_id = $_POST['reservation_id']; 
    $government_sector = $_POST['government_sector']; 
    $contact_number = $_POST['contact_number']; 
    $meeting_name = $_POST['meeting_name']; 
    $document_number = $_POST['document_number']; 
    $meeting_room = $_POST['meeting_room'];  
    $meeting_type = $_POST['meeting_type']; 
    $participant_count = $_POST['participant_count']; 
    $organizer_name = $_POST['organizer_name'];  
    $reservation_date = $_POST['reservation_date']; 
    $reservation_date_end = $_POST['reservation_date_end']; 
    $start_time = $_POST['start_time']; 
    $end_time = $_POST['end_time']; 
    $notes = $_POST['notes']; 

    // เชื่อมต่อกับฐานข้อมูล
    include 'connection.php';
    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ตรวจสอบการจองซ้อนทับ
    $sql_check = "SELECT * FROM reservations 
    WHERE meeting_room = '$meeting_room' 
    AND (
        (reservation_date <= '$reservation_date_end' AND reservation_date_end >= '$reservation_date') 
        AND ((start_time <= '$end_time' AND end_time >= '$start_time'))
    ) AND is_approve = 1";

    $result = $conn->query($sql_check);
    //echo "row".$result->num_rows;
    if ($result->num_rows > 0) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
        window.onload = function() {
            Swal.fire({
                title: 'มีบางอย่างผิดพลาด',
                text: 'ไม่สามารถจองวัน/เวลา ทับซ้อนได้ หรือสถานะเป็นอนุมัติอยู่',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'booking-report.php';
                }
            });
        };
    </script>";
        return;
    }

    

    // เตรียมและรันคำสั่ง SQL
    $stmt = $conn->prepare("UPDATE reservations SET 
        government_sector = ?,
        contact_number = ?,
        meeting_name = ?,
        document_number = ?,
        meeting_room = ?,
        meeting_type = ?,
        participant_count = ?,
        organizer_name = ?,
        reservation_date = ?,
        reservation_date_end = ?,
        start_time = ?,
        end_time = ?,
        notes = ?
    WHERE reservation_id=?");
   
    $stmt->bind_param('ssssssssssssss', 
        $government_sector,
        $contact_number,
        $meeting_name,
        $document_number,
        $meeting_room,
        $meeting_type,
        $participant_count,
        $organizer_name,
        $reservation_date,
        $reservation_date_end,
        $start_time,
        $end_time,
        $notes,
        $reservation_id
    );
    $result = $stmt->execute();
    if ($stmt->execute()) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'แก้ไขสำเร็จ !',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'booking-report.php';
                    }
                });
            };
        </script>";


    } else {
        echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'มีบางอย่างผิดพลาด',
                    text: 'ไม่สามารถแก้ไขได้ !',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'booking-report.php';
                    }
                });
            };
        </script>" . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
