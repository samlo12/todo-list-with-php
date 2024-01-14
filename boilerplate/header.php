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

    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/todo-list/home.php">Todo List</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="/todo-list/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/todo-list/logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/todo-list/register.php">Register</a>
                    </li>
                    <?php
                    session_start();
                    if (isset($_SESSION['id'])) {
                        require_once "database.php";
                        $userId = $_SESSION["id"];
                        $sql = "SELECT username FROM user WHERE id = '$userId'";
                        $result = $conn->query($sql);

                        while ($row = $result->fetch_assoc()) {
                            $username = $row['username'];
                            echo "
                            <li class='nav-item nav-link ms-auto'>
                                $username
                            </li>
                            ";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>