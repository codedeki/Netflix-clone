<?php

require_once("includes/header.php");

if (!isset($_GET["id"])) {
    ErrorMessage::show("No ID passed into url");
}

$video = new Video($con, $_GET["id"]);
$video->incrementViews();
?>

<div class="watchContainer">

    <div class="videoControls watchNav">
        <button onclick="goBack()"><img src="assets/images/arrow-left.png" alt="go back"></button>
        <h1><?php echo $video->getTitle(); ?></h1>
    </div>

    <video controls autoplay>
        <source src='<?php echo $video->getFilePath(); ?>' type="video/mp4">
    </video>
</div>

<script>
    document.onmousemove = function () {
        initVideo("<?php echo $video->getId(); ?>", "<?php echo $userLoggedIn; ?>");
    }
</script>