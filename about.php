<?php
include "init.php";
?>
<div class="container">
<div class="page-style-one">
<h2 class="page-title"><?php  echo str_replace("-","",$_GET['name']); ?></h2>
<?php
  // Get Sub Categoriey
 $about_page = sql("SELECT * FROM about","fetch");
 ?>
 <?php
 // echo "<h3>$about_page[title]</h3>";
 echo "<img class='about-img' src='$about_page[image]' />";
 echo "<p>$about_page[description]</p>";
?>
</div>
</div>
<?php
include "$str/footer.php";
?>
