var addCategory = document.getElementById("add-category");
addCategory.addEventListener("click", function(event) {
  let newForm = document.createElement('form');
    newForm.setAttribute("action", jsUrl);
    newForm.setAttribute("method", "post");
    let newTextInput = document.createElement('input');
    newTextInput.setAttribute("type", "text");
    newTextInput.setAttribute("name", "category-name");
    let newLabel = document.createElement('label');
    newLabel.setAttribute("for","category-name");
    newLabel.innerHTML = "Category Name:";
    let newSubmit = document.createElement('input');
    newSubmit.setAttribute("type","submit");
    newSubmit.setAttribute("value", "add");
    newForm.appendChild(newLabel);
    newForm.appendChild(newTextInput);
    newForm.appendChild(newSubmit);
    event.target.parentElement.parentElement.appendChild(newForm);
    event.target.parentElement.parentElement.removeChild(event.target.parentElement);
});

function renderStatusColor() {
    var statusFields = document.getElementsByClassName("task-status-text");

    for (statusField of statusFields) {
        let status = statusField.innerHTML;
        switch (status) {
            case "Open":
                statusField.parentNode.parentNode.style.backgroundColor = "#FF6E00";
                break;
            case "Test":
                statusField.parentNode.parentNode.style.backgroundColor = "#F8D801";
                break;
            case "Complete":
                statusField.parentNode.parentNode.style.backgroundColor = "#45E629";
                break;
            default:
                console.log("you're all noobs");
        }
    }
}

function dropdown(categoryId) {
    document.getElementById("dropdown-menu-" + categoryId.toString()).classList.add('show');
}

function dropdownTask(taskId) {
    document.getElementById("dropdown-menu-status-" + taskId.toString()).classList.add('show');
}


window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function renderAddTask(categoryId) {
    document.getElementById("overlay").classList.add('show');
    let overlay = document.getElementById("overlay-form");
    overlay.classList.add('show');
    let categoryField = document.createElement('input');
    categoryField.setAttribute("id", "categoryIdField");
    categoryField.setAttribute("type", "number");
    categoryField.setAttribute("name", "category-id");
    categoryField.setAttribute("style", "display: none;");
    categoryField.setAttribute("value", categoryId);
    overlay.children[1].appendChild(categoryField);
}

function renderEditTask(taskId, name, status, priority, severity) {
    document.getElementById("overlay").classList.add('show');
    let overlay = document.getElementById("overlay-form-edit-task");
    overlay.classList.add('show');
    let categoryField = document.createElement('input');
    categoryField.setAttribute("id", "taskIdField");
    categoryField.setAttribute("type", "number");
    categoryField.setAttribute("name", "task-id");
    categoryField.setAttribute("style", "display: none;");
    categoryField.setAttribute("value", taskId);
    overlay.children[1].appendChild(categoryField);

    let nameInput = document.getElementById('edit-task-name-input');
    let statusInput = document.getElementById('edit-task-status-input');
    let priorityInput = document.getElementById('edit-task-priority-input');
    let severityInput = document.getElementById('edit-task-severity-input');

    nameInput.value = name;
    statusInput.value = status;
    priorityInput.value = priority;
    severityInput.value = severity;
}

function closeOverlay() {
    document.getElementById("overlay").classList.remove('show');
    let overlayForm = document.getElementById("overlay-form");
    overlayForm.classList.remove('show');
    overlayForm.children[1].removeChild(document.querySelector("#categoryIdField"));
}

function closeEditTaskOverlay() {
    document.getElementById("overlay").classList.remove('show');
    let overlayForm = document.getElementById("overlay-form-edit-task");
    overlayForm.classList.remove('show');
    overlayForm.children[1].removeChild(document.querySelector("#taskIdField"));
}

function deleteTask(taskId) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "delete_task.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    console.log(taskId);
    xhttp.send(`task=${taskId}`);

    document.getElementById("task-" + taskId).remove();
}

function updateStatus(taskId, event) {
    let newStatus = event.target.getAttribute("data-name")
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "update_task.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //console.log(taskId);
    xhttp.send(`task=${taskId}&status=${newStatus}`);

    document.getElementById(`status-text-${taskId}`).innerHTML = newStatus;
    renderStatusColor();
}

function addNewCategory(project_id) {
  xhttp.open("POST", "add_category.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
}

function resetIcons(target) {
    let iconParents = target.parentNode.parentNode.children;
    console.log(iconParents);
    for (let iconParent of iconParents) {
        iconParent.children[1].setAttribute('src',"resources/sortButton.png");
    }
}

function sortName(event) {
    let tasks = event.target.parentNode.parentNode.nextElementSibling.children;
    let taskParent = event.target.parentNode.parentNode.nextElementSibling;
    let icon = event.target;
    let sortType = event.target.previousElementSibling.innerHTML.toLowerCase();
    // status runs differently, so here's a hack
    if (sortType == "status")
        sortType="status-text";
    if (event.target.getAttribute('src') == "resources/sortButton.png" || event.target.getAttribute('src') == "resources/sortUpPressed.png") {
        var swapped;
        do {
            swapped = false;
            for (var i = 0; i < tasks.length - 1; i++) {
                if (tasks[i].getElementsByClassName(`task-${sortType}`)[0].innerHTML.toLowerCase() > tasks[i + 1].getElementsByClassName(`task-${sortType}`)[0].innerHTML.toLowerCase()) {
                    var temp = tasks[i];
                    taskParent.replaceChild(tasks[i + 1], tasks[i]);
                    taskParent.appendChild(temp);
                    swapped = true;
                }
            }
        } while (swapped);
        resetIcons(event.target);
        icon.setAttribute('src', "resources/sortDownPressed.png");
    }
    else {
        var swapped;
        do {
            swapped = false;
            for (var i=0; i < tasks.length-1; i++) {
                if (tasks[i].getElementsByClassName(`task-${sortType}`)[0].innerHTML.toLowerCase() < tasks[i+1].getElementsByClassName(`task-${sortType}`)[0].innerHTML.toLowerCase()) {
                    var temp = tasks[i];
                    taskParent.replaceChild(tasks[i+1], tasks[i]);
                    taskParent.appendChild(temp);
                    swapped = true;
                }
            }
        } while (swapped);
        resetIcons(event.target);
        icon.setAttribute('src', "resources/sortUpPressed.png");
    }
}
