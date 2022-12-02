<?php
include "../init2.php";
$name = $_POST['name'];
$description = $_POST['description'];
$parent = $_POST['parent'];
$allow_comment = $_POST['allow_comment'];
$allow_ads = $_POST['allow_ads'];
$table = $_POST['table'];
upload("file","","../../data/uploads/");
sql("INSERT INTO $table (name,description,parent,allow_comment,allow_ads,image) VALUES ('$name','$description','$parent','$allow_comment','$allow_ads','$insert_src')","");
?>
