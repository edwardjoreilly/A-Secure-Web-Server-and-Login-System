<?php
    session_start();
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Registration Successful!</title>
	<meta charset="UTF-8">
    </head>
    <body>
	<h1>Congratulations <?php echo $_SESSION['username']; ?>!</h1>
        <h2>You are now a member! Click the login button to return to the login page.</h2>
	<form method="get" action="http://172.18.30.210/login.php">
	    <label>
                <input type="submit" value="Login" name="login">
	    </label>
        </form>
    </body>
</html>