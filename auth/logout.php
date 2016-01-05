<?php

if (isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600, '/'); // empty value and old timestamp
	unset($_COOKIE['username']);
	setcookie('role', '', time() - 3600, '/');
	unset($_COOKIE['role']);
}

header("Location: ../index.php");
die();
