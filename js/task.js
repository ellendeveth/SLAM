document.querySelector("#btnSubmit").addEventListener("click", e => {
    //tekst uitlezen
    e.preventDefault();
    let task = document.querySelector("#task").value;
    let postId = e.target.dataset.postid;
    let userId = e.target.dataset.userid;
    
    // via ajax naar server posten
    let data = new FormData();
    data.append("task", task);
    data.append("postid", postId);
    data.append("userid", userId);

    fetch('ajax/save__task.php', {
      method: 'POST', // or 'PUT'
      body: data,
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        if(data.status === "success"){
            let div = `<div class="checkbox__task">
            <div class="checkbox__task__info">
            <input class="filter__checkbox--active" type="checkbox" name="language" value="nl">
            <p>${data.data.task}</p>
            </div>
            </div>
            `
            document.querySelector(".task__container").innerHTML += div;
            document.querySelector(".container--modal").style.display = "none";
        }
    })
    
    .catch((error) => {
      console.error('Error:', error);
    });
    
    
});