<!--get query from databse for 1 of 3 security questions and a seperate query for their email using php-->
<!--send them their login info on verification of credentials using mailto in html and getting the infor from the database query using php-->
<!--EZ Clap-->


<!DOCTYPE html>
<html>
    <head>
        <title>Forgot username or password</title>
        <meta charset="UTF-8">
    </head>
    <body>
	    <h1>Forgot your username or password?</h1>
	    <h3>We'll send you a recovery email. Please enter your email address in the box below and answer ONLY ONE of the security questions.</h3>
	    <form name="form" method="post" action="http://192.168.56.103/forgotUserOrPass.php">
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
        <div id="usernameError">
            <?php if (isset($usernameError)): ?>
                <span><?php echo $usernameError; ?></span>
            <?php endif ?>
        </div>
    </body>
</html>