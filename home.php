<?php require_once "./boilerplate/header.php" ?>
<?php
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<div>
    <?php
    require "database.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
        // collect value of input field
        $task = $_POST['todo'];
        $userId = $_SESSION["id"];
        if (!empty($task)) {
            $sql = "INSERT INTO todo (task, completed, user_id)
VALUES ('$task', false, '$userId')";
            if (!$conn->query($sql)) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    ?>

    <?php
    $userId = $_SESSION["id"];
    $sql = "SELECT id, task, completed FROM todo WHERE user_id = '$userId'";
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