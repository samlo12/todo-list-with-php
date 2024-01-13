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

<form action="register.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" autofocus>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
    <input type="submit" name="register" value="Register">
</form>

<?php require_once "./boilerplate/footer.php" ?>