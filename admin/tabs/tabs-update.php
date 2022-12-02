<?php
include "../init2.php";
?>
<div class='container'>
<?php
$id = $_POST['id'];
$title = $_POST['title'];
$table = $_POST['table'];
sql("UPDATE $table SET title = '$title' WHERE id = '$id'","");
?>
</div>
