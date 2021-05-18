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
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>
<form id="loginform" method="post">
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" id="username" class="form-control" required />
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" id="password" class="form-control" required />
    </div>
    <div class="form-group">
        <input type="submit" name="loginBtn" id="loginBtn" value="Login" class="btn btn-primary"/>
    </div>
</form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#loginform').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'login.php',
                data: $(this).serialize(),
                success: function(response)
                {
                    var jsonData = JSON.parse(response);
                    // user is logged in successfully in the back-end
                    // let's redirect
                    if (jsonData.success == "1")
                    {
                        location.href = 'dashboard.php';
                    }
                    else
                    {
                        alert('Invalid Credentials!');
                    }
                }
            });
        });
    });
</script>
</body>
</html>

<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header('location: dashboard.php');
}
?>


