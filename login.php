<?php
$hostname = "127.0.0.1";
$database = "tserver";
$username = "root";
$password = "mysql";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    fatalError($conn->connect_error);
    return;
}

session_start();

if (isset($_SESSION['user_id'])) {
    header('location: dashboard.php');
}


$uname = $_POST['username'];
$pword = $_POST['password'];
$query = "select * from user where username = '$uname' and password = '$pword'";
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