<?php
    session_start();
    require_once __DIR__ . '/connection.php';
    header('Content-Type: application/json; charset=UTF-8');

    $status = isset($_POST['status']) ? $_POST['status'] : '';
    
    if($status == 'approve'){
        $reservation_id = $_POST['reservation_id'];
        $status = 1;
        $stmt = $conn->prepare("UPDATE reservations SET `is_approve`=? WHERE reservation_id=?");
        $stmt->bind_param('si', $status, $reservation_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'อนุมัติการจองเรียบร้อยแล้ว'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'เกิดข้อผิดพลาดในการอนุมัติการจอง โปรดลองใหม่อีกครั้ง'
            ]);
        }
        return;
    }

    if ($status == 'reject') {
        $reservation_id = $_POST['reservation_id'];
        $status = 0;
        $stmt = $conn->prepare("UPDATE reservations SET `is_approve`=? WHERE reservation_id=?");
        $stmt->bind_param('si', $status, $reservation_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        if($result){
            echo json_encode([
                'status' => 200,
                'message' => 'ไม่อนุมัติการจองเรียบร้อยแล้ว'
            ]);
        }else{
            echo json_encode([
                'status' => 500,
                'message' => 'เกิดข้อผิดพลาดในการไม่อนุมัติการจองเรียบ โปรดลองใหม่อีกครั้ง'
            ]);
        }
        return;
    }

?>