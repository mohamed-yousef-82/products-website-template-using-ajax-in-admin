<?php
/*---Prevent Including Header And Navbar---*/
$noNavbar="";
$noHeader="";
/*---Assign Page Title---*/
$pageTitle ="Clients";
/*---Table---*/
$table = "clients";
$folder = "clients";
/*---Include init.php File---*/
include "../init2.php";
/*---Isset From The User---*/
?>
<div class="view-data">
  <div class="page-container">
<h3 class='table-title'><span><?php echo lang('CLIENTS') ?></span><i class='fa fa-building' aria-hidden='true'></i></h3>
<!--Dev For Fetching Data--->
<div id="data"></div>
      <!--Add New Item Section--->
      <form class="form add-form" method="post" enctype="multipart/form-data" id="form-add-post">
      <h4 class="form-title"><?php echo lang('ADD NEW ITEM') ?></h4>
      <!--Table Name--->
      <input type="hidden" name="table" value="<?php echo $table ?>">
      <!--Add Name--->
      <input type="text" name="name" placeholder="<?php echo lang('NAME') ?>" required="required" id="title">
      <!--Add Image--->
      <label><?php echo lang('IMAGE') ?></label>
      <input type="file" name="file" placeholder="<?php echo lang('IMAGE') ?>"  id="file">
      <!--Send BTN-->
      <button type="Add Category" class="start-btn blue" type="submit" id="add"><i class="fa fa-plus"></i><?php echo lang('ADDNEW') ?></button>
      </form>
    </div>
    </div>
    <script>
        var table = "<?php echo $table ?>";
        var folder = "<?php echo $folder ?>";
    </script>
    <script src="<?php echo $js ?>/data-add.js"></script>
