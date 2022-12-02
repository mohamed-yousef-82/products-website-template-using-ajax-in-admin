<?php
if(isset($_SESSION['username'])){
include "../init2.php";
$title = $_POST['title'];
$table = $_POST['table'];
sql("INSERT INTO $table (title) VALUES ('$title')","");
}else{
    header('Location:../index.php');
}
?>
