<?php
require 'database.php';

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

// Check to see if the username and password are valid.  (You learned how to do this in Module 3.)
// Use a prepared statement
$stmt = $mysqli->prepare("INSERT into users (username, hashed_password) VALUES (?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

// Bind the parameter
$stmt->bind_param('ss', $username, $hashed);
$username = $json_obj['username'];
$pass = $json_obj['password'];
$hashed = password_hash($pass, PASSWORD_BCRYPT);
$hashed = substr( $hashed, 0, 60 );

// Compare the submitted password to the actual password hash

$stmt->close();

session_start();
$_SESSION['username'] = $username;

$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32)); 

echo json_encode(array(
    "success" => true
));
exit;

	
?>