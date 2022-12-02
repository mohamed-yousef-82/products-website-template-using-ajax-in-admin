<?php
include "../init2.php";
?>
<div class='container'>
<?php
$id = $_POST['id'];
$link = $_POST['link'];
$icon = $_POST['icon'];
$table = $_POST['table'];
sql("UPDATE $table SET link = '$link',icon = '$icon' WHERE id = '$id'","");
?>
</div>
