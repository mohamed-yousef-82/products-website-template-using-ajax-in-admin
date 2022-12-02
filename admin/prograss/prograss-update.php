<?php
include "../init2.php";
?>
<div class='container'>
<?php
$id = $_POST['id'];
$name = $_POST['name'];
$count = $_POST['count'];
$table = $_POST['table'];
sql("UPDATE $table SET name = '$name',count = '$count' WHERE id = '$id'","");
?>
</div>
