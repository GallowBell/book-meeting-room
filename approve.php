<?php
    session_start();
    require_once __DIR__ . '/connection.php';
    header('Content-Type: application/json; charset=UTF-8');

    $status = isset($_POST['status']) ? $_POST['status'] : '';


    /**
     * function for update status table reservations 
     * @param array - parameter for update status is_approve of table reservations
     * * status - 1 = approve, 0 = reject
     * * reservation_id - primary of reservations to update record
     */
    function UpdateIsApprove($parameter = []){
        global $conn;
        $status = $parameter['status'];
        $reservation_id = $parameter['reservation_id'];
        $stmt = $conn->prepare("UPDATE reservations SET `is_approve`=? WHERE reservation_id=?");
        $stmt->bind_param('si', $status, $reservation_id);
        $QueryResult = $stmt->execute();
        $stmt->close();
        $conn->close();
        $message = 'ไม่อนุมัติการจอง';
        if($status == 1){
            $message = 'อนุมัติการจอง';
        }
        if($QueryResult){
            // success
            return [
                'status' => 200,
                'message' => $message.'เรียบร้อยแล้ว'
            ];
        }
        // error
        return [
            'status' => 500,
            'message' => 'เกิดข้อผิดพลาดในการ'.$message.' โปรดลองใหม่อีกครั้ง'
        ];
        
    }

    // อนุมัติ
    if($status == 'approve'){
        $reservation_id = $_POST['reservation_id'];
        $status = 1;
        $result = UpdateIsApprove([
            'reservation_id' => $reservation_id,
            'status' => $status
        ]);
        echo json_encode($result);
        return;
    }

    // ไม่อนุมัติ
    if ($status == 'reject') {
        $reservation_id = $_POST['reservation_id'];
        $status = 0;
        $result = UpdateIsApprove([
            'reservation_id' => $reservation_id,
            'status' => $status
        ]);
        echo json_encode($result);
        return;
    }

    // รอการอนุมัติ
    if($status == 'wait'){
        $reservation_id = $_POST['reservation_id'];
        $status = -1;
        $result = UpdateIsApprove([
            'reservation_id' => $reservation_id,
            'status' => $status
        ]);
        echo json_encode($result);
        return;
    }

    echo json_encode([
        'status' => 400,
        'message' => 'Bad Request'
    ]);

    return;

?>