<?php
/*---Prevent Including Header And Navbar---*/
$noNavbar="";
$noHeader="";
/*---Assign Page Title---*/
$pageTitle ="Items";
/*---Table---*/
$table = "items";
$folder = "cp-items";
/*---Include init.php File---*/
include "../init2.php";
?>
<div class="view-data">
<div class="page-container">
<h3 class='table-title'><span><?php echo lang('CPANEL_USERS_ITEMS') ?></span><i class='fa fa-building' aria-hidden='true'></i></h3>
<!--Dev For Fetching Data--->
<div id="data"></div>
      <!--Add New Item Section--->
      <form class="form add-form" method="post" enctype="multipart/form-data" id="form-add-post">
      <h4 class="form-title"><?php echo lang('ADD NEW ITEM') ?></h4>
      <!--Table Name--->
      <input type="hidden" name="table" value="<?php echo $table ?>">
      <!--Add Name--->
      <input type="text" name="name" placeholder="<?php echo lang('NAME') ?>" required="required">
      <!--Add Description--->
      <textarea name="description" placeholder="<?php echo lang('DESC') ?>" required="required"></textarea>
      <!--Add Price--->
      <input type="number" name="price" placeholder="<?php echo lang('PRICE') ?>">
      <!--Add Category -->
      <label><?php echo lang('CATEGORY') ?></label>
      <select name="category">
          <?php
          //--Select Categories Data From database--//
          $cats = sql("SELECT * FROM categories WHERE parent = 0 ORDER BY id","fetchAll");
          foreach ($cats as $cat) {
          echo "<option value='$cat[id]'> $cat[name]</option>";
          $childcat = sql("SELECT * FROM categories WHERE parent = $cat[id] ORDER BY id","fetchAll");
          foreach ($childcat as $child) {
          echo "<option value='$child[id]'>--- $child[name]</option>";
        }
        }
          ?>
        </select>
      <!--Add Image--->
      <label><?php echo lang('IMAGE') ?></label>
      <input type="file" name="file" placeholder="<?php echo lang('IMAGE') ?>">
      <!--Send BTN-->
      <button type="Add Category" class="start-btn blue" type="submit" id="add"><i class="fa fa-plus"></i><?php echo lang('ADDNEW') ?></button>
      </form>
    </div>
    </div>
    <script>
        var table = "<?php echo $table ?>";
        var folder = "<?php echo $folder ?>";
    </script>
    <script src="<?php echo"$js" ?>/data-add.js"></script>
