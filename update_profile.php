<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $userId = 1; // Replace with actual user ID

    // Process qualification files
    $qualifications = $_FILES['proof'];

    // Update user profile
    $sql = "UPDATE Tutors SET FullName = ?, Address = ?, Email = ?, Birthday = ? WHERE TutorID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $fullName, $address, $email, $birthday, $userId);
    $stmt->execute();

    // Handle file uploads
    for ($i = 0; $i < count($qualifications['name']); $i++) {
        $fileName = basename($qualifications['name'][$i]);
        $targetFilePath = "uploads/" . $fileName;
        move_uploaded_file($qualifications['tmp_name'][$i], $targetFilePath);

        $sql = "INSERT INTO Qualifications (TutorID, Qualification, Proof) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $userId, $_POST['qualification'][$i], $fileName);
        $stmt->execute();
    }

    echo "Profile updated successfully.";
    $stmt->close();
    $conn->close();
}
?>
