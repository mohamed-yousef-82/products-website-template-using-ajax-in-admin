<?php
/*---Prevent Including Header And Navbar---*/
$noNavbar="";
$noHeader="";
/*---Assign Page Title---*/
$pageTitle ="Tabs-Items";
/*---Table---*/
$table = "tabsitems";
$folder = "tabs-items";
/*---Include init.php File---*/
include "../init2.php";
?>
<div class="view-data">
<div class="page-container">
<h3 class='table-title'><span>Tabs Items</span><i class='fa fa-building' aria-hidden='true'></i></h3>
<!--Dev For Fetching Data--->
<div id="data"></div>
      <!--Add New Item Section--->
      <form class="form add-form" method="post" enctype="multipart/form-data" id="form-add-post">
      <h4 class="form-title"><?php echo lang('ADD NEW ITEM') ?></h4>
      <!--Table Name--->
      <input type="hidden" name="table" value="<?php echo $table ?>">
      <!--Add Title--->
      <input type="text" name="title" placeholder="<?php echo lang('NAME') ?>" required="required">
      <!--Add Description--->
      <textarea name="description" placeholder="<?php echo lang('DESC') ?>" required="required"></textarea>
      <!--Add Tab -->
      <label><?php echo lang('TAB') ?></label>
      <select name="tab">
          <?php
          //--Select Categories Data From database--//
          $tabs = sql("SELECT * FROM tabs ORDER BY id","fetchAll");
          foreach ($tabs as $tab) {
          echo "<option value='$tab[id]'> $tab[title]</option>";
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
