<?php
include 'connection.php';

echo '
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  	';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ตรวจสอบข้อมูลผู้ใช้
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['userlevel'] = $row['userlevel'];

            // แสดง SweetAlert และเปลี่ยนเส้นทางไปยัง index.php
            echo "<script>
                    Swal.fire({
                        title: 'เข้าสู่ระบบสำเร็จ!',
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
                        title: 'รหัสผ่านไม่ถูกต้อง',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                    });
                  </script>";
        }
    } else {
        echo "<script>
                Swal.fire({
                    title: 'ไม่พบผู้ใช้นี้',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                });
              </script>";
    }

    closeConnection($conn);
}
?>
