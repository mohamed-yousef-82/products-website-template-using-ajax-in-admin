<?php
include "../init2.php";
$title = $_POST['title'];
$description = $_POST['description'];
$table = $_POST['table'];
upload("file","","../../data/uploads/");
sql("INSERT INTO $table (title,description,image) VALUES ('$title','$description','$insert_src')","");
?>
