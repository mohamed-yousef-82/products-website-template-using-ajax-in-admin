<?php
include "../init2.php";
?>
<div class='container'>
<?php
$id = $_POST['id'];
$table = $_POST['table'];
sql("DELETE FROM $table WHERE id = '$id'","");
?>
</div>
