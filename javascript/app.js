let tasks = document.querySelectorAll(".task");

tasks.forEach((task) => {
    console.dir(task.children);
    task.children[1].addEventListener("click", (e) => {
        task.children[0].classList.add("hide");
        task.children[1].classList.add("hide");
        task.children[2].classList.remove("hide");
    });
});
