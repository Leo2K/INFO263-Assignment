<?php
require_once("config.php");

session_start();

$assessment_name = $_POST['assessment_name'];
$machine_groups = $_POST['sel_group'];
$cluster_id = $_POST['sel_cluster'];
$week = $_POST['sel_week'];
$day = $_POST['sel_day'];
$year = $_POST['year'];
$start_time = $_POST['start_time'];
$time_offset = $_POST['time_offset'];
$assess_time = $_POST['assess_time'];



$query = "insert into front_event (event_name, status) values ('$assessment_name', 1);";
if (mysqli_query($conn, $query)) {

} else {
    echo json_encode(array('success' => 0));
}

$query = "select event_id from front_event where event_name = '$assessment_name'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$event_id = $row['event_id'];

$group_ids = array();
$query = "select group_id from front_group where machine_group in ('$machine_groups')";
$result = mysqli_query($conn, $query);
while($row = $result->fetch_assoc()) {
    foreach ($result as $row) {
        array_push($group_ids, $row["group_id"]);
    }
}
//$group_ids = mysqli_fetch_array($result);
$count = count($group_ids);



$query = "insert into front_weekly (event_id, week_of_year, event_year) values ('$event_id', '$week', '$year')";
if (mysqli_query($conn, $query)) {

} else {
    echo json_encode(array('success' => 0));
}

$query = "";
for ($i = 0; $i < $count; $i++) {
    $current = $group_ids[$i];
    $query .= "insert into front_daily (event_id, group_id, day_of_week, start_time) values ('$event_id', '$current', '$day', '$start_time');";
}
if (mysqli_multi_query($conn, $query)) {

} else {
    echo json_encode(array('success' => 0));
}

$query = "insert into front_action (event_id, time_offset, cluster_id, activate) values ('$event_id', '$time_offset', 3, 0);";
if (mysqli_query($conn, $query)) {

} else {
    echo json_encode(array('success' => 0));
}
$query = "insert into front_action (event_id, time_offset, cluster_id, activate) values ('$event_id', '$time_offset', '$cluster_id', 1);";
if (mysqli_query($conn, $query)) {

} else {
    echo json_encode(array('success' => 0));
}
$query = "insert into front_action (event_id, time_offset, cluster_id, activate) values ('$event_id', '$assess_time', '$cluster_id', 0);";
if (mysqli_query($conn, $query)) {

} else {
    echo json_encode(array('success' => 0));
}
$query = "insert into front_action (event_id, time_offset, cluster_id, activate) values ('$event_id', '$assess_time', 3, 1);";
if (mysqli_query($conn, $query)) {

} else {
    echo json_encode(array('success' => 0));
}

echo json_encode(array('success' => 1));
?>
