<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header('location: index.php');
}

?>




<!DOCTYPE html>
<html>
<head>
    <title>Your Dashboard</title>
</head>
<body>
<p align="right"> <a href="logout.php">Logout</a></p>
<a href="createEvent.php">Create a New Event</a>
<br>
<a href="view_events.html">View Events</a>



</body>
</html>

