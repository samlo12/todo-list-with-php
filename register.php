<?php
require_once "database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    if (!empty($username) && !empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (username, password)
VALUES ('$username', '$hashed_password')";
        if (!$result = $conn->query($sql)) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        } else {
            require_once "utils/loginFunction.php";
            login($conn->insert_id);
            header("Location: /todo-list/home.php");
            die();
        }
    }
}



?>

<?php require_once "./boilerplate/header.php" ?>

<div class="container w-50">
    <div class="card p-3">
        <form action="register.php" method="POST">
            <label for="username" class="form-label">Username</label>
            <input class="form-control mb-2" type="text" name="username" id="username" autofocus>
            <label for="password" class="form-label">Password</label>
            <input class="form-control mb-2" type="password" name="password" id="password">
            <input class="btn btn-primary" type="submit" name="register" value="Register">
        </form>
    </div>
</div>
<?php require_once "./boilerplate/footer.php" ?>