
function volumeToggle(button) {
    //when you click the button it always does the opposite of what is currently set
    const toggleMute = document.querySelector(".previewVideo").muted = !document.querySelector(".previewVideo").muted;
    let img = document.getElementById("volumeMainPage");

    if (img.src.match('assets/images/volume-mute.png')) img.src = "assets/images/volume.png";
    else img.src = "assets/images/volume-mute.png";

    return false;
 }

function previewEnded() {
    let imageToggle = document.querySelector(".previewImage");
    let videoToggle = document.querySelector(".previewVideo");
        imageToggle.removeAttribute("hidden");
        videoToggle.setAttribute("hidden", "true");
}

function goBack() {
    window.history.back();
  }

function startHideTimer() {
    let timeout = null;
    
        clearTimeout(timeout);
        const watch = document.querySelector(".watchNav");
            watch.classList.remove("active");
    
        timeout = setTimeout(() => {
            watch.classList.add("active");
            }, 2000);
    }

function initVideo(videoId, username) {
    startHideTimer();
    // updateProgressTimer(videoId, username);
}

function updateProgressTimer(videoId, username) {
    addDuration(videoId, username);

    let timer;

    const video = document.query("video");
    console.log(video);

}

function addDuration(videoId, username) {

    const data = { videoId: videoId, username: username };
    
    if (data !== null && data !== "") {
        
    }
    
    fetch("ajax/addDuration.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })

    .then((response) => response.json())
    .then((data) => {
      console.log(data); 
    })
    .catch((error) => {
      console.error('Error:', error);
    });
}