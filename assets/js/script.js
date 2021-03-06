//queries
const videoPlayer = document.querySelector("video");

//functions
window.onscroll = function() {
    const navBar = document.querySelector(".topBar");
    if (navBar) {
        navBarStickyOnScroll();
    }
} 

function navBarStickyOnScroll() {
    const navBar = document.querySelector(".topBar");
    const sticky = navBar.offsetTop;

    if (window.pageYOffset <= sticky) {
        navBar.classList.remove("scrolled");
    } 
    else {
        navBar.classList.add("scrolled");
    }
}

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
    const watch = document.querySelector(".watchNav");
    let timeout = null;

    clearTimeout(timeout);

    timeout = setTimeout(() => {
        watch.classList.add("active");
        }, 2000);
    
    watch.onmousemove = function() {
        clearTimeout(timeout);
        watch.classList.remove("active");
    }

    watch.onmouseleave = function() {
        timeout = setTimeout(() => {
            watch.classList.add("active");
            }, 2000);
    }  
}

function initVideo(videoId, username) {
    startHideTimer();
    setStartTime(videoId, username);
    updateProgressTimer(videoId, username);
}

function updateProgressTimer(videoId, username) {
    addDuration(videoId, username);
    
    let timer;
    const video = document.querySelector("video");

    video.onplaying = function(event) {
        window.clearInterval(timer);
            timer = window.setInterval(function () {
                updateProgress(videoId, username, event.target.currentTime);
            }, 3000);  
    }

    video.onpause = function () {
        window.clearInterval(timer);
    }

    video.onended = function() {
        setFinished(videoId, username);
        window.clearInterval(timer);
    }
    
}
    
function addDuration(videoId, username) {
    //call formData constructor to get PHP data
    const formData = new FormData();
    //pass our key/value pairs to constructor
    formData.append("videoId", videoId);
    formData.append("username", username);

    if (formData !== null && formData !== "") {
        fetch("ajax/addDuration.php", {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .catch(error => {
          console.error('Error:', error);
        });
    }  
}

function updateProgress(videoId, username, progress) {
    
    const formData = new FormData();
   
    formData.append("videoId", videoId);
    formData.append("username", username);
    formData.append("progress", progress);

    if (formData !== null && formData !== "") {
        fetch("ajax/updateDuration.php", {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .catch(error => {
            console.error('Error:', error);
        });
    }  
}
    
function setFinished(videoId, username) {
  
    const formData = new FormData();
 
    formData.append("videoId", videoId);
    formData.append("username", username);

    if (formData !== null && formData !== "") {
        fetch("ajax/setFinished.php", {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .catch(error => {
            console.error('Error:', error);
        });
    }  
}

//convert later to native fetch using the query at top of file:: for now easier with JQuery to save current time
function setStartTime(videoId, username) {

    $.post("ajax/getProgress.php", { videoId: videoId, username: username }, function(data) {
        if(isNaN(data)) {
            alert(data);
            return;
        }

        $("video").on("canplay", function() {
            this.currentTime = data;
            $("video").off("canplay");
        })
    })
}

function restartVideo() {
    const upNext = document.querySelector(".upNext");

    videoPlayer.currentTime = 0;
    videoPlayer.play();

    if (upNext.style.cssText = "display: flex") {
        upNext.setAttribute("style", "display: none");
    } else {
        upNext.setAttribute("style", "display: flex");
    }
}

function watchVideo(videoId) {
    window.location.href = "watch.php?id=" + videoId;
}

function showUpNext() {
    const upNext = document.querySelector(".upNext");
        if (upNext.style.cssText = "display: none") {
            upNext.setAttribute("style", "display: flex");
        } else {
            upNext.setAttribute("style", "display: none");
        }
}