<?php
/*---Prevent Including Header And Navbar---*/
$noNavbar="";
$noHeader="";
/*---Assign Page Title---*/
$pageTitle ="Social media";
/*---Table---*/
$table = "socialmedia";
$folder = "socialmedia";
/*---Include init.php File---*/
include "../init2.php";
?>
<div class="view-data">
<div class="page-container">
<h3 class='table-title'><span><?php echo lang('SOCIALMEDIA') ?></span><i class='fa fa-building' aria-hidden='true'></i></h3>
<!--Dev For Fetching Data--->
<div id="data"></div>
      <!--Add New Item Section--->
      <form class="form add-form" method="post" enctype="multipart/form-data" id="form-add-post">
      <h4 class="form-title"><?php echo lang('ADD NEW ITEM') ?></h4>
      <!--Table Name--->
      <input type="hidden" name="table" value="<?php echo $table ?>">
      <!--Add Link--->
      <input type="url" name="link" placeholder="<?php echo lang('LINK') ?>" required="required">
      <!--Add Icon--->
      <ul class="social-icons">
      <li class="social-icon"><input name="icon" type="radio" value="fa fa-facebook-square" required="required" /><i class="fa fa-facebook-square" aria-hidden="true"></i></li>
      <li class="social-icon"><input name="icon" type="radio" value="fa fa-facebook" required="required" /><i class="fa fa-facebook" aria-hidden="true"></i></li>
      <li class="social-icon"><input name="icon" type="radio" value="fa fa-twitter" required="required" /><i class="fa fa-twitter" aria-hidden="true"></i></li>
      <li class="social-icon"><input name="icon" type="radio" value="fa fa-twitter-square" required="required" /><i class="fa fa-twitter-square" aria-hidden="true"></i></li>
      <li class="social-icon"><input name="icon" type="radio" value="fa fa-youtube" required="required" /><i class="fa fa-youtube" aria-hidden="true"></i></li>
      <li class="social-icon"><input name="icon" type="radio" value="fa fa-youtube-square" required="required" /><i class="fa fa-youtube-square" aria-hidden="true"></i></li>
      <li class="social-icon"><input name="icon" type="radio" value="fa fa-google-plus" required="required" /><i class="fa fa-google-plus" aria-hidden="true"></i></li>
      <li class="social-icon"><input name="icon" type="radio" value="fa fa-google-plus-square" required="required" /><i class="fa fa-google-plus-square" aria-hidden="true"></i></li>
      <li class="social-icon"><input name="icon" type="radio" value="fa fa-linkedin" required="required" /><i class="fa fa-linkedin" aria-hidden="true"></i></li>
      <li class="social-icon"><input name="icon" type="radio" value="fa fa-linkedin-square" required="required" /><i class="fa fa-linkedin-square" aria-hidden="true"></i></li>
    </ul>
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
