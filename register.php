<?php 
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($con);


if (isset($_POST["submitButton"])) {
 
    $firstName = FormSanitizer::sanitizeFormString($_POST['firstName']);
    $lastName = FormSanitizer::sanitizeFormString($_POST['lastName']);
    $username = FormSanitizer::sanitizeFormUsername($_POST['username']);
    $email = FormSanitizer::sanitizeFormEmail($_POST['email']);
    $email2 = FormSanitizer::sanitizeFormEmail($_POST['email2']);
    $password = FormSanitizer::sanitizeFormPassword($_POST['password']);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST['password2']);

    $success = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

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
                <h3>Sign Up</h3>
                <span>to continue to Netflix N Chilli</span>
            </div>
        
            <form method="POST">
                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                <input type="text" name="firstName" placeholder="First Name" value="<?php echo $account->getInputValue("firstName"); ?>" required>
                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                <input type="text" name="lastName" placeholder="Last Name" value="<?php echo $account->getInputValue("lastName"); ?>" required>
                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                <?php echo $account->getError(Constants::$usernameTaken); ?>
                <input type="text" name="username" placeholder="Username" value="<?php echo $account->getInputValue("username"); ?>" required>
                <?php echo $account->getError(Constants::$emailsDontMatch); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <input type="email" name="email" placeholder="Email" value="<?php echo $account->getInputValue("email"); ?>" required>
                <input type="email" name="email2" placeholder="Confirm Email" value="<?php echo $account->getInputValue("email2"); ?>" required>
                <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                <?php echo $account->getError(Constants::$passwordLength); ?>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password2" placeholder="Confirm Password" required>
                <input type="submit" name="submitButton" value="SIGN UP">
            </form>

            <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>
        </div>
    </div>
</body>
</html>