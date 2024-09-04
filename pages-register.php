<?php
include 'connection.php';

//echo $password = password_hash($_GET['password'], PASSWORD_DEFAULT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // เข้ารหัสผ่าน
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $userlevel = "user"; // ค่าเริ่มต้นคือ user

    // ตรวจสอบว่ามี username ซ้ำหรือไม่
    $sql_check = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Username นี้ถูกใช้แล้ว');
                window.location.href = 'pages-register.html';
              </script>";
    } else {
        // เพิ่มข้อมูลผู้ใช้ใหม่
        $sql = "INSERT INTO user (username, password, first_name, last_name, phone_number, userlevel)
                VALUES ('$username', '$password', '$first_name', '$last_name', '$phone_number', '$userlevel')";

        if ($conn->query($sql) === TRUE) {
            echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Redirecting</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: "ลงทะเบียนสำเร็จ",
                        text: "กรุณาเข้าสู่ระบบ",
                        icon: "success",
                        confirmButtonText: "ตกลง"
                    }).then(function() {
                        window.location.href = "pages-login.html";
                    });
                });
            </script>
        </head>
        <body>
        </body>
        </html>';
        } else {
            echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Redirecting</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: "มีบางอย่างผิดพลาด",
                        icon: "success",
                        confirmButtonText: "ตกลง"
                    }).then(function() {
                        window.location.href = "pages-register.html";
                    });
                });
            </script>
        </head>
        <body>
        </body>
        </html>';
        }
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $conn->close();
}
?>
