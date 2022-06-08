document.querySelector("#addTask").addEventListener("click", function() {
    document.querySelector(".container--modal").style.display = "flex";
});

document.querySelector("#closeModal").addEventListener("click", function() {
    document.querySelector(".container--modal").style.display = "none";
});