<?php
/*---Prevent Including Header And Navbar---*/
$noNavbar="";
$noHeader="";
/*---Table---*/
$table = "logo";
$folder = "logo";
/*---Including init.php File---*/
include "../init2.php";
/*---Select Data From Table And View It---*/
$select = sql("SELECT * FROM $table ORDER By id DESC ","fetch");
?>
<div class="table">
  <div class="contact-data"><?php echo $select['name'] ?></div>
  <div class="contact-img"><img src='../../<?php echo $select['image'] ?>' /></div>
<div>
        <button class='start-btn green' data-popup-open='popup-<?php echo $select['id'] ?>'><i class='fa fa-edit'></i><?php echo lang('EDIT') ?></button>
        </div>
        <!--Edit And Update Data-->
          <div class="popup" data-popup="popup-<?php echo $select['id'] ?>">
            <div class="popup-inner">
              <form class="form" method="post" enctype="multipart/form-data">
              <h4 class="form-title"><?php echo lang('Edit ITEM') ?></h4>
              <!--Table Name-->
              <input type="hidden" name="table" value="<?php echo $table ?>">
              <!--Id-->
              <input type="hidden" name="id" value="<?php echo $select['id'] ?>">
              <!--Name-->
              <input type="text" name="name" <?php if($select['name'] !==""){?> value="<?php echo $select['name'];?>"<?php } else {?>placeholder="<?php echo lang('ENTER NAME HERE');}?>">
              <!--Logo-->
              <label><?php echo lang('LOGO') ?></label>
              <input type="hidden" name="oldfile" value="<?php echo $select['image'] ?>">
              <input type="file" name="file" placeholder="Image">
              <!--Update BTN-->
              <button type="submit" class="start-btn blue"><?php echo lang('UPDATEBTN') ?></button>
              </form>
              <!--Close BTN-->
              <button class="popup-close" data-popup-close="popup-<?php echo $select['id'] ?>">x</button>
          </div>

      </div>
      </div>
      <script>
          var table = "<?php echo $table ?>";
          var folder = "<?php echo $folder ?>";
      </script>
<!--Include Js Files-->
<script src="<?php echo"$js" ?>/popup.js"></script>
<script src="<?php echo"$js" ?>/update-data.js"></script>
