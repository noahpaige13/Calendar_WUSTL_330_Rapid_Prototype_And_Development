
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

$stmt = $mysqli->prepare("UPDATE events set name=?, date=?, time=? where story_id=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

// Bind the parameter
$stmt->bind_param('sssi', $name, $date, $time, $story_id);

// $story_id = $_SESSION['story_id'];
$n = $json_obj['name'];
$d = $json_obj['date'];
$t = $json_obj['time'];

$stmt->execute();

$stmt->close();

?>