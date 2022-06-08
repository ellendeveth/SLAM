document.querySelector("#addDocument").addEventListener("click", function() {
    document.querySelector(".container--modal--doc").style.display = "flex";
});

document.querySelector("#closeModalDoc").addEventListener("click", function() {
    document.querySelector(".container--modal--doc").style.display = "none";
});