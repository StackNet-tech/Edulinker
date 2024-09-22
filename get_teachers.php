<?php
header('Content-Type: application/json');

// Include the database configuration file
include 'db_config.php';

// Use the connection from db_config.php
if ($conn->connect_error) {
    die(json_encode(['message' => 'Database connection failed']));
}

$query = "SELECT TutorID, FullName, ProfileImage FROM Tutors";
$result = $conn->query($query);

$teachers = [];
while ($row = $result->fetch_assoc()) {
    $teachers[] = $row;
}

echo json_encode($teachers);

$conn->close();
?>
