<?php
// Database connection
$host = 'localhost';
$db = 'EduLinker';
$user = 'root'; // Your database username
$pass = '$enujaImeth123'; // Your database password

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $mysqli->real_escape_string($_POST['name']);
    $address = $mysqli->real_escape_string($_POST['address']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $birthday = $mysqli->real_escape_string($_POST['birthday']);
    
    // Handle file upload
    $profileImage = '';
    if (isset($_FILES['proof']) && $_FILES['proof']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['proof']['tmp_name'];
        //$name = $_FILES['proof']['name'];
        $upload_dir = 'uploads/';
        $profileImage = $upload_dir . basename($name);
        
        if (!move_uploaded_file($tmp_name, $profileImage)) {
            die('Failed to upload file.');
        }
    }

    $qualifications = $mysqli->real_escape_string($_POST['qualifications']);
    $teachingMethods = isset($_POST['teaching-method']) ? implode(',', $_POST['teaching-method']) : '';

    // Insert into Users table
    $stmt = $mysqli->prepare("INSERT INTO Users (Username, PasswordHash, UserType, Email) VALUES (?, ?, 'Tutor', ?)");
    $stmt->bind_param('sss', $name, $password, $email);
    if (!$stmt->execute()) {
        die('Error: ' . $stmt->error);
    }
    $userID = $stmt->insert_id;
    $stmt->close();

    // Insert into Tutors table
    $stmt = $mysqli->prepare("INSERT INTO Tutors (TutorID, FullName, Qualifications, ProfileImage,Birthday ) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('issss', $userID, $name, $qualifications, $profileImage, $birthday);
    if (!$stmt->execute()) {
        die('Error: ' . $stmt->error);
    }
    $stmt->close();

    // Optionally handle teaching methods
    // You could create a separate table for teaching methods if needed

    echo 'Teacher registered successfully!';
}

$mysqli->close();
?>
