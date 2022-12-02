<?php
$noNavbar="";
$noHeader="";
/*---Assign Page Title---*/
$pageTitle ="logo";
/*---Table---*/
$table = "logo";
$folder = "logo";
/*---Include init.php File---*/
include "../init2.php";
?>
<div class="view-data">
  <div class="page-container">
<h3 class='table-title'><span><?php echo lang('LOGO') ?></span><i class='fa fa-building' aria-hidden='true'></i></h3>
<!--Dev For Fetching Data--->
<div id="data"></div>
      <script>
          var table = "<?php echo $table ?>";
          var folder = "<?php echo $folder ?>";
      </script>
<?php
echo"</div>";
echo"</div>";
?>
