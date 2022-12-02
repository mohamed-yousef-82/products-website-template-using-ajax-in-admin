<?php
/*---Prevent Including Header And Navbar---*/
$noNavbar="";
$noHeader="";
/*---Assign Page Title---*/
$pageTitle ="Categories";
/*---Table---*/
$table = "categories";
$folder = "categories";
/*---Include init.php File---*/
include "../init2.php";
/*---Isset From The User---*/
?>
<div class="view-data">
  <div class="page-container">
<h3 class='table-title'><span><?php echo lang('CATEGORIES') ?></span><i class='fa fa-building' aria-hidden='true'></i></h3>
<!--Dev For Fetching Data--->
<div id="data"></div>
      <!--Add New Item Section--->
      <form class="form add-form" method="post" enctype="multipart/form-data" id="form-add-post">
      <h4 class="form-title"><?php echo lang('ADD NEW CATEGORY') ?></h4>
      <!--Table Name--->
      <input type="hidden" name="table" value="<?php echo $table ?>">
      <!--Add Name--->
      <input type="text" name="name" placeholder="<?php echo lang('NAME') ?>" required="required">
      <!--Add Description--->
      <input type="text" name="description" placeholder="<?php echo lang('DESC') ?>" required="required">
      <!--Add Category Parent--->
      <label><?php echo lang('CATEGORY PARENT') ?></label>
      <select name="parent">
      <option value="0">None</option>
      <!--Select Categories Data From database--->
      <?php
      $cats = sql("SELECT * FROM $table WHERE parent = 0 ORDER By id","fetchAll");
      foreach ($cats as $cat) {
      echo "<option value='$cat[id]'> $cat[name]</option>";
      }
      ?>
      </select>
      <!-- Allow Commenting -->
      <label><?php echo lang('ALLOW COMMENTING') ?> :</label>
          <div class="check-inputs">
          <input id="com-yes" type="radio" name="allow_comment" value="0" checked />
          <label for="com-yes">Yes</label>
          <input id="com-no" type="radio" name="allow_comment" value="1"/>
          <label for="com-no">No</label>
          </div>
      <!-- Allow Ads -->
      <label><?php echo lang('ALLOW ADS') ?> :</label>
          <div class="check-inputs">
          <input id="ads-yes" type="radio" name="allow_ads" value="0" checked />
          <label for="ads-yes">Yes</label>
          <input id="ads-no" type="radio" name="allow_ads" value="1" />
          <label for="ads-no">No</label>
          </div>
      <!--Add Image--->
      <label><?php echo lang('IMAGE') ?> :</label>
      <input type="file" name="file" placeholder="<?php echo lang('IMAGE') ?>" >
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
