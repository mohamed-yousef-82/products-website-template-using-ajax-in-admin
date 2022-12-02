<?php
include "../init2.php";
$link = $_POST['link'];
$icon = $_POST['icon'];
$table = $_POST['table'];
sql("INSERT INTO $table (link,icon) VALUES ('$link','$icon')","");
?>
