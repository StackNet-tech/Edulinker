<?php
header('Content-Type: application/json');

// Include database connection
include 'db_config.php';

if ($conn->connect_error) {
    die(json_encode(['message' => 'Database connection failed']));
}

$userId = $_POST['userId'];
$action = $_POST['action'];

switch ($action) {
    case 'Suspend User':
        $stmt = $conn->prepare("UPDATE Users SET Status = 'Suspended' WHERE UserID = ?");
        break;
    case 'Delete User':
        $stmt = $conn->prepare("DELETE FROM Users WHERE UserID = ?");
        break;
    case 'Edit User Profile':
        // Implement profile editing logic here
        $stmt = null;
        break;
    case 'Moderate Content':
        // Implement content moderation logic here
        $stmt = null;
        break;
    default:
        echo json_encode(['message' => 'Invalid action']);
        exit();
}

if ($stmt) {
    $stmt->bind_param('i', $userId);
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Action executed successfully']);
    } else {
        echo json_encode(['message' => 'Action execution failed']);
    }
    $stmt->close();
} else {
    echo json_encode(['message' => 'No action implemented']);
}

$conn->close();
?>
