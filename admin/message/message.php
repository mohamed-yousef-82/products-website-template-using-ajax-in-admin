<?php
/*---Prevent Including Header And Navbar---*/
$noNavbar="";
$noHeader="";
$pageTitle ="Items";
include "../init2.php";
  ?>
  <div class="view-data">
  <div class="page-container">
  <h3 class="table-title"><span><?php echo lang('SEND_MESSAGE') ?></span><i class="fa fa-envelope" aria-hidden="true"></i></h3>
  <form class="form" method="post" id="send_message">
  <!--Start title-->
  <input type="text" name="title" placeholder="<?php echo lang('TITLE') ?>" required="required" />
  <!--Start email-->
  <input type="email"  name="email" placeholder="<?php echo lang('EMAIL') ?>" required="required">
  <!--Start email-->
  <input type="email" name="to" placeholder="<?php echo lang('RECIPIENT') ?>" required="required">
  <!--Start email-->
  <textarea name="message" required="required"></textarea>
  <!--Start Sent-->
  <button type="button" class="start-btn blue message-btn"><?php echo lang('INSERT') ?></button>
  </form>
</div>
</div>
</section>
