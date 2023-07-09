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

// Get email ID from the query string
$email = $_GET['email'];

// Prepare and bind the statement
$stmt = $conn->prepare("SELECT health_report FROM users WHERE email = ?");
$stmt->bind_param("s", $email);

// Execute the statement
$stmt->execute();

// Bind the result
$stmt->bind_result($healthReport);

// Fetch the result
$stmt->fetch();

// Close the statement and connection
$stmt->close();
$conn->close();

// Output the PDF file
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=" . $healthReport);
@readfile("uploads/" . $healthReport);
?>