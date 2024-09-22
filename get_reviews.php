<?php
header('Content-Type: application/json');

// Include the database configuration file
include('db_config.php');

// Check if the connection is successful
if ($conn->connect_error) {
    die(json_encode(['message' => 'Database connection failed']));
}

// Query to select review details and join with users table
$query = "SELECT r.ReviewID, r.Comment, r.Rating, u.Username AS FullName 
          FROM Reviews r 
          JOIN Users u ON r.TutorID = u.UserID";
$result = $conn->query($query);

$reviews = [];
if ($result) {
    // Fetch the results as an associative array
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
    // Output the reviews as JSON
    echo json_encode($reviews);
} else {
    // If the query fails, return an error message
    echo json_encode(['message' => 'Query failed']);
}

// Close the connection
$conn->close();
?>
