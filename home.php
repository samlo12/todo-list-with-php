<?php require_once "./boilerplate/header.php" ?>
<?php
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<div class="container w-50">
    <div class="card p-3">
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

        <form class="row mb-3" action="home.php" method="POST">
            <div class="col-10">
                <input autofocus type="text" class="form-control" name="todo" id="todo" placeholder="Enter a new task">
            </div>
            <input class="col-2 btn btn-success" type="submit" name="create" value="Create">
        </form>
        <ul>
            <?php
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    echo "<li class='my-3'>";
                    echo "<div class='row task'>";
                    echo "<span class='text col-8'>{$row['task']}</span>";
            ?>
                    <div class="col-2">
                        <button class="editBtn btn btn-primary w-100">Edit</button>
                    </div>
                    <form class="hide col-10" action="edit.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" class="form-control" name="todo" id="todo" value="<?php echo $row['task'] ?>" placeholder="Task">
                            </div>
                            <div class="col-2">
                                <input type="submit" class="btn btn-primary w-100" name="editContent" value="Ok">
                            </div>
                        </div>
                    </form>
            <?php
                    echo "
                    <div class='col-2'>
                    <a class='btn btn-danger w-100' href='delete.php?id=$id'>Delete</a>
                    </div>
                    ";
                    echo "</div>";
                    echo "</li>";
                }
            };
            ?>

        </ul>
        <?php
        $conn->close();
        ?>
    </div>
</div>
<?php require_once "./boilerplate/footer.php" ?>