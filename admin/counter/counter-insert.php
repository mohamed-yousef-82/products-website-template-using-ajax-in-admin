<?php
include "../init2.php";
$title = $_POST['title'];
$description = $_POST['description'];
$count = $_POST['count'];
$table = $_POST['table'];
upload("file","","../../data/uploads/");
sql("INSERT INTO $table (title,count,image) VALUES ('$title','$count','$insert_src')","");
?>
