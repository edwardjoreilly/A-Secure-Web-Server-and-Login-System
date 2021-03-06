<?php
    session_start(); //Start the php session
    
    //Connect to the database
    $dbHandle = mysqli_connect("localhost", "root", "(password)", "(database name)");
    
    //Check the database connection
    if(!$dbHandle) {
	    print("Could not connect to the database.");
	    print(mysqli_connect_error());
            
	    die(); //Kills process if unable to connect to the database
    }
    
    //If the submit button is pressed, check the database to see if the username exists
    //If the username does not exist, create the new user. If the username does exist, show error
    if(isset($_POST["submit"])) {
	    $username = ($_POST["username"]); //Get username from form
        $password = ($_POST["password"]); //Get password from form
	    $sql = "SELECT * FROM (database name) WHERE username='$username' AND password='$password'"; //Send query to databse
	    
	    $sql = $dbHandle->prepare("SELECT * FROM (database name) WHERE username=(:username) AND password=(:password)");
	    $sql->bindParam(':username', $username);
	    $sql->bindParam(':password', $password);
	    $sql->execute();
	    
	    $result = mysqli_query($dbHandle, $sql); //Get query results
            
	    //Checks if number of rows in databse is equal to one, which means a user exists
	    //If the user does exists and they are the admin, they are sent to the Admin page
	    //If the user exists and they aren't the admin, they are sent the login success page
	    if(mysqli_num_rows($result) == 1) {
		    $_SESSION["message"] = "Login Successful!";
		    $_SESSION["username"] = $username;
		    header("location: http://192.168.56.103/logSuccess.php");
	    }
            
	    //Error if the password or username were incorrect
	    else {
		    $usernameError = "The username or password was either incorrect or not found. Please check the spelling and capitalization and try again.";
	    }
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Login</title>
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
        <h1>Welcome to the Login page</h1>
        <h3>Please enter a username and password if you have an account or click "New User? Sign Up" if you would like to create one.</h5>
        <form name="form" method="post" action="http://192.168.56.103/login.php">
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
        <form method="get" action="http://192.168.56.103/reg.php">
            <label>
                <input type="submit" name="register" value="New User? Sign Up"><br><br>
            </label>
        </form>
        <form method="get" action="http://192.168.56.103/forgotUserorPass.php">
            <label>
                <input type="submit" name="forgot" value="Forgot Username or Password?"><br><br>
            </label>
        </form>
    </body>
</html>
