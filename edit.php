<?php

require_once "database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    if (isset($_POST['editContent'])) {
        $task = $_POST['todo'];
        $id = $_POST['id'];

        if (!empty($task)) {
            $sql = "UPDATE todo
            SET task = '$task'
            WHERE id = '$id'";
            if (!$conn->query($sql)) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            } else {
                header("Location: /todo-list/home.php");
                die();
            }
        }
    }
}
