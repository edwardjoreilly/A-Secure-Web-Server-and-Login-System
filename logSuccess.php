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
	    <h1>Hi, <?php  print $firstname; ?> <?php  print $lastname; ?></h1>
        <h2>You have logged in <?php  print $numberOfLogins; ?> times<h2>
        <h2>Last login date: <?php  print $lastLoginDate; ?> </h2>
	    <button type="button" id="button" >Click Me!</button><br><br>
	        <form method="get" action="http://192.168.56.103/login.php" >
                <label>
                    <input type="submit" value="Logout" id="logout" name="logout"><br><br>
	            </label>
            </form>
            <a href="company_confidential_file.txt" download="filename">Download company_confidential_file.txt</a>
    </body>
</html>
