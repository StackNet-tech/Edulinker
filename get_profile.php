<?php
header('Content-Type: application/json');
session_start();

// Include the database configuration file
include('db_config.php');

// Check if the connection is successful
if ($conn->connect_error) {
    die(json_encode(['message' => 'Database connection failed']));
}

$userID = $_SESSION['userID'];  // Assuming userID is stored in session

// Prepare the query to fetch user details using the userID
$query = "SELECT * FROM Users WHERE UserID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $userID);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists and fetch details
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode([
        'name' => $user['Username'],
        'address' => $user['Address'] ?? 'N/A',  // Provide a default value
        'email' => $user['Email'],
        'birthday' => $user['DateOfBirth'] ?? null,  // Keep null if it's acceptable
        'language' => $user['Language'] ?? 'N/A',
        'learning_method' => $user['LearningMethod'] ?? 'N/A',
        'profile_image' => $user['ProfileImage'] ?? 'default_profile_image.jpg'  // Fallback image
    ]);    
} else {
    echo json_encode(['message' => 'User not found']);
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>
