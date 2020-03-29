<?php
require_once("includes/config.php");

if (!isset($_SESSION["userLoggedIn"])) {
    header("Location: register.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Netflix</title>
</head>
<body>

<h1>Welcome to Netflix</h1>
    
</body>
</html>