<?php

require_once "database.php";

// collect value of input field
if (isset($_GET['id'])) {

    $id = $_GET['id'];


    $sql = "DELETE FROM todo
            WHERE id = '$id'";
    if (!$conn->query($sql)) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
        header("Location: /todo-list/home.php");
        die();
    }
}
