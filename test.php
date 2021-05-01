<?php
    session_start();

    function generateRandomString($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $_SESSION["code"] = generateRandomString();

    if($_SESSION["hadForgotten"] == true)
    {
        echo "An email has been sent with your login info.";
        $_SESSION["hadForgotten"] = false;
    }

    if(isset($_POST["submit"]))
    {
        $_SESSION["EMAIL"] = $_POST["email"];
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["SUBJECT"] = "Account Registered";
        $_SESSION["Body"] = "Your account is ready to be created. Please use the code\n" . $_SESSION["code"] . "\nto complete your registration.";
        $_SESSION["redirect"] = "location: http://10.0.2.15/sentMail.php";
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
	    <div <?php if(isset($usernameError)): ?> id="usernameError" <?php endif ?>>
            <?php if (isset($usernameError)): ?>
                <span><?php echo $usernameError; ?></span>
            <?php endif ?>
        </div>
    </body>
</html>