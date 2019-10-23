<?php 
ini_set("session.cookie_httponly", 1);
session_start();
require 'database.php';
// select all public stories in database

// $token = htmlentities($json_obj['token']);

// //test CSRF token validity
// if(!hash_equals($_SESSION['token'], $token)){
// 	die("Request forgery detected");
// }

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