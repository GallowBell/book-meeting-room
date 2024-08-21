<?php
include 'connection.php';

//เรียกใช้งาน sweetalert 
echo '
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  	';

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
                Swal.fire({
                    title: 'Username นี้ถูกใช้แล้ว',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                });
              </script>";
    } else {
        // เพิ่มข้อมูลผู้ใช้ใหม่
        $sql = "INSERT INTO user (username, password, first_name, last_name, phone_number, userlevel)
                VALUES ('$username', '$password', '$first_name', '$last_name', '$phone_number', '$userlevel')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    Swal.fire({
                        title: 'ลงทะเบียนสำเร็จ!',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function() {
                        window.location.href = 'index.php';
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'เกิดข้อผิดพลาด: " . $conn->error . "',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                    });
                  </script>";
        }
    }

    closeConnection($conn);
}
?>
