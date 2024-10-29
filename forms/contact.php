<?php
    include '../connection.php';

        $comment_name = $_POST['comment_name'];
        $comment_text = $_POST['comment_text'];
        $rating = $_POST['rating'];


        $sql = "INSERT INTO comment (comment_name, comment_text, rating)
                VALUES ('$comment_name', '$comment_text', '$rating')";

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
                        title: "เราได้รับความคิดเห็นของคุณแล้ว",
                        icon: "success",
                        confirmButtonText: "ตกลง"
                    }).then(function() {
                        window.location.href = "../pages-contact.php";
                    });
                });
            </script>
        </head>
        <body>
        </body>
        </html>';
        } else {
            echo "<script>
                    alert('เกิดข้อผิดพลาด: " . $conn->error . "');
                  </script>";
        }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $conn->close();
?>
