<?php
include "../init2.php";
?>
<div class='container'>
<?php
$id = $_POST['id'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$googlemap = $_POST['googlemap'];
$oldfile = $_POST['oldfile'];
$table = $_POST['table'];
upload("file",$oldfile,"../../data/uploads/");
sql("UPDATE $table SET phone = '$phone',email = '$email',address = '$address',googlemap = '$googlemap',image = '$insert_src' WHERE id = '$id'","");
?>
</div>
