<?php

if (isset($_SESSION["error"])) {
    echo $_SESSION["error"] . "<br><br>";
    unset($_SESSION["error"]);
    die();
}

?>