<?php require_once "./boilerplate/header.php" ?>
<div>
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
</div>
<?php require_once "./boilerplate/footer.php" ?>