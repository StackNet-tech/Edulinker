<?php
header('Content-Type: application/json');
$mysqli = new mysqli('localhost', 'username', 'password', 'EduLinker');

if ($mysqli->connect_error) {
    die(json_encode(['message' => 'Database connection failed']));
}

$reportType = $_POST['reportType'];
$data = [];

switch ($reportType) {
    case 'User Activity':
        $result = $mysqli->query("SELECT * FROM Messages");
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        break;
    case 'Booking History':
        $result = $mysqli->query("SELECT * FROM Enrollments");
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        break;
    case 'Feedback and Ratings':
        $result = $mysqli->query("SELECT * FROM Reviews");
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

$mysqli->close();
?>
