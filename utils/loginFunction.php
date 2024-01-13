
<?php
session_start();

function login($id)
{
    // Unset all of the session variables
    $_SESSION = array();

    // collect value of input field
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $id;
}

?>