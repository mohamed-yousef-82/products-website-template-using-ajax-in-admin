<?php
include "../init2.php";
?>
<div class='container'>
<?php
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price       = $_POST['price'];
$category    = $_POST['category'];
$oldfile = $_POST['oldfile'];
$table = $_POST['table'];
upload("file",$oldfile,"../../data/uploads/");
sql("UPDATE $table SET name = '$name',description = '$description',price = '$price',cat_id = '$category',image = '$insert_src' WHERE id = '$id'","");
?>
</div>
