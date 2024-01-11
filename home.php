<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
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
    $sql = "SELECT task, completed FROM todo";
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
                echo "<li>{$row['task']}</li>";
            }
        }
        ?>
    </ul>
    <?php
    $conn->close();
    ?>
    <script src="app.js"></script>
</body>

</html>