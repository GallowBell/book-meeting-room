<?php
session_start();
include 'connection.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == 'admin') {
    $reservation_id = $_POST['reservation_id'];

    // ตรวจสอบว่ามี reservation_id หรือไม่
    if (!empty($reservation_id)) {
        // Begin a transaction
        $conn->begin_transaction();

        try {
            // Delete related records from equipment_reservations
            $sql_delete_related = "DELETE FROM equipment_reservations WHERE reservation_id = ?";
            if ($stmt_related = $conn->prepare($sql_delete_related)) {
                $stmt_related->bind_param("i", $reservation_id);
                $stmt_related->execute();
                $stmt_related->close();
            }

            // Delete the reservation record
            $sql_delete_reservation = "DELETE FROM reservations WHERE reservation_id = ?";
            if ($stmt = $conn->prepare($sql_delete_reservation)) {
                $stmt->bind_param("i", $reservation_id);
                if ($stmt->execute()) {
                    echo "success"; // Send result back to JavaScript
                } else {
                    error_log("Error executing statement: " . $stmt->error); // Log SQL error
                    echo "error executing statement: " . $stmt->error; // Return the detailed error to the front end
                }
                $stmt->close();
            } else {
                error_log("Error preparing statement: " . $conn->error); // Log error
                echo "error preparing statement: " . $conn->error; // Return the detailed error to the front end
            }

            // Commit the transaction
            $conn->commit();

        } catch (Exception $e) {
            $conn->rollback(); // Roll back the transaction if something goes wrong
            error_log("Transaction failed: " . $e->getMessage());
            echo "error in transaction: " . $e->getMessage();
        }

    } else {
        error_log("Empty reservation_id received."); // Log error
        echo "error empty reservation_id";
    }
} else {
    error_log("Unauthorized access or incorrect request method."); // Log error
    echo "unauthorized";  // Additional response if the user is not authorized
}
$conn->close();

?>
