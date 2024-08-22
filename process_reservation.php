<?php

include 'connection.php';

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$meeting_room = $_POST['meeting_room'];
$meeting_name = $_POST['meeting_name'];
$meeting_type = $_POST['meeting_type'];
$participant_count = $_POST['participant_count'];
$organizer_name = $_POST['organizer_name'];
$contact_number = $_POST['contact_number'];
$r_date = explode(" ถึง ", $_POST['reservation_date']);
$reservation_date = $r_date[0];
/**
 * เอาไปใส่ database วันที่สิ้นสุด
 * @var string $reservation_date_end
 */
$reservation_date_end = $r_date[1];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$equipment = isset($_POST['equipment']) ? $_POST['equipment'] : [];
$equipment_qty = isset($_POST['equipment_qty']) ? $_POST['equipment_qty'] : [];
$equipment_details = isset($_POST['equipment_details']) ? $_POST['equipment_details'] : [];
$equipment_size = isset($_POST['equipment_size']) ? $_POST['equipment_size'] : [];
$equipment_dates = isset($_POST['equipment_date']) ? $_POST['equipment_date'] : [];
$equipment_start_times = isset($_POST['equipment_start_time']) ? $_POST['equipment_start_time'] : [];
$equipment_end_times = isset($_POST['equipment_end_time']) ? $_POST['equipment_end_time'] : [];
$notes = $_POST['notes'];
$equipment_size_1 = isset($_POST['equipment_size_1']) ? $_POST['equipment_size_1'] : "";
$equipment_size_2 = isset($_POST['equipment_size_2']) ? $_POST['equipment_size_2'] : "";

function InsertCar($equipment_qty = [], $equipment = '')
{
    global $conn,
        $eq_date,
        $eq_start_time,
        $eq_end_time,
        $reservation_date_end,
        $reservation_id;

    $r = [];
    foreach ($equipment_qty as $key => $value) {

        if ($key == 'floor') {
            $equipment = 'ที่จอดรถชั้น';
        }
        if ($key == 'qty') {
            $equipment = 'จำนวนคัน';
        }
        if ($key == 'car_no') {
            $equipment = 'เลขทะเบียนรถ';
        }

        if ($value > 0  /*|| !empty($details) ||  !empty($size)*/) {
            $equipment_full_name = $equipment;
            $sql_insert_equipment = "INSERT INTO equipment_reservations (
                                                                        reservation_id,
                                                                        equipment_name,
                                                                        equipment_size,
                                                                        equipment_quantity,
                                                                        additional_details,
                                                                        reservation_date,
                                                                        reservation_date_end,
                                                                        start_time,
                                                                        end_time
                                                                )  VALUES (
                                                                    $reservation_id,
                                                                    '$equipment_full_name',
                                                                    '',
                                                                    '$value',
                                                                    '',
                                                                    '$eq_date',
                                                                    '$reservation_date_end',
                                                                    '$eq_start_time',
                                                                    '$eq_end_time')";

            $conn->query($sql_insert_equipment);
            $r[] = $sql_insert_equipment;
        }
    }
    //echo json_encode($r);
}

// ตรวจสอบการจองซ้อนทับ
$sql_check = "SELECT * FROM reservations 
              WHERE meeting_room = '$meeting_room' 
              AND (
                  (reservation_date <= '$reservation_date_end' AND reservation_date_end >= '$reservation_date') 
                  AND ((start_time <= '$end_time' AND end_time >= '$start_time'))
              )";

$result = $conn->query($sql_check);
//echo "row".$result->num_rows;
if ($result->num_rows > 0) {
    echo "<script>
            window.onload = function() {
                alert('ไม่สามารถจองได้เนื่องจากเวลาที่คุณเลือกทับซ้อนกับการจองอื่นแล้ว.');
                window.location.href = 'booking.php';
            };
          </script>";
} else {
    // ถ้าไม่มีการจองซ้อนทับ ให้บันทึกการจองใหม่ในตาราง reservations
    $sql_insert = "INSERT INTO reservations (
                                            meeting_room,
                                            meeting_name,
                                            meeting_type,
                                            participant_count,
                                            organizer_name,
                                            contact_number,
                                            reservation_date,
                                            reservation_date_end,
                                            start_time,
                                            end_time,
                                            notes
                                        ) VALUES (
                                            '$meeting_room',
                                            '$meeting_name',
                                            '$meeting_type',
                                            $participant_count,
                                            '$organizer_name',
                                            '$contact_number',
                                            '$reservation_date',
                                            '$reservation_date_end',
                                            '$start_time',
                                            '$end_time',
                                            '$notes'
                                        )";


    if ($conn->query($sql_insert) === TRUE) {
        $success = true; // การจองสำเร็จ

        // รับค่า reservation_id ของการจองที่เพิ่งบันทึก
        $reservation_id = $conn->insert_id;


        // Ensure that all arrays have the same count
        $equipmentCount = count($equipment);

        // Iterate over the arrays using foreach
        foreach ($equipment as $i => $equipment_name) {
            $size = "";

            // Check if the current index is 15
            if ($i == 15) {
                // Output equipment quantity as JSON and exit
                InsertCar($equipment_qty[$i], $equipment[$i]);
                continue;
            }

            // Retrieve other details, ensuring they are properly set
            $qty = !empty($equipment_qty[$i]) ? $equipment_qty[$i] : 0;
            $details = !empty($equipment_details[$i]) ? $equipment_details[$i] : '';

            // Determine the size based on equipment type
            $size =  ($equipment_name == "จานแก้วใส" || $equipment_name == "ถ้วย") ? $equipment_size_1 : ($equipment_name == "ถ้วย" ? $equipment_size_2 : '');

            // Default values if not set
            $eq_date = !empty($equipment_dates[$i]) ? $equipment_dates[$i] : $reservation_date;
            $eq_start_time = !empty($equipment_start_times[$i]) ? $equipment_start_times[$i] : $start_time;
            $eq_end_time = !empty($equipment_end_times[$i]) ? $equipment_end_times[$i] : $end_time;

            // Insert into database if quantity is greater than 0
            if ($qty > 0 || $i == 16) {
                $equipment_full_name = $equipment_name;
                $sql_insert_equipment = "INSERT INTO equipment_reservations (reservation_id, equipment_name, equipment_size, equipment_quantity, additional_details, reservation_date, reservation_date_end, start_time, end_time)
                                        VALUES ($reservation_id, '$equipment_full_name', '$size', $qty, '$details', '$eq_date', '$reservation_date_end', '$eq_start_time', '$eq_end_time')";
                $conn->query($sql_insert_equipment);
            }
        }

        echo "<script>
        window.onload = function() {
            alert('การจองห้องประชุมสำเร็จ!');
            window.location.href = 'index.php';
        };
      </script>";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }

    //echo json_encode($_POST);
}

$conn->close();
