<?php
header('Content-Type: application/json');

// Include database connection
include 'db_config.php'; 

if ($conn->connect_error) {
    die(json_encode(['message' => 'Database connection failed']));
}

$teacherId = $_POST['teacherId'];
$status = $_POST['status'];

// Prepare the query using the $conn object from db_config.php
$stmt = $conn->prepare("UPDATE Tutors SET VerificationStatus = ? WHERE TutorID = ?");
$stmt->bind_param('si', $status, $teacherId);

if ($stmt->execute()) {
    echo json_encode(['message' => 'Verification status updated successfully']);
} else {
    echo json_encode(['message' => 'Verification status update failed']);
}

$stmt->close();
$conn->close();
?>
