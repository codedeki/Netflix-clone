<?php 
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($con);

if (isset($_POST["submitButton"])) {

    $username = FormSanitizer::sanitizeFormUsername($_POST['username']);
    $password = FormSanitizer::sanitizeFormPassword($_POST['password']);

    $success = $account->login($username, $password);

    if ($success) {
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
    }
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
                <h3>Sign In</h3>
                <span>to continue to Netflix N Chilli</span>
            </div>
        
            <form method="POST">
                <?php echo $account->getError(Constants::$loginFailed); ?>
                <input type="text" name="username" placeholder="Username" value="<?php echo $account->getInputValue("username"); ?>" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="submitButton" value="LOG IN">
            </form>

            <a href="register.php" class="signInMessage">Don't have an account yet? Sign up here!</a>
        </div>
    </div>
</body>
</html>