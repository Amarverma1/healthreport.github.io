<?php
// MySQL database configuration
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the statement
$stmt = $conn->prepare("INSERT INTO users (name, age, weight, email, health_report) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sisss", $name, $age, $weight, $email, $healthReport);

// Get form data
$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$email = $_POST['email'];
$healthReport = $_FILES['healthReport']['name'];

// Move uploaded file to a desired location
$targetDirectory = "uploads/";
$targetFilePath = $targetDirectory . basename($_FILES["healthReport"]["name"]);
move_uploaded_file($_FILES["healthReport"]["tmp_name"], $targetFilePath);

// Execute the statement
if ($stmt->execute()) {
  echo "Form submitted successfully!";
} else {
  echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>