<?php
include "../init2.php";
$name = $_POST['name'];
$table = $_POST['table'];
upload("file","","../../data/uploads/");
sql("INSERT INTO $table (name,image) VALUES ('$name','$insert_src')","");
?>
