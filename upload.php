<?php

header("Status: 200");

$dest = getcwd() . "/uploadedImages/" . $_FILES["image"]["size"] . "_" . $_FILES["image"]["name"];
move_uploaded_file($_FILES["image"]["tmp_name"], $dest);
//echo(json_encode($_POST.length));
print_r($_POST);
print_r($_FILES["image"]);
echo(realpath(dirname(getcwd)));



?>
