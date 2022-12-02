<?php
include "../init2.php";
?>
<div class='container'>
<?php
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$parent = $_POST['parent'];
$allow_comment = $_POST['allow_comment'];
$allow_ads = $_POST['allow_ads'];
$oldfile = $_POST['oldfile'];
$table = $_POST['table'];
upload("file",$oldfile,"../../data/uploads/");
sql("UPDATE $table SET name = '$name',description = '$description',parent = '$parent',image = '$insert_src',allow_comment = '$allow_comment',allow_ads = '$allow_ads'  WHERE id = '$id'","");
?>
</div>
