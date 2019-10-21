
<?php
require 'database.php';

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);
session_start();

//test CSRF token validity
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

// Use a prepared statement
$stmt = $mysqli->prepare("INSERT into events (user, name, date, time) VALUES (?, ?, ?, ?)");

// Bind the parameter
$stmt->bind_param('ssss', $username, $n, $d, $t);
$username = $_SESSION['username'];
$n = htmlspecialchars($_POST['name']);
$d = htmlentities($_POST['date']);
$t = htmlentities($_POST['time']);

$stmt->execute();

$stmt->close();

?>