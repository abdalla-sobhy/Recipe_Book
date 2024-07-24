window.addEventListener('load', function () {
    let editId;

    let deleteButton = document.querySelectorAll(".deleteButtonDiv");
    let editButton = document.querySelectorAll(".editButtonDiv")
    deleteButton.forEach(element => {
        element.addEventListener("click", function(){
            window.location.href = "index.php?Did=" + encodeURIComponent(element.id);
        });
    })
    editButton.forEach(element => {
        element.addEventListener("click", function(){
            editId = element.id
            window.location.href = "index.php?Eid=" + encodeURIComponent(editId);
        })
    })
})


