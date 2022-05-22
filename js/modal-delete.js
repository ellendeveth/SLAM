document.querySelector("#deleteAccount").addEventListener("click", function() {
    console.log("klik");
    document.querySelector(".container--modal").style.display = "flex";
});

document.querySelector("#closeModal").addEventListener("click", function() {
    document.querySelector(".container--modal").style.display = "none";
});