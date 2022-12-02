<?php
include "../init2.php";
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$level = $_POST['level'];
$table = $_POST['table'];
upload("file","","../../data/uploads/");
sql("INSERT INTO $table (username,password,email,level,date,image) VALUES ('$username','$password','$email','$level',NOW(),'$insert_src')","");
?>
