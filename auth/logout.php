<?php

if (isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600, '/'); // empty value and old timestamp
	unset($_COOKIE['username']);
}

header("Location: ../index.php");
die();
