<?php
include 'connection.php'; // รวมไฟล์ที่ใช้สำหรับเชื่อมต่อฐานข้อมูล

if (isset($_POST['submit'])) {
        // รับข้อมูลจากฟอร์ม
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];

    // ตรวจสอบว่าชื่อผู้ใช้ซ้ำกันหรือไม่
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = $mysqli->query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user['username'] === $username) {
        echo "<script>alert('ชื่อผู้ใช้นี้มีอยู่แล้ว');</script>";
    } else {
        $passwordenc = md5($password);

        $query = "INSERT INTO user (username, password, first_name, last_name, phone_number, userlevel)
            VALUES ('$username', '$password', '$first_name', '$last_name', '$phone_number', 'm')";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['success'] = "เพิ่มข้อมูลสําเร็จ";
            header("location: index.php");
        } else {
            $_SESSION['error'] = "เพิ่มข้อมูลไม่สําเร็จ";
            header("location: index.php");
        }
        }
    }
?>
