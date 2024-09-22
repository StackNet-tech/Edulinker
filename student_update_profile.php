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
$name = $_POST['name'];
$address = $_POST['address'];
$email = $_POST['email'];
$birthday = $_POST['birthday'];
$language = $_POST['language'];
$learningMethod = $_POST['learning-method'];
$profileImage = $_FILES['profile-image']['name'];

// Handle profile image upload
if ($_FILES['profile-image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($profileImage);
    if (move_uploaded_file($_FILES['profile-image']['tmp_name'], $uploadFile)) {
        // Profile image uploaded successfully
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to upload profile image']);
        exit();
    }
} else {
    // No new profile image, use old one
    $query = "SELECT ProfileImage FROM Users WHERE UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $profileImage = $row['ProfileImage'];
    }
    $stmt->close();
}

// Update user details in the database
$query = "UPDATE Users SET Username=?, Address=?, Email=?, DateOfBirth=?, Language=?, LearningMethod=?, ProfileImage=? WHERE UserID=?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ssssssss', $name, $address, $email, $birthday, $language, $learningMethod, $profileImage, $userID);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
