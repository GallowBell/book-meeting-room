<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);   

$servername = "localhost";
$username = "xdarkpro_meeting_reservation";
$password = "JCW5eXFX78s93RsNaLfH";
$dbname = "xdarkpro_meeting_reservation";

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
