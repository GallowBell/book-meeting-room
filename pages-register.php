<?php
include 'connection.php'; // รวมไฟล์ที่ใช้สำหรับเชื่อมต่อฐานข้อมูล

// รับข้อมูลจากฟอร์ม
$username = $_POST['username'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$number_phone = $_POST['number_phone'];

// ตรวจสอบว่าชื่อผู้ใช้ซ้ำกันหรือไม่
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // หากมีชื่อผู้ใช้อยู่แล้ว
    echo "ชื่อผู้ใช้นี้มีอยู่แล้ว";
} else {
    // แปลงรหัสผ่านเป็นแฮชเพื่อความปลอดภัย
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // เพิ่มผู้ใช้ใหม่ลงในฐานข้อมูล
    $sql = "INSERT INTO users (username, password_hash, first_name, last_name, number_phone) 
            VALUES ('$username', '$password_hash', '$first_name', '$last_name', '$number_phone')";
    if ($mysqli->query($sql) === TRUE) {
        echo "สมัครสมาชิกสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาด: " . $mysqli->error;
    }
}

$mysqli->close(); // ปิดการเชื่อมต่อฐานข้อมูล
?>
