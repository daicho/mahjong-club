<?php
    define("CORRECT_PASSWORD", "v7qcrj8e");

    session_start();

    $password = $_POST["password"];

    if ($password == CORRECT_PASSWORD) {
        session_regenerate_id(true);
        $_SESSION["LOGIN"] = "1";
        header("Location: /");
    } else {
        header("Location: /login.php?failed=1");
    }
