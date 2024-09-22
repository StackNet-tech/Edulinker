<?php
header('Content-Type: application/json');
session_start();

// Include database connection
include 'db_config.php';

if ($conn->connect_error) {
    die(json_encode(['message' => 'Database connection failed']));
}

$tutorID = $_POST['tutor'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$userID = $_SESSION['userID'];  // Assuming userID is stored in session

$query = "INSERT INTO Reviews (TutorID, , Rating, Comment) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('siss', $tutorID, $userID, $rating, $comment);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
