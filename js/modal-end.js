document.querySelector("#endProject").addEventListener("click", function() {
    console.log("klik");
    document.querySelector(".container--modal--end").style.display = "flex";
});

document.querySelector("#closeModalEnd").addEventListener("click", function() {
    document.querySelector(".container--modal--end").style.display = "none";
});

document.querySelector("#refuse").addEventListener("click", function() {
    document.querySelector(".container--modal--end").style.display = "none";
});