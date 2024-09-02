<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* $reservation_id = $_POST['reservation_id'];
    $meeting_name = $_POST['meeting_name'];
    $meeting_room = $_POST['meeting_room'];
    $organizer_name = $_POST['organizer_name'];
    $reservation_date = $_POST['reservation_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $notes = $_POST['notes']; */

    $reservation_id = $_POST['reservation_id']; 
    $government_sector = $_POST['government_sector']; 
    $contact_number = $_POST['contact_number']; 
    $meeting_name = $_POST['meeting_name']; 
    $document_number = $_POST['document_number']; 
    $meeting_room = $_POST['meeting_room'];  
    $meeting_type = $_POST['meeting_type']; 
    $participant_count = $_POST['participant_count']; 
    $organizer_name = $_POST['organizer_name'];  
    $reservation_date = $_POST['reservation_date']; 
    $reservation_date_end = $_POST['reservation_date_end']; 
    $start_time = $_POST['start_time']; 
    $end_time = $_POST['end_time']; 
    $notes = $_POST['notes']; 

    // เชื่อมต่อกับฐานข้อมูล
    include 'connection.php';
    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // เตรียมและรันคำสั่ง SQL
    $stmt = $conn->prepare("UPDATE reservations SET meeting_name=?, meeting_room=?, organizer_name=?, reservation_date=?, start_time=?, end_time=?, notes=? WHERE reservation_id=?");
    $stmt->bind_param('ssssssss', $meeting_name, $meeting_room, $organizer_name, $reservation_date, $start_time, $end_time, $notes, $reservation_id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
