<?php
    session_start();

    if(isset($_POST["submit"]) && $_SESSION["code"] == $_POST["code"])
    {
        header("location: http://10.0.2.15/regSuccess.php");
    }
    else if(isset($_POST["submit"]) && $_SESSION["code"] != $_POST["code"])
    {
        echo "Try again.";
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Confirmation</title>
        <meta charset = "UTF-8">
        <style>
            #usernameError
            {
                width: 29.1%;
                background-color: tomato;
                font-weight: bold;
                margin-top: 1%;
                margin-bottom: 1%;
    	    }
        </style>
    </head>
    <body>
        <h1>Do not close this page!</h1>
        <h3>Please enter the 6-digit code that was sent to your email to continue.</h5>
        <form name="form" method="post" action="http://10.0.2.15/sentMail.php">
            <label for="codeField">Code:</label><br>
            <input type="text" id="codeField" name="code"><br><br>
            <input type="submit" id="submitButton" name="submit" value="Submit">
        </form>
    </body>
</html>