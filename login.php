<?php
header('Content-Type: application/json');
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter both email and password.']);
        exit;
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT UserID, PasswordHash, UserType FROM Users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password.']);
        $stmt->close();
        $conn->close();
        exit;
    }

    $stmt->bind_result($userID, $passwordHash, $userType);
    $stmt->fetch();
    $stmt->close();

    // Verify the password
    if (!password_verify($password, $passwordHash)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password.']);
        $conn->close();
        exit;
    }

    // Success - return user details or redirect
    echo json_encode([
        'status' => 'success',
        'message' => 'Login successful!',
        'userID' => $userID,
        'userType' => $userType
    ]);

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
