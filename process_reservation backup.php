<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meeting_booking";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

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
$reservation_date = $_POST['reservation_date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$equipment = isset($_POST['equipment']) ? $_POST['equipment'] : [];
$equipment_qty = isset($_POST['equipment_qty']) ? $_POST['equipment_qty'] : [];
$notes = $_POST['notes'];

// รวมอุปกรณ์และจำนวนเข้าด้วยกัน
$equipment_list = [];
for ($i = 0; $i < count($equipment); $i++) {
    $qty = !empty($equipment_qty[$i]) ? $equipment_qty[$i] : 0;
    if ($qty > 0) {
        $equipment_list[] = $equipment[$i] . ": " . $qty;
    }
}
$equipment_str = implode(', ', $equipment_list);

// ตรวจสอบการจองซ้อนทับ
$sql_check = "SELECT * FROM reservations WHERE meeting_room = '$meeting_room' AND reservation_date = '$reservation_date' 
              AND ((start_time < '$end_time' AND end_time > '$start_time'))";

$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    echo "ไม่สามารถจองได้เนื่องจากเวลาที่คุณเลือกทับซ้อนกับการจองอื่นแล้ว.";
} else {
    // ถ้าไม่มีการจองซ้อนทับ ให้บันทึกการจองใหม่
    $sql_insert = "INSERT INTO reservations (meeting_room, meeting_name, meeting_type, participant_count, organizer_name, contact_number, reservation_date, start_time, end_time, equipment, notes)
    VALUES ('$meeting_room', '$meeting_name', '$meeting_type', $participant_count, '$organizer_name', '$contact_number', '$reservation_date', '$start_time', '$end_time', '$equipment_str', '$notes')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "การจองห้องประชุมสำเร็จ!";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

$conn->close();
?>
