<?php
require_once "database.php";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    // collect value of input field
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (!empty($username) && !empty($password)) {
        $sql = "SELECT id, username, password FROM user
        WHERE username = '$username'";
        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $hashed_password = $row['password'];
                if (password_verify($password, $hashed_password)) {
                    require_once "utils/loginFunction.php";
                    login($row['id']);
                    header("Location: /todo-list/home.php");
                    die();
                }
            }
        } else {
            $error = "Incorret Username/Password. Please try again.";
        }
    }
}

$conn->close();
?>

<?php require_once "./boilerplate/header.php" ?>

<form action="login.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" autofocus>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
    <input type="submit" name="login" value="Login">
</form>

<?php require_once "./boilerplate/footer.php" ?>