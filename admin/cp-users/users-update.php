<?php
include "../init2.php";
?>
<div class='container'>
<?php
$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$level = $_POST['level'];
$oldfile = $_POST['oldfile'];
$table = $_POST['table'];
upload("file",$oldfile,"../../data/uploads/");
sql("UPDATE $table SET username = '$username',password = '$password',email = '$email',level = '$level',image = '$insert_src' WHERE id = '$id'","");
?>
</div>
