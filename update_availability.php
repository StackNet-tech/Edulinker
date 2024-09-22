<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $availability = $_POST['availability'];
    $subjects = $_POST['subjects'];
    $teachingMethod = $_POST['teaching-method'];
    $userId = 1; // Replace with actual user ID

    // Update availability and teaching details
    $sql = "UPDATE Tutors SET Availability = ?, Subjects = ?, TeachingMethod = ? WHERE TutorID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $availability, $subjects, $teachingMethod, $userId);
    $stmt->execute();

    echo "Availability updated successfully.";
    $stmt->close();
    $conn->close();
}
?>
