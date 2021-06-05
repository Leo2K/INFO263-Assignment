<?php
require_once("config.php");

$event_id = $_POST['event_id'];

$query = "delete from front_action where event_id = '$event_id'";
mysqli_query($conn, $query);
$query = "delete from front_daily where event_id = '$event_id'";
mysqli_query($conn, $query);
$query = "delete from front_weekly where event_id = '$event_id'";
mysqli_query($conn, $query);
$query = "delete from front_event where event_id = '$event_id'";
mysqli_query($conn, $query);

?>
