<?php
header('Content-Type: application/json');

// Include the database configuration file
include('db_config.php');

// Check if the connection is successful
if ($conn->connect_error) {
    die(json_encode(['message' => 'Database connection failed']));
}

// Query to select course details
$query = "SELECT CourseID, CourseName, Description, Category FROM Courses";
$result = $conn->query($query);

$courses = [];
if ($result) {
    // Fetch the results as an associative array
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
    // Output the courses as JSON
    echo json_encode($courses);
} else {
    // If the query fails, return an error message
    echo json_encode(['message' => 'Query failed']);
}

// Close the connection
$conn->close();
?>
