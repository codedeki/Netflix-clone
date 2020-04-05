<?php
include_once("includes/header.php");
?>

<div class="textboxContainer">
    <input type="text" id="searchInput" class="searchInput" placeholder="Search for something">
</div>

<div class="results"></div>

<script>



    let username = '<?php echo $userLoggedIn; ?>';
    let timer;

    $(".searchInput").keyup(function() {
        clearTimeout(timer);

        timer = setTimeout(() => {
            let val = $(".searchInput").val();

            if (val != "") {
                $.post("ajax/getSearchResults.php", { term: val, username: username}, function (data) {
                    $(".results").html(data); //injeect php data into html
                })
            }
            else {
                $(".results").html("");
            }
        }, 500);
    })

    //Convert later to Vanilla JS using FETCH: How to inject PHP data into html? What I have so far:

    // let searchInput = document.getElementById("searchInput");
    // searchInput.addEventListener("keyup", (e) => {
    //     clearTimeout(timer);
    //     timer = setTimeout(() => {
            
    //         if (searchInput != "") {
    //             const formData = new FormData();
   
    //             formData.append("term", searchInput);
    //             formData.append("username", username);

    //                 fetch("ajax/getSearchResults.php", {
    //                     method: 'POST',
    //                     body: formData,
    //                 })
    //                 .then(response => response.text(formData))
    //                 .catch(error => {
    //                     console.error('Error:', error);
    //                 });
    //         }
    //         else {
    //             let results = document.querySelector(".results").textContent = "";
    //         }
    //     }, 500);
    // })

</script>