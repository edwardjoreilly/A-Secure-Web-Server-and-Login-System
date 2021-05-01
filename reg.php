<?php
    session_start(); //Start the php session
    
    //Generate a random string for Email verification
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
    
    //Connect to the database
    $dbHandle = mysqli_connect("localhost", "ejoreillyiv22", "fBLt4pwiyH9CQ8z", "COMP424");

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
        $_SESSION["username"] = ($_POST["username"]);
        $password = ($_POST["password"]); //Get password from form
        $_SESSION["password"] = ($_POST["password"]);
        $password2 = ($_POST["password2"]); //Get password2 from form
        $_SESSION["password2"] = ($_POST["password2"]);
        $firstname = ($_POST["firstname"]); //Get first name from form
        $_SESSION["firstname"] = ($_POST["firstname"]);
        $lastname = ($_POST["lastname"]); //Get last name from form
        $_SESSION["lastname"] = ($_POST["lastname"]);
        $birthday = ($_POST["birthday"]); //Get date of birth from form
        $_SESSION["birthday"] = ($_POST["birthday"]);
        $email = ($_POST["email"]); //Get email address from form
        $_SESSION["email"] = ($_POST["email"]);
        $_SESSION["EMAIL"] = $_POST["email"];
        $securityq1 = ($_POST["securityq1"]); //Get the first security question from form
        $_SESSION["securityq1"] = ($_POST["securityq1"]);
        $securityq2 = ($_POST["securityq2"]); //Get the second security question from form
        $_SESSION["securityq2"] = ($_POST["securityq2"]);
        $securityq3 = ($_POST["securityq3"]); //Get the third security question from form
        $_SESSION["securityq3"] = ($_POST["securityq3"]);
        
        $_SESSION["code"] = generateRandomString();
        $_SESSION["SUBJECT"] = "Account Registered";
        $_SESSION["Body"] = "Your account is ready to be created. Please use the code\n" . $_SESSION["code"] . "\nto complete your registration.";
        $_SESSION["redirect"] = "location: http://192.168.1.23/sentMail.php";
        
        

        if((!empty($username)) && (!empty($password)) && (!empty($password2)) && (!empty($firstname)) && (!empty($lastname)) && (!empty($birthday)) && (!empty($email)) && (!empty($securityq1)) && (!empty($securityq2)) && (!empty($securityq3)))
        {
            if(($password == $password2) && isset($_POST["submit"])){
                
                //Checks if number of rows in the database is greater than 1,
                //which would mean a user exists
                if(mysqli_num_rows($res) > 0) {
                    $usernameError = "Username already exists, please choose another.";
                }
                else
                {
                    header("location: http://192.168.1.23/sendMail.php");
                }
                /*
                //Create query and send it to the database to create a new user
                //Then redirect the user to the Registration Success page
                else {
                    $query = "INSERT INTO Register (username, password, firstname, 
                        lastname, birthday, email, securityq1, securityq2, securityq3) VALUES ('$username','$password', '$firstname', '$lastname', '$birthday', '$email', '$securityq1', '$securityq2', '$securityq3')";
                        $results = mysqli_query($dbHandle, $query);
                        $_SESSION['username'] = $username;
                        header("location: http://192.168.1.23/regSuccess.php");
                }
                */
                }
                else {
                    $passwordError = "Passwords do not match.";
                }
	        }
	        else {
    	        $blankError = "One or more of the fields are left blank. Please fill in all the fields before clicking the submit button.";
        }
    }
    
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>User Registration</title>
        <meta charset = "UTF-8">
        <style>
            #Error {
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
	<form name="form" method="post" action="http://192.168.1.23/reg.php">

            <label for="usernameField">Enter a username:</label><br>
            <input type="text" id="usernameField" name="username"><br><br>
            
            <label for="passwordField">Enter a password :</label><br>
            <input type="password" id="passwordField" name="password">
            <progress max="100" value="0" id="strength" style="width: 230px"></progress><br>

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
            
            <div class="g-recaptcha" data-sitekey="6Ldei78aAAAAABKH5dMhGqwsEnb3igBxgjuma5Ty"></div>
            <br/>

            <input type="submit" id="submitButton" name="submit" value="Submit">

        </form>
    <div <?php if(isset($usernameError)): ?> id="Error" class="visible" <?php endif ?>>
            <?php if (isset($usernameError)): ?>
            	<span><?php echo $usernameError; ?></span>
	    <?php endif ?>
    </div>
    <div <?php if(isset($passwordError)): ?> id="Error" class="visible" <?php endif ?>>
            <?php if (isset($passwordError)): ?>
            	<span><?php echo $passwordError; ?></span>
	    <?php endif ?>
    </div>
    <div <?php if(isset($blankError)): ?> id="Error" class="visible" <?php endif ?>>
            <?php if (isset($blankError)): ?>
            	<span><?php echo $blankError; ?></span>
	    <?php endif ?>
    </div>
    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    </body>
    <script>
    	var pass = document.getElementById("passwordField")
    	pass.addEventListener('keyup', function() {
    		checkPassword(pass.value)
    		})
    		function checkPassword(password){
    			var strengthBar = document.getElementById("strength")
    			var strength = 0;
    			if(password.match(/[a-zA-Z0-9][a-zA-Z0-9]+/)){
    				strength += 1
    			}
    			if(password.match(/[~<>?]+/)){
    				strength += 1
    			}
    			if(password.match(/[!@#$%^&*()]+/)){
    				strength += 1
    			}
    			if(password.length > 5){
    				strength += 1
    			}
    			
    			switch(strength) {
    				case 0:
    					strengthBar.value = 0;
    					break
    				case 1:
    					strengthBar.value = 20;
    					break
    				case 2:
    					strengthBar.value = 40;
    					break
    				case 3:
    					strengthBar.value = 60;
    					break
    				case 4:
    					strengthBar.value = 100;
    					break
    					
    			}
    		}
    </script>
</html>
