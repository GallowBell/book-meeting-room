<?php
session_start(); // เริ่มเซสชัน

include 'connection.php'; // รวมไฟล์ที่ใช้สำหรับเชื่อมต่อฐานข้อมูล

// รับข้อมูลจากฟอร์ม
$username = $_POST['username'];
$password = $_POST['password'];

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $mysqli->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // ตรวจสอบรหัสผ่าน
    if (password_verify($password, $user['password_hash'])) {
        // ตั้งค่าเซสชัน
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        // ย้ายไปยังหน้าเว็บหลักหรือหน้าอื่น ๆ
        header("Location: index.php"); // เปลี่ยนเป็นหน้าเว็บหลักของคุณ
        exit();
    } else {
        echo "รหัสผ่านไม่ถูกต้อง";
    }
} else {
    echo "ไม่พบผู้ใช้";
}

$mysqli->close(); // ปิดการเชื่อมต่อฐานข้อมูล
?>
