<?php
    session_start(); //Start the php session
    
    //Connect to the database
    $dbHandle = mysqli_connect("localhost", "root", "(password)", "(database name)");

    //Check database connection
    if(!$dbHandle) {
	    print("Could not connect to the database.");
	    print(mysqli_connect_error());

	    die(); //Kills process if unable to connect to the database
    }

    //If the submit button is pressed, check the database to see if the username exixts
    //If the username does not exist, create the new user. If the username does exist, show error
    if(isset($_POST["submit"])) {
	$username = ($_POST["username"]); //Get username from form
        $password = ($_POST["password"]); //Get password from form
        $password2 = ($_POST["password2"]); //Get password2 from form
        $firstname = ($_POST["firstname"]); //Get first name from form
        $lastname = ($_POST["lastname"]); //Get last name from form
        $birthday = ($_POST["birthday"]); //Get date of birth from form
        $email = ($_POST["email"]); //Get email address from form
        $securityq1 = ($_POST["securityq1"]); //Get the first security question from form
        $securityq2 = ($_POST["securityq2"]); //Get the second security question from form
        $securityq3 = ($_POST["securityq3"]); //Get the third security question from form
	    
	$sql = $dbHandle->prepare("SELECT * FROM (database name) WHERE username=(:username)");
	$sql->bindParam(':username', $username);
	$sql->execute();
	
	$res = mysqli_query($dbHandle, $sql); //Get query results
        
        if($password != $password2) {
	        //Checks if number of rows in the database is greater than 1,
	        //which would mean a user exists
            if(mysqli_num_rows($res) > 0) {
		        $usernameError = "Username already exists, please choose another.";
	        }

	        //Create query and send it to the database to create a new user
	        //Then redirect the user to the Registration Success page
	        else {
			$query = $dbHandle->prepare("INSERT INTO (database name) (username, password, password2, firstname, lastname, birthday, email, securityq1, securityq2, securityq3) 
			VALUES ('$username','$password', '$password2', '$firstname', '$lastname', '$birthday', '$email', '$securityq1', '$securityq2', '$securityq3')");
			$query->bindParam(':username', $username);
			$query->bindParam(':password', $password);
			$query->bindParam(':password2', $password2);
			$query->bindParam(':firstname', $firstname);
			$query->bindParam(':lastname', $lastname);
			$query->bindParam(':birthday', $birthday);
			$query->bindParam(':email', $email);
			$query->bindParam(':securityq1', $securityq1);
			$query->bindParam(':securityq2', $securityq2);
			$query->bindParam(':securityq3', $securityq3);
			$query->execute();
			
		$results = mysqli_query($dbHandle, $query);
                $_SESSION['username'] = $username;
	            header("location: http://192.168.56.103/regSuccess.php");
	        }
        }

        else {
            $passwordError = "Passwords do not match.";
        }
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>User Registration</title>
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
        <h1>Welcome to the Registration page</h1>
        <h4>Please enter your information below.</h4><br>
	<form name="form" method="post" action="http://192.168.56.103/reg.php">

            <label for="usernameField">Enter a username:</label><br>
            <input type="text" id="usernameField" name="username"><br><br>

            <label for="passwordField">Enter a password:</label><br>
            <input type="password" id="passwordField" name="password"><br><br>

            <label for="passwordField2">Enter the password again:</label><br>
            <input type="password" id="passwordField2" name="password2"><br><br>

            <label for="firstnameField">First name:</label><br>
            <input type="text" id="firstnameField" name="firstname"><br><br>

            <label for="lastnameField">Last name:</label><br>
            <input type="text" id="lastnameField" name="lastname"><br><br>

            <label for="birthdayField">Birthday:</label><br>
            <input type="date" id="birthdayField" name="birthday"><br><br>

            <label for="emailField">Email Address:</label><br>
            <input type="text" id="emailField" name="email"><br><br>

            <label for="securityq1Field">What is your mother's maiden name?</label><br>
            <input type="text" id="securityq1Field" name="securityq1"><br><br>
            
            <label for="securityq2Field">What was the name of your first pet?</label><br>
            <input type="text" id="securityq2Field" name="securityq2"><br><br>
            
            <label for="securityq3Field">What was the name of the elementary school you went to?</label><br>
            <input type="text" id="securityq3Field" name="securityq3"><br><br>

            <input type="submit" id="submitButton" name="submit" value="Submit">

        </form>
	<div <?php if(isset($usernameError)): ?> id="usernameError" class="visible" <?php endif ?>>
            <?php if (isset($usernameError)): ?>
		        <span><?php echo $usernameError; ?></span>
	        <?php endif ?>
    </div>
    <div <?php if(isset($passwordError)): ?> id="passwordError" class="visible" <?php endif ?>>
            <?php if (isset($passwordError)): ?>
                <span><?php echo $passwordError; ?></span>
            <?php endif ?>
    </div>
    </body>
</html>
