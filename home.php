<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="./style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <?php
    require_once "database.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
        // collect value of input field
        $task = $_POST['todo'];
        if (!empty($task)) {
            $sql = "INSERT INTO todo (task, completed, user_id)
VALUES ('$task', false, '1')";
            if (!$conn->query($sql)) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    ?>

    <?php
    $sql = "SELECT id, task, completed FROM todo";
    $result = $conn->query($sql);
    ?>

    <form action="home.php" method="POST">
        <input type="text" name="todo" id="todo" placeholder="Enter a new task">
        <input type="submit" name="create" value="Create">
    </form>
    <ul>
        <?php
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                echo "<li class='task'>";
                echo "<span class='text'>{$row['task']}</span>";
        ?>
                <button class="editBtn">Edit</button>

                <form class="hide" action="edit.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="text" name="todo" id="todo" value="<?php echo $row['task'] ?>" placeholder="Task">
                    <input type="submit" name="editContent" value="Edit">
                </form>
        <?php
                echo "<a href='delete.php?id=$id'>Delete</a>";
                echo "</li>";
            }
        };
        ?>

    </ul>
    <?php
    $conn->close();
    ?>
    <script src="javascript/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>