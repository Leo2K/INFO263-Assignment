<?php
require_once("config.php");

$assessment_name = $_POST['assessment_name'];
$machine_groups = $_POST['sel_group'];
$cluster_id = $_POST['sel_cluster'];
$week = $_POST['sel_week'];
$day = $_POST['sel_day'];
$start_time = $_POST['start_time'];

$dets = $_POST['details'];

$details = explode(",", $dets);

$query = "select cluster_id from front_cluster where cluster_name = '$details[2]'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$clusterId = $row['cluster_id'];


if ($assessment_name != "") {
    $query = "update front_event set event_name = '$assessment_name' where event_id = '$details[1]'";
    mysqli_query($conn, $query);
}



if ($cluster_id != "-1") {
    $query = "update front_action set cluster_id = '$cluster_id' where event_id = '$details[1]' and cluster_id = '$clusterId'";
    mysqli_query($conn, $query);
}

/* if ($week != "-1" && $day != "-1" && $start_time != "") {
    $date = new DateTime($details[4]);
    $getWeek = $date->format("W");
    $dy = $date->format("D");
    $year = substr($details[4], 0, 4);
    if (substr($getWeek, 0, 1) == 0) {
        $wek = substr($getWeek, 1, 1);
    } else {
        $wek = $getWeek;
    }

    $query = "update front_weekly set week_of_year = '$week' where event_id = '$details[1]' and week_of_year = '$wek'";
    mysqli_query($conn, $query);


    $query = "update front_daily set day_of_week = '$day' and start_time = '$start_time' where event_id = '$details[1]' and start_time = '$details[5]'";
    $result = mysqli_query($conn, $query);
    echo json_encode(array('successsssssssssssssssssssssssssssssssssssssssssssss' => $details[5]));
} */

if ($machine_groups != "-1") {

    $query = "select group_id from front_group where machine_group = '$machine_groups'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $group_id1 = $row['group_id'];

    $query = "select group_id from front_group where machine_group = '$details[3]'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $group_id2 = $row['group_id'];

    $query = "update front_daily set group_id = '$group_id1' where event_id = '$details[1]' and group_id = '$group_id2'";
    mysqli_query($conn, $query);
}


echo json_encode(array('success' => 1));


?>
