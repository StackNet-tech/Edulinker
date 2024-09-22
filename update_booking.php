<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingRequestID = $_POST['booking-request'];
    $response = $_POST['response'];

    // Update booking request response
    $sql = "UPDATE BookingRequests SET Response = ? WHERE BookingRequestID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $response, $bookingRequestID);
    $stmt->execute();

    echo "Booking response submitted successfully.";
    $stmt->close();
    $conn->close();
}
?>
