<?php
include "../init2.php";
$name        = $_POST['name'];
$description = $_POST['description'];
$price       = $_POST['price'];
$category    = $_POST['category'];
$user        = $_SESSION['id'];
$table       = $_POST['table'];
upload("file","","../../data/uploads/");
sql("INSERT INTO $table (name,description,price,image,user_id,cat_id,date) VALUES ('$name','$description','$price','$insert_src','$user','$category',NOW())","");
?>
