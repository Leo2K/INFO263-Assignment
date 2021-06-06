<?php
require_once("config.php");

session_start();
//checks if user is currently logged in
if (isset($_SESSION['user_id'])) {
    header('location: dashboard.php');
}


$uname = $_POST['username'];
$pword = $_POST['password'];
$query = "select * from user where username = '$uname' and password = '$pword';";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
if ($count > 0) {

    $_SESSION['user_id'] = $row['user_id'];
    echo json_encode(array('success' => 1));
}
else {
    echo json_encode(array('success' => 0));

}

?>