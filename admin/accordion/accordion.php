<?php
$noNavbar="";
$noHeader="";
/*---Assign Page Title---*/
$pageTitle ="Accordion";
/*---Table---*/
$table = "accordion";
$folder = "accordion";
/*---Include init.php File---*/
include "../init2.php";
/*---Isset From The User---*/
?>
<div class="view-data">
<div class="page-container">
<h3 class='table-title'><span><?php echo lang('ACCORDION') ?></span><i class='fa fa-building' aria-hidden='true'></i></h3>
<!--Dev For Fetching Data--->
<div id="data"></div>
<?php pages_links($table); ?>
<!-- <link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
    <p id="pagination-here"></p>
    <p id="content"></p> -->
      <!--Add New Item Section--->
      <form class="form add-form" method="post" enctype="multipart/form-data" id="form-add-post">
      <h4 class="form-title"><?php echo lang('ADD NEW ITEM') ?></h4>
      <!--Table Name--->
      <input type="hidden" name="table" value="<?php echo $table ?>">
      <!--Add Title--->
      <input type="text" name="title" placeholder="<?php echo lang('TITLE') ?>" required="required" id="title">
      <!--Add Description--->
      <input type="text" name="description" placeholder="<?php echo lang('DESC') ?>" required="required" id="description">
      <!--Add Image--->
      <label><?php echo lang('IMAGE') ?></label>
      <input type="file" name="file" placeholder="<?php echo lang('IMAGE') ?>"  id="file">
      <!--Send BTN-->
      <button class="start-btn blue" type="submit" id="add"><i class="fa fa-plus"></i><?php echo lang('ADDNEW') ?></button>
      </form>
</div>
</div>
<script>
      var table = "<?php echo $table ?>";
      var folder = "<?php echo $folder ?>";
</script>
<script src="<?php echo $js ?>/data-add.js"></script>
<script>
$(document).on('click', '.pager', function() {
  var page_start = $(this).attr("page_start");
  var page_items = $(this).attr("page_items");
  $.ajax({
      url: "../" + folder + "/" + table + "-data.php",
      method: "POST",
      data: {
          page_start: page_start,
          page_items: page_items
      },
      success: function(data) {
          $('#data').html(data);
      }
  });
});
</script>
