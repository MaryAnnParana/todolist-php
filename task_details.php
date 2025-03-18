<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tasks WHERE id=$id";
    $result = $conn->query($sql);
    $task = $result->fetch_assoc();

    //Fetch subtasks
    $subtaskSql = "SELECT name FROM subtasks WHERE task_id=$id";
    $subtaskResult = $conn->query($subtaskSql);
    $subtasks = [];
    while ($row = $subtaskResult->fetch_assoc()) {
        $subtasks[] = $row['name'];
    }

    echo json_encode([
        "task" => $task['task'],
        "subtasks" => $subtasks
    ]);
}
?>
