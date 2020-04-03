<?php

require_once("includes/header.php");

if (!isset($_GET["id"])) {
    ErrorMessage::show("No ID passed into url");
}

$video = new Video($con, $_GET["id"]);
$video->incrementViews();
$upNextVideo = VideoProvider::getUpNext($con, $video);
?>

<div class="watchContainer">

    <div class="videoControls watchNav">
        <button onclick="goBack()"><img src="assets/images/arrow-left.png" alt="go back"></button>
        <h1><?php echo $video->getTitle(); ?></h1>
    </div>

    <div class="videoControls upNext" style="display: none">
        <button onclick="restartVideo()"><img src="assets/images/restart.png" alt="restart"></button>

        <div class="upNextContainer">
            <h2>Up next:</h2>
            <h3><?php echo $upNextVideo->getTitle(); ?></h3>
            <h3><?php echo $upNextVideo->getSeasonAndEpisode(); ?></h3>

            <button class="playNext" onclick="watchVideo(<?php echo $upNextVideo->getId(); ?>)"><img src="assets/images/play-white.png" alt="">Play</button>
        </div>
    </div>

    <video controls autoplay onended="showUpNext()">
        <source src='<?php echo $video->getFilePath(); ?>' type="video/mp4">
    </video>
</div>

<script>
        initVideo("<?php echo $video->getId(); ?>", "<?php echo $userLoggedIn; ?>");
</script>