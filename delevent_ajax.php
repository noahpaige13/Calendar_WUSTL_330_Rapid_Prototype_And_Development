
<?php
require 'database.php';

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);
ini_set("session.cookie_httponly", 1);
session_start();

$token = htmlentities($json_obj['token']);
//test CSRF token validity
if(!hash_equals($_SESSION['token'], $token)){
	die("Request forgery detected");
}

$stmt = $mysqli->prepare("DELETE from events where event_id=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

// Bind the parameter
$stmt->bind_param('i', $i);
$i = htmlentities($json_obj['id']);

$stmt->execute();

$stmt->close();

?>