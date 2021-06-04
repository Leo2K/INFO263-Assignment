<?php
require_once("config.php");

$event_id = $_POST['event_id'];

$query = "delete from front_event where event_id = '$event_id'";

if (mysqli_query($conn, $query)) {
   echo json_encode(array('success' => $event_id));
} else {
    echo json_encode(array('fail' => mysqli_error($conn)));
}

?>
