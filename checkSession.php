
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
if(isset($_SESSION)) {
    $username = $_SESSION['username'];
    $token = $_SESSION['token'];
    echo json_encode(array(
        "success" => true,
        "token" => $token,
        "username" => $username
    ));
}
else{
    echo json_encode(array(
        "success" => false
    ));
}
exit;
?>