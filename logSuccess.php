<?php
    session_start(); //Start the php session
    
    //Connect to the database
    $dbHandle = mysqli_connect("localhost", "ejoreillyiv22", "fBLt4pwiyH9CQ8z", "COMP424");
    
    //Check the database connection
    if(!$dbHandle) {
	    print("Could not connect to the database.");
	    print(mysqli_connect_error());
            
	    die(); //Kills process if unable to connect to the database
    }
    
    $username = $_SESSION['username'];
    $query2 = "SELECT * FROM Register WHERE username='$username'";
	    	    $row = mysqli_fetch_array($query2);
	    	    $firstname = $row['firstname'];
	    	    print($firstname);
    
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
	    <h1>Hi, <?php  print $firstname; ?> </h1>
        <h2>You have logged in a total of <?php  print $ertygt; ?> times.<h2>
        <h2>Last login date: <?php  print $lastLoginDate; ?> </h2>
	    <button type="button" id="button" >Click Me!</button><br><br>
	        <form method="get" action="http://192.168.1.23/login.php" >
                <label>
                    <input type="submit" value="Logout" id="logout" name="logout"><br><br>
	            </label>
            </form>
            <a href="company_confidential_file.txt" download="filename">Download company_confidential_file.txt</a>
    </body>
</html>
