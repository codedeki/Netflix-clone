
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







