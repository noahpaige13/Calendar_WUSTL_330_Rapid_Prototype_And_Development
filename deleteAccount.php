<?php
require 'database.php';
ini_set("session.cookie_httponly", 1);
session_start();

$token = htmlentities($json_obj['token']);

//test CSRF token validity
if(!hash_equals($_SESSION['token'], $token)){
	die("Request forgery detected");
}

// Delete events associated with user
$stmt = $mysqli->prepare("DELETE from events where user=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('s', $username);
$username = $_SESSION['username'];

$stmt->execute();

$stmt->close();

//
//Delete user
$stmt = $mysqli->prepare("DELETE from users where username=?");

$stmt->bind_param('s', $user);
$user = $username;
$stmt->execute();

$stmt->close();

//
//Logs out user after it is deleted
session_destroy();

?>