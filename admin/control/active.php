<?php
include "../init2.php";
?>
<div class='container'>
<?php
$id = $_POST['id'];
$table = $_POST['table'];
sql("UPDATE $table SET activity = 1 WHERE id = '$id'","");
?>
</div>
