<?php
require_once("config.php");

session_start();

$assessment_name = $_POST['assessment_name'];
$machine_groups = $_POST['sel_group'];
$cluster_id = $_POST['sel_cluster'];
$week = $_POST['sel_week'];
$year = $_POST['year'];
$start_time = $_POST['start_time'];
$time_offset = $_POST['time_offset'];
$assess_time = $_POST['assess_time'];



$query = "insert into front_event (event_name, status) values ('$assessment_name', 1);";
if (mysqli_query($conn, $query)) {

} else {
    echo json_encode(array('success' => 0));
}

$query = "select * from front_event";
$result = mysqli_query($conn, $query);
$event_id = mysqli_num_rows($result);

$query = "select group_id from front_group where machine_group in ('$machine_groups')";
$result = mysqli_query($conn, $query);
$group_ids = mysqli_fetch_array($result);
$count = mysqli_num_rows($result);



$query = "insert into front_weekly (event_id, week_of_year, event_year) values ('$event_id', '$week', '$year')";
if (mysqli_query($conn, $query)) {

} else {
    echo json_encode(array('success' => 0));
}

for ($i = 0; $i < $count; $i++) {
    $query = "insert into front_daily (event_id, group_id, day_of_week, start_time) values ('$event_id', '$group_ids[i]', '$week', '$start_time');";
    mysqli_query($conn, $query);
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
    $success = "0";
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
$query = "insert into front_action (event_id, time_offset, cluster_id, activate) values ('$event_id', '$assess_time', 3, 1);";
if (mysqli_query($conn, $query)) {

} else {
    echo json_encode(array('success' => 0));
}

echo json_encode(array('success' => 1));
?>
