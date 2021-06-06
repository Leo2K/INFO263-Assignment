<?php
require_once "config.php";
$event_name = $_POST['event_name'];
$str = '%' . $event_name . '%';
$query = "select event_id from front_event where event_name like '$str'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$event_id = $row['event_id'];
$count = mysqli_num_rows($result);
if ($count > 0) {

    echo json_encode(array('success' => $event_id));
}
else {
    echo json_encode(array('success' => 0));

}
?>


