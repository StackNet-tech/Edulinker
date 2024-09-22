<?php
header('Content-Type: application/json');

// Include database connection
include 'db_config.php';

if ($conn->connect_error) {
    die(json_encode(['message' => 'Database connection failed']));
}

$reportType = $_POST['reportType'];
$data = [];

switch ($reportType) {
    case 'User Activity':
        $result = $conn->query("SELECT * FROM UserActivity");
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        break;
    case 'Booking History':
        $result = $conn->query("SELECT * FROM Bookings");
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        break;
    case 'Feedback and Ratings':
        $result = $conn->query("SELECT * FROM Feedback");
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        break;
    case 'Platform Performance':
        // Add logic for performance report
        break;
    default:
        echo json_encode(['message' => 'Invalid report type']);
        exit();
}

echo json_encode(['status' => 'success', 'data' => $data]);

$conn->close();
?>
