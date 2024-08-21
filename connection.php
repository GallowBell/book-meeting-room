<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meeting_reservation";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ฟังก์ชันสำหรับปิดการเชื่อมต่อ
function closeConnection($conn) {
    $conn->close();
}

?>
