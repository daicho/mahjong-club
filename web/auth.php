<?php
    define('HASH', '$2y$10$Iy6nV4ow1KaV1mX4UFxeyekU.HM6k0dNOS8nR/ywwdXACrN1RhL1m');

	ini_set("session.gc_maxlifetime", 604800);
	ini_set("session.cookie_lifetime", 604800);
    session_start();

    if (password_verify($_POST["password"], HASH)) {
        session_regenerate_id(true);
        $_SESSION["LOGIN"] = "1";
        header("Location: /");
    } else {
        header("Location: /login.php?failed=1");
   }
