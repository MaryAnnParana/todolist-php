<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'], $_POST['task_name'])) {
    $taskId = intval($_POST['task_id']);
    $taskName = mysqli_real_escape_string($conn, $_POST['task_name']);

    $query = "UPDATE tasks SET task_name = '$taskName' WHERE id = '$taskId'";
    if (mysqli_query($conn, $query)) {
        echo "Task updated successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
