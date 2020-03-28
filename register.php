<?php 

if (isset($_POST["submitButton"])) {
 
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up to Netflix</title>
    <link rel="stylesheet" type="text/css" href="assets/styles/style.css">
</head>
<body>
    
    <div class="signInContainer">
        <div class="column">

            <div class="header">
                <div class="netflixLogo">
                    <img src="assets/images/netflixnchilli.png" title="Netflix N Chilli" alt="Netflix N Chilli Logo">
                </div>
                <div class="chilliImage">
                    <img src="assets/images/chillisauce.jpg" alt="chilli sauce">
                </div>
                <h3>Sign Up</h3>
                <span>to continue to Netflix N Chilli</span>
            </div>
        
            <form method="POST">
                <input type="text" name="firstName" placeholder="First Name" required>
                <input type="text" name="lastName" placeholder="Last Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email1" placeholder="Email" required>
                <input type="email" name="email2" placeholder="Confirm Email" required>
                <input type="password" name="password1" placeholder="Password" required>
                <input type="password" name="password2" placeholder="Confirm Password" required>
                <input type="submit" name="submitButton" value="SIGN UP">
            </form>

            <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>
        </div>
    </div>
</body>
</html>