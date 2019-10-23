<?php 
ini_set("session.cookie_httponly", 1);
session_start();
require 'database.php';
// select all public stories in database

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

$token = htmlentities($json_obj['token']);

//test CSRF token validity
if(!hash_equals($_SESSION['token'], $token)){
	die("Request forgery detected");
}

$stmt = $mysqli->prepare("select event_id, name, date, time, important from events where user=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('s', $username);
$username = $_SESSION['username'];
$stmt->execute();
$result = $stmt->get_result();

$output = array();
$i = 0;
while($row = $result->fetch_assoc()){
    $output[$i] = $row;
    $i++;
}
echo json_encode($output);
$stmt->close();
?>