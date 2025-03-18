<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Ensure strikethrough works */
        .strikethrough {
            text-decoration: line-through;
            color: gray; 
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Todo List</h2>
        <br>
        <button id="new-task-btn">New Task</button>
        <br><br>
        <ul>
            <li>Today</li>
            <li>Yesterday</li>
            <li>Last 7 Days</li>
        </ul>
        <hr>
        <h3>List</h3>
        <ul>
            <li>📂 Work Tasks</li>
            <li>📖 Study Goals</li>
            <li>✈️ Travel Plans</li>
            <li>✅ Daily To-Do's</li>
        </ul>
        <hr>
        <ul>
            <li>Scheduled</li>
            <li>Unscheduled</li>
        </ul>
    </div>
    <div class="main-content">
        <div class="task-input">
            <input type="text" id="task-name" placeholder="Task Name">
            <input type="date" id="task-date">
            <button id="add-task">Add Task</button>
        </div>
        <div class="task-lists">
            <h3>Task Lists</h3>
            <p id="current-date"></p>
            <ul id="tasks"></ul>
        </div>
        <div class="completed-tasks">
            <h3>Completed Tasks</h3>
            <ul id="completed-tasks"></ul>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let today = new Date().toISOString().split('T')[0];
            $('#current-date').text('Today: ' + today);

            $('#add-task').click(function() {
                var taskName = $('#task-name').val().trim();
                var taskDate = $('#task-date').val().trim();

                if (taskName) {
                    var taskDisplay = taskDate ? taskName + " - " + taskDate : taskName;
                    var taskId = new Date().getTime(); //Generate unique ID

                    $('#tasks').append(`
                        <li data-id="${taskId}"> <!-- Added data-id -->
                            <span class="task-text">${taskDisplay}</span>
                            <div class="task-actions">
                                <button class="complete">Complete</button>
                                <button class="edit">Edit</button> <!-- Added Edit button -->
                                <button class="delete">Delete</button> <!-- Added Delete button -->
                            </div>
                        </li>
                    `);
                    $('#task-name').val('');
                    $('#task-date').val('');
                }
            });

            //Complete Task
            $(document).on('click', '.complete', function() {
                var completedTask = $(this).closest('li');
                completedTask.find('.complete, .edit, .delete').remove(); //Remove buttons after completion
                completedTask.find('.task-text').addClass('strikethrough');
                $('#completed-tasks').append(completedTask);
            });

            //Edit Task
            $(document).on('click', '.edit', function() {
                var taskElement = $(this).closest('li').find('.task-text');
                var taskText = taskElement.text();
                var newTask = prompt("Edit Task:", taskText);

                if (newTask !== null && newTask.trim() !== "") {
                    taskElement.text(newTask.trim());
                }
            });

            //Delete Task with Confirmation
            $(document).on('click', '.delete', function() {
                var taskItem = $(this).closest('li');
                var taskId = taskItem.data('id');

                if (confirm("Are you sure you want to delete this task?")) {
                    $.post('deleted_task.php', { task_id: taskId }, function(response) {
                        alert(response);
                        taskItem.remove(); //Remove task from the list after successful deletion
                    }).fail(function() {
                        alert("Error deleting task!");
                    });
                }
            });
        });
    </script>
</body>
</html>

