<?php
    session_start();

    if(isset($_POST["submit"]))
    {
        $_SESSION["EMAIL"] = $_POST["email"];
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["SUBJECT"] = "Account Registered";
        $_SESSION["Body"] = "Congrats, your account was registered!";
        header("location: http://10.0.2.15/sendMail.php");
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Test</title>
        <meta charset = "UTF-8">
        <style>
            #usernameError {
                width: 29.1%;
                background-color: tomato;
                font-weight: bold;
                margin-top: 1%;
                margin-bottom: 1%;
    	    }
        </style>
    </head>
    <body onload="document.form.reset();">
        <h1>Welcome to the Test page</h1>
        <form name="form" method="post" action="http://10.0.2.15/test.php">
            <label for="emailField">Email:</label><br>
            <input type="text" id="emailField" name="email"><br><br>
            <label for="usernameField">Username:</label><br>
            <input type="text" id="usernameField" name="username"><br><br>
            <label for="passwordField">Password:</label><br>
            <input type="password" id="passwordField" name="password"><br><br>
            <input type="submit" id="submitButton" name="submit" value="Submit">
        </form>
        <form method="get" action = "http://10.0.2.15/sendMail.php">
            <label>
                <input type="submit" name="sendE" value="send Email!"><br><br>
            </label>
	    <div <?php if(isset($usernameError)): ?> id="usernameError" <?php endif ?>>
            <?php if (isset($usernameError)): ?>
                <span><?php echo $usernameError; ?></span>
            <?php endif ?>
        </div>
    </body>
</html>