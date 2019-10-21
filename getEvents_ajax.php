<?php 
session_start();
require 'database.php';
// select all public stories in database
$stmt = $mysqli->prepare("select event_id, name, date, time from events where user=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('s', $username);
$username = $_SESSION['username'];
$stmt->execute();
$stmt->bind_result($event_id, $name, $date, $time);

$output = array();
while($stmt->fetch()){
    // echo "<li>$name: $date + $time";
    $input = array($name, $date, $time);
    array_push($output, $input);
        // "event" => $name,
        // "date" => $date,
        // "time" => $time
   
    
}
echo json_encode($output);
$stmt->close();
?>