<!--get query from databse for 1 of 3 security questions and a seperate query for their email using php-->
<!--send them their login info on verification of credentials using mailto in html and getting the infor from the database query using php-->
<!--EZ Clap-->
<?php
    session_start();

    //Connect to the database
    $dbHandle = mysqli_connect("localhost", "remote_user", "Applebanana1!", "users");

    //Check database connection
    if(!$dbHandle) {
	    print("Could not connect to the database.");
	    //print(mysqli_connect_error());

	    die(); //Kills process if unable to connect to the database
    }

    
    if(isset($_POST["submit"]))
    {

        $username = $_SESSION['username'];
        $email = $_POST['email'];
        $query4 = "SELECT * FROM users WHERE user_email='$email'";
        //$query2 = mysqli_fetch_array($query2);
        //mysqli_select_db('users');
        $retval = mysqli_query($dbHandle, $query4);

        if(! $retval ) {
            die('Could not get data: ' . mysqli_error());
        }
        //$row = mysql_fetch_assoc($retval);
        while($row = mysqli_fetch_assoc($retval)){
            $pasword = $row['user_password'];
            $securityq1 = $row['securityq1'];
            $securityq2 = $row['securityq2'];
            $securityq3 = $row['securityq3'];
        }
        $correctAnswer = false;


        if($_POST["securityq1"] != '')
        {
            //Query DB for question answer. If true, set $correctAnswer to true.
            //$correctAnswer = true;
            if($_POST["securityq1"] == $securityq1)
            {
                $correctAnswer = true;
            }

        }
        else if($_POST["securityq2"] != '')
        {
            //Query DB for question answer. If true, set $correctAnswer to true.
            //$correctAnswer = true;
            if($_POST["securityq3"] == $securityq3)
            {
                $correctAnswer = true;
            }
        }
        else if($_POST["security3"] != '')
        {
            //Query DB for question answer. If true, set $correctAnswer to true.
            //$correctAnswer = true;
            if($_POST["securityq3"] == $securityq3)
            {
                $correctAnswer = true;
            }
        }
        else
        {
            echo "You have to answer at least one question.";
        }
    }

    if($correctAnswer)
    {
        $_SESSION["EMAIL"] = $_POST["email"];
        //Query DB for username
        $_SESSION["username"] = $username;
        $_SESSION["SUBJECT"] = "Forgot username or password";
        //Query DB for password
        $_SESSION["password"] = $pasword;
        $_SESSION["Body"] = "You are receiving this email because you forgot your username and password.\nUsername: " . $_SESSION["username"] . "\nPassword: " . $_SESSION["password"];
        $_SESSION["hadForgotten"] = true;
        $_SESSION["redirect"] = "location: http://172.18.30.210/login.php";
        header("location: http://172.18.30.210/sendMail.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Forgot username or password</title>
        <meta charset="UTF-8">
    </head>
    <body>
	    <h1>Forgot your username or password?</h1>
	    <h3>We'll send you a recovery email. Please enter your email address in the box below and answer ONLY ONE of the security questions.</h3>
	    <form name="form" method="post" action="http://172.18.30.210//forgotUserOrPass.php">
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