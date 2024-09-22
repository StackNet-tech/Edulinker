<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mode = $_POST['mode'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql = "INSERT INTO enrollments (student_id, class_mode, class_date, class_time) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['student_id'], $mode, $date, $time]);

    echo "Enrollment successful!";
}
?>
