let btn = document.querySelector("#upload-btn");

btn.addEventListener("click", function() {
    let file = document.querySelector(".upload-file")
    if(file.style.display === "none") {
        file.style.display = "block";
    } else {
        file.style.display = "none"
    }
})
