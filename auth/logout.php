<?php

if (isset($_COOKIE['username'])) {
    unset($_COOKIE['username']);
    setcookie('username', '', time() - 3600, '/'); // empty value and old timestamp
}

echo("Logged out!");
