<?php
    session_start(); //Start the php session
    
    //Connect to the database
    $dbHandle = mysqli_connect("localhost", "remote_user", "Applebanana1!", "users");
    
    //Check the database connection
    if(!$dbHandle) {
	    print("Could not connect to the database.");
	    print(mysqli_connect_error());
            
	    die(); //Kills process if unable to connect to the database
    }
    
    $username = $_SESSION['username'];
    $query2 = "SELECT * FROM users WHERE username='$username'";
	    	    //$query2 = mysqli_fetch_array($query2);
                //mysqli_select_db('users');
                $retval = mysqli_query($dbHandle, $query2);

                if(! $retval ) {
                    die('Could not get data: ' . mysqli_error());
                 }
                //$row = mysql_fetch_assoc($retval);
                while($row = mysqli_fetch_assoc($retval)){
                    $firstname = $row['first_name'];
                    $lastname = $row['last_name'];
                    $numberOfLogins = $row['number_of_logins'];
                    $lastLoginDate = $row['last_login'];
                }
                 

                // $firstname = $row['first_name'];
                // $lastname = $row['last_name'];
                // $numberOfLogins = $row['number_of_logins'];
                // $lastLoginDate = $row['last_login'];

	    	    //$_SESSION['firstname'] = $row['first_name'];
                // $firstname = $row[0];
                // $lastname = $row[1];
                // $numberOfLogins = $row[2];
                // $lastLoginDate = $row[3];
	    	    //print($firstname);
 
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login Successful!</title>
	<meta charset = "UTF-8">
    <script>
        function colorChange() {
		var randomColor = Math.floor(Math.random()*16777215).toString(16);
		document.body.style.backgroundColor = "#" + randomColor;
	}

        function start() {
		myButton = document.getElementById("button");
		
		myButton.addEventListener("click", colorChange);
                colorChange();
        }
        
        window.addEventListener("load", start);
    </script>
    </head>
    <body>
	    <h1>Hi, <?php print $firstname; ?> <?php echo $lastname; ?></h1>
        <h2>You have logged in <?php echo $numberOfLogins; ?> times<h2>
        <h2>Last login date: <?php echo $lastLoginDate; ?> </h2>
	    <button type="button" id="button" >Click Me!</button><br><br>
	        <form method="get" action="http://172.18.30.210/login.php" >
                <label>
                    <input type="submit" value="Logout" id="logout" name="logout"><br><br>
	            </label>
            </form>
            <a href="company_confidential_file.txt" download="filename">Download company_confidential_file.txt</a>
    </body>
</html>
