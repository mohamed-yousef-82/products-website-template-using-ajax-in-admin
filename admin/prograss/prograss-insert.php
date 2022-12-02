<?php
include "../init2.php";
$name = $_POST['name'];
$count = $_POST['count'];
$table = $_POST['table'];
sql("INSERT INTO $table (name,count) VALUES ('$name','$count')","");
?>
