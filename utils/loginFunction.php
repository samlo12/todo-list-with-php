
<?php
session_start();

function login($id)
{
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $id;
}

?>