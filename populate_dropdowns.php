<?php
header('Content-Type: application/json');

// Include database connection
include 'db_config.php';

if ($conn->connect_error) {
    die(json_encode(['message' => 'Database connection failed']));
}

$response = [];

// Populate users
$result = $conn->query("SELECT UserID, Username FROM Users ");
$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
$response['users'] = $users;

// Populate teachers
$result = $conn->query("SELECT TutorID, FullName FROM Tutors");
$teachers = [];
while ($row = $result->fetch_assoc()) {
    $teachers[] = $row;
}
$response['teachers'] = $teachers;

echo json_encode($response);

$conn->close();
?>
