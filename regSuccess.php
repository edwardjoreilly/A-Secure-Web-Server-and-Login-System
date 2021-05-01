<?php
    session_start();

    //Connect to the database
    $dbHandle = mysqli_connect("localhost", "ejoreillyiv22", "fBLt4pwiyH9CQ8z", "COMP424");

    //Check database connection
    if(!$dbHandle) {
	    print("Could not connect to the database.");
	    print(mysqli_connect_error());

	    die(); //Kills process if unable to connect to the database
    }

    $username = ($_SESSION["username"]);
    $password = ($_SESSION["password"]);
    $firstname = ($_SESSION["firstname"]);
    $lastname = ($_SESSION["lastname"]);
    $birthday = ($_SESSION["birthday"]);
    $email = ($_SESSION["email"]);
    $securityq1 = ($_SESSION["securityq1"]);
    $securityq2 = ($_SESSION["securityq2"]);
    $securityq3 = ($_SESSION["securityq3"]);

    $sql = "SELECT * FROM Register WHERE username ='$username'"; //Send query to database
    $res = mysqli_query($dbHandle, $sql); //Get query results

	//Create query and send it to the database to create a new user
	//Then redirect the user to the Registration Success page
	$query = "INSERT INTO Register (username, password, firstname, 
     lastname, birthday, email, securityq1, securityq2, securityq3) VALUES ('$username','$password', '$firstname', '$lastname', '$birthday', '$email', '$securityq1', '$securityq2', '$securityq3')";
    $results = mysqli_query($dbHandle, $query);
    $_SESSION['username'] = $username;
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
	<form method="get" action="http://192.168.1.23/login.php">
	    <label>
                <input type="submit" value="Login" name="login">
	    </label>
        </form>
    </body>
</html>
