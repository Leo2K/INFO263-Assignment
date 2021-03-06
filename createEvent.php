<?php
include "config.php";
session_start();
if(!isset($_SESSION['user_id'])) {
    header('location: index.php');
}
?>


<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Create New Event</h2>
    <form id="eventform" method="post">
        <div class="form-group">
            <label>Assessment Name</label>
            <input type="text" name="assessment_name" id="assessment_name" class="form-control" required />
        </div>
        <div class="form-group">
            <label>Select event cluster</label>
            <select id="sel_cluster" name="sel_cluster">
                <option value="0">- Select -</option>
                <?php
                // Fetch Cluster
                $query = "SELECT * FROM front_cluster";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result) ){
                    $id = $row['cluster_id'];
                    $name = $row['cluster_name'];

                    // Option
                    echo "<option value='".$id."' >".$name."</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Select Day of Week</label>
            <select id="sel_day" name="sel_day">
                <option value=0>Sunday</option>
                <option value=1>Monday</option>
                <option value=2>Tuesday</option>
                <option value=3>Wednesday</option>
                <option value=4>Thursday</option>
                <option value=5>Friday</option>
                <option value=6>Saturday</option>
            </select>
        </div>
        <div class="form-group">
            <label>Week of the year</label>
            <select id="sel_week" name="sel_week">

            </select>
        </div>
        <div class="form-group">
            <label>Select Year</label>
            <input type="text" name="year" id="year" class="form-control" required />
        </div>
        <div class="form-group">
            <label>Start Time</label>
            <input type="text" name="start_time" id="start_time" class="form-control" required />
        </div>
        <div class="form-group">
            <label>Time offset</label>
            <input type="text" name="time_offset" id="time_offset" class="form-control" required />
        </div>
        <div class="form-group">
            <label>Assessment Time</label>
            <input type="text" name="assess_time" id="assess_time" class="form-control" required />
        </div>
        <div class="form-group">
            <label>Select Groups</label>
            <select id="sel_group" name="sel_group">
                <option value="0">- Select -</option>
                <?php
                // Fetch Room
                $query = "SELECT * FROM front_group";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result) ){
                    $name = $row['machine_group'];

                    // Option
                    echo "<option value='".$name."' >".$name."</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="createevent" id="createevent" value="Create Event" class="btn btn-primary"/>
        </div>
    </form>
    <p> <a href="dashboard.php">Back to Dashboard</a></p>
</div>
<script type="text/javascript">
    var count = 0;
    while (count < 52) {
        count++;
        document.getElementById("sel_week").innerHTML += "<option value='" + count + "'>" + count + "</option>";
    }


</script>
<script type="text/javascript">
    //ajax request on form submit to create an event
    $(document).ready(function() {
        $('#eventform').submit(function(e) {
            e.preventDefault();
            console.log( $( this ).serialize() );
            $.ajax({
                type: "POST",
                url: 'newEvent.php',
                data: $(this).serialize(),
                success: function(response)
                {
                    var jsonData = JSON.parse(response);
                    console.log(jsonData);
                    // check is if the databases requests are valid
                    if (jsonData.success == "1")
                    {
                        // route to the dashboard
                        alert('Success!');
                        location.href = 'dashboard.php';
                    }
                    else
                    {
                        alert('Invalid input');
                    }
                }
            });
        });
    });
</script>
</body>
</html>
