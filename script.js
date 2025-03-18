$(document).on('click', '.delete', function() {
    var taskId = $(this).closest('li').data('id');

    if (confirm('Are you sure you want to delete this task?')) {
        $.post('deleted_task.php', { task_id: taskId }, function(response) {
            alert(response);
            location.reload(); //Refresh after deleting
        });
    }
});

//Edit Task
$(document).on('click', '.edit', function() {
    var taskId = $(this).closest('li').data('id');
    var taskText = $(this).closest('li').find('.task-text').text();

    var newTask = prompt('Edit Task:', taskText);
    if (newTask !== null) {
        $.post('edit_task.php', { task_id: taskId, task_name: newTask }, function(response) {
            alert(response);
            location.reload(); //Refresh after editing
        });
    }
});




    





