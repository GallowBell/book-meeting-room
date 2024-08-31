<?php
session_start();
include 'connection.php'; // ไฟล์เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == 'admin') {
    $reservation_id = $_POST['reservation_id'];

    // ตรวจสอบว่ามี reservation_id หรือไม่
    if (!empty($reservation_id)) {
        $sql = "DELETE FROM reservations WHERE reservation_id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $reservation_id);
            if ($stmt->execute()) {
                echo "success"; // ส่งผลลัพธ์กลับไปให้ JavaScript
            } else {
                echo "error";
            }
            $stmt->close();
        }
    } else {
        echo "error";
    }
}
$conn->close();
?>
