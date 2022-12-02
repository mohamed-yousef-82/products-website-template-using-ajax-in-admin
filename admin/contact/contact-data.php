<?php
/*---Prevent Including Header And Navbar---*/
$noNavbar="";
$noHeader="";
/*---Table---*/
$table = "contact";
$folder = "contact";
/*---Including init.php File---*/
include "../init2.php";
/*---Select Data From Table And View It---*/
$select = sql("SELECT * FROM $table ORDER By id DESC ","fetch");
?>
<div class="table">
  <div class="contact-data"><label><i class="fa fa-phone-square" aria-hidden="true"></i> </label><?php echo $select['phone'] ?></div>
  <div class="contact-data"><label><i class="fa fa-envelope" aria-hidden="true"></i> </label><?php echo $select['email'] ?></div>
  <div class="contact-data"><label><i class="fa fa-home" aria-hidden="true"></i> <?php echo $select['address'] ?></div>
  <div class="row">
  <div class="box box-1">
  <div class="contact-img"><img src='../../<?php echo $select['image'] ?>' /></div>
  </div>
  <div class="box box-1">
  <div class="googlemap"><?php echo $select['googlemap'] ?></div>
  </div>
</div>
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
              <!--Phone-->
              <input type="text" name="phone" <?php if($select['phone'] !==""){?> value="<?php echo $select['phone'];?>"<?php } else {?>placeholder="<?php echo lang('ENTER FHONE HERE');}?>">
              <!--Email-->
              <input type="text" name="email" <?php if($select['email'] !==""){?> value="<?php echo $select['email'];?>"<?php } else {?>placeholder="<?php echo lang('ENTER EMAIL HERE');}?>">
              <!--Address-->
              <input type="text" name="address" <?php if($select['address'] !==""){?> value="<?php echo $select['address'];?>"<?php } else {?>placeholder="<?php echo lang('ENTER ADDRESS HERE');}?>">
              <!--Googlemap-->
              <textarea name="googlemap" <?php if($select['googlemap'] !==""){?> <?php } else {?>placeholder="<?php echo lang('ENTER GOOGLE MAP CODE HERE');}?>"><?php echo $select['googlemap'];?></textarea>
              <!--Image-->
              <label><?php echo lang('IMAGE') ?></label>
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
