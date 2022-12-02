<?php
/*---Prevent Including Header And Navbar---*/
$noNavbar="";
$noHeader="";
/*---Table---*/
$table = "users";
$folder = "cp-users";
/*---Including init.php File---*/
include "../init2.php";
/*---Select Data From Table And View It---*/
$select = sql("SELECT * FROM $table WHERE level != 2 ORDER BY id Desc","fetchAll");
?>
<table class="table">
<thead>
<tr>
  <th><?php echo lang('NUMBER') ?></th>
  <th><?php echo lang('USERNAME') ?></th>
  <th><?php echo lang('EMAIL') ?></th>
  <th><?php echo lang('REGISTERED_DATE') ?></th>
  <th><?php echo lang('LEVEL') ?></th>
  <th><?php echo lang('IMAGE') ?></th>
  <th><?php echo lang('CONTROL') ?></th>
</tr>
</thead>
        <?php
        $num = 1;
        foreach ($select as $selectview) {
          ?>
          <tr>
          <td><?php echo $num ?></td>
          <td><?php echo $selectview['username'] ?></td>
          <td><?php echo $selectview['email'] ?></td>
          <td><?php echo $selectview['date'] ?></td>
          <td><?php if($selectview['level']==0){echo 'Manager';} else if ($selectview['level']==1){echo 'Editor';}  ?></td>
          <td><img style='width:100px;height:100px;' src='../../<?php echo $selectview['image'] ?>' /></td>
          <td class='admin_control'><button class='start-btn green' data-popup-open='popup-<?php echo $selectview['id'] ?>'><i class='fa fa-edit'></i><?php echo lang('EDIT') ?></button>
          <button data-id='<?php echo $selectview['id'] ?>' class='start-btn orangered delete' id='delete'><i class='fa fa-close'></i><?php echo lang('DELETEBTN') ?></button>
          <?php
          if($selectview['activity']==0){
            ?>
            <button data-id='<?php echo $selectview['id'] ?>' class='start-btn dark active'><i class='fa fa-check'></i><?php echo lang('ACTIVATE') ?></button>
            <?php
          }else{
          ?>
          <button data-id='<?php echo $selectview['id'] ?>' class='start-btn blue inactive'><i class='fa fa-hand-paper-o'></i><?php echo lang('INACTIVE') ?></button>
          <?php
        }
        ?>
        </td>
        <!--Edit And Update Data-->
          <td class="popup" data-popup="popup-<?php echo $selectview['id'] ?>">
            <div class="popup-inner">
              <form class="form" method="post" enctype="multipart/form-data">
              <h4 class="form-title"><?php echo lang('Edit ITEM') ?></h4>
              <!--Table Name-->
              <input type="hidden" name="table" value="<?php echo $table ?>">
              <!--Id-->
              <input type="hidden" name="id" value="<?php echo $selectview['id'] ?>">
              <!--Edit username-->
              <input type="text" name="username" value="<?php echo $selectview['username'] ?>">
              <!--Edit Password-->
              <input type="password" name="password" value="<?php echo $selectview['password'] ?>">
              <!--Edit Email-->
              <input type="email" name="email" value="<?php echo $selectview['email'] ?>">
              <!--Edit Level-->
              <label><?php echo lang('LEVEL') ?></label>
              <select name="level">
              <option value="0" <?php if($selectview['level']==0){echo 'selected';}  ?>>Manager</option>
              <option value="1" <?php if($selectview['level']==1){echo 'selected';}  ?>>Editor</option>
              </select>              <!--Edit email-->
              <!--Image-->
              <label><?php echo lang('IMAGE') ?></label>
              <input type="hidden" name="oldfile" value="<?php echo $selectview['image'] ?>">
              <input type="file" name="file" placeholder="Image">
              <!--Update BTN-->
              <button type="submit" class="start-btn blue"><?php echo lang('UPDATEBTN') ?></button>
              </form>
              <!--Close BTN-->
              <button class="popup-close" data-popup-close="popup-<?php echo $selectview['id'] ?>">x</button>
          </div>
            <?php
              $num++;
            }
            ?>
      </td>
      </tr>
      </table>
      <script>
      var table = "<?php echo $table ?>";
      var folder = "<?php echo $folder ?>";
      </script>
<!--Include Js Files-->
<script src="<?php echo $js ?>/popup.js"></script>
<script src="<?php echo $js ?>/update-data.js"></script>
