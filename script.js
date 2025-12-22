const taskInput = document.getElementById("taskInput");
const addTaskBtn = document.getElementById("addTaskBtn");
const taskList = document.getElementById("taskList");
const clearAllBtn = document.getElementById("clearAllBtn");

// Load tasks from local storage when page loads
document.addEventListener("DOMContentLoaded", loadTasks);

// Add task event
addTaskBtn.addEventListener("click", addTask);

// Clear all tasks event
clearAllBtn.addEventListener("click", clearAllTasks);

// Add a new task
function addTask() {
    const taskText = taskInput.value.trim();
    if (taskText === "") {
        alert("Please enter a task!");
        return;
    }

    // Add to list and local storage
    addTaskToList(taskText);
    saveTaskToLocalStorage(taskText);

    alert("✅ Task added successfully!");
    taskInput.value = "";
}

// Create and display task in the list
function addTaskToList(taskText) {
    const li = document.createElement("li");
    li.textContent = taskText;

    const deleteBtn = document.createElement("button");
    deleteBtn.textContent = "Delete";
    deleteBtn.onclick = function() {
        li.remove();
        removeTaskFromLocalStorage(taskText);
    };

    li.appendChild(deleteBtn);
    taskList.appendChild(li);
}

// Save a task to local storage
function saveTaskToLocalStorage(taskText) {
    let tasks = JSON.parse(localStorage.getItem("tasks")) || [];
    tasks.push(taskText);
    localStorage.setItem("tasks", JSON.stringify(tasks));
}

// Load tasks from local storage
function loadTasks() {
    let tasks = JSON.parse(localStorage.getItem("tasks")) || [];
    tasks.forEach(task => addTaskToList(task));
}

// Remove specific task from local storage
function removeTaskFromLocalStorage(taskText) {
    let tasks = JSON.parse(localStorage.getItem("tasks")) || [];
    tasks = tasks.filter(task => task !== taskText);
    localStorage.setItem("tasks", JSON.stringify(tasks));
}

// Clear all tasks
function clearAllTasks() {
    if (confirm("Are you sure you want to clear all tasks?")) {
        localStorage.removeItem("tasks");
        taskList.innerHTML = "";
    }
}
