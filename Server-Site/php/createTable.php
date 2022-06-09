<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "cubeDB";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE Users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    role VARCHAR(20) DEFAULT 'user',
    passw VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE (email)
    )";
    if ($conn->query($sql) === TRUE) {
      echo "Table was created successfully";
    } else {
      echo "Error creating table: " . $conn->error;
    }
$conn->close();
?>