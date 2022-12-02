<?php
include "../init2.php";
?>
<div class='container'>
<?php
$id          = $_POST['id'];
$title       = $_POST['title'];
$description = $_POST['description'];
$tab         = $_POST['tab'];
$oldfile     = $_POST['oldfile'];
$table       = $_POST['table'];
upload("file",$oldfile,"../../data/uploads/");
sql("UPDATE $table SET title = '$title',description = '$description',tab_id = '$tab',image = '$insert_src' WHERE id = '$id'","");
?>
</div>
