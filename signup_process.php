<?php
$servername = "localhost";
$username = "root"; // Your database username
$password = '$enujaImeth123'; // Your database password
$dbname = "EduLinker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $conn->real_escape_string($_POST['name']);
$address = $conn->real_escape_string($_POST['address']);
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);
$birthday = $conn->real_escape_string($_POST['birthday']);
$subjects = $conn->real_escape_string($_POST['subjects']);
$language = $conn->real_escape_string($_POST['language']);
$mode = $conn->real_escape_string($_POST['mode']);

// Hash the password
$passwordHash = password_hash($password, PASSWORD_BCRYPT);

// Insert data into Users table
$sql = "INSERT INTO Users (Username, PasswordHash, UserType, Email) VALUES ('$name', '$passwordHash', 'Student', '$email')";

if ($conn->query($sql) === TRUE) {
    // Get the last inserted UserID
    $userId = $conn->insert_id;

    // Insert data into Students table
    $sqlStudent = "INSERT INTO Students (StudentID, FullName, GradeLevel) VALUES ('$userId', '$name', NULL)";

    if ($conn->query($sqlStudent) === TRUE) {
        echo "New record created successfully";
        // You may want to redirect to a different page or show a success message
    } else {
        echo "Error: " . $sqlStudent . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
