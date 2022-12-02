<?php
include "../init2.php";
$title       = $_POST['title'];
$description = $_POST['description'];
$tab         = $_POST['tab'];
$table       = $_POST['table'];
upload("file","","../../data/uploads/");
sql("INSERT INTO $table (title,description,image,tab_id) VALUES ('$title','$description','$insert_src','$tab')","");
?>
