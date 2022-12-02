<?php
$pageTitle ="Accordion";
include "init.php";
?>
<div class="container">
<div class="page-style-one">
<h2 class="page-title"><?php  echo str_replace("-","",$_GET['name']); ?></h2>
<?php
$id = isset($_GET['id']) && is_numeric($_GET['id'])?intval($_GET['id']) : 0;
$item_data = sql("SELECT * FROM slideshow WHERE id = $id AND activity = 1 ORDER BY id","fetch");
                ?>
              <img class='item-image' src='<?php echo $item_data['image'] ?>' />
                <p><?php echo $item_data['description'] ?><p>
</div>
</div>
<?php
include "$str/footer.php";
?>
