<?php
include 'db.php';

if (isset($_POST['id'])) {
    $taskId = $_POST['id'];
    $query = "UPDATE tasks SET status='completed' WHERE id=$taskId";
    if (mysqli_query($conn, $query)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>


