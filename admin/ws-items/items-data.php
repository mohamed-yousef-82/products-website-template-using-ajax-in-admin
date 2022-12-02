<?php
/*---Prevent Including Header And Navbar---*/
$noNavbar="";
$noHeader="";
/*---Table---*/
$table = "items";
$folder = "ws-items";
/*---Including init.php File---*/
include "../init2.php";
/*---Select Data From Table And View It---*/
$select = sql("SELECT $table.*,categories.name AS category,users.username
               FROM $table INNER JOIN categories ON categories.id = $table.cat_id
               INNER JOIN users ON users.id = $table.user_id WHERE level = 2 ORDER BY id Desc","fetchAll");

?>
<table class="table">
<thead>
<tr>
  <th><?php echo lang('NUMBER') ?></th>
  <th><?php echo lang('NAME') ?></th>
  <th><?php echo lang('DESC') ?></th>
  <th><?php echo lang('PRICE') ?></th>
  <th><?php echo lang('DATE') ?></th>
  <th><?php echo lang('CATEGORY') ?></th>
  <th><?php echo lang('USERNAME') ?></th>
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
          <td><?php echo $selectview['name'] ?></td>
          <td><?php echo $selectview['description'] ?></td>
          <td><?php echo $selectview['price'] ?></td>
          <td><?php echo $selectview['date'] ?></td>
          <td><?php echo $selectview['category'] ?></td>
          <td><?php echo $selectview['username'] ?></td>
          <td><img style='width:100px;height:100px;' src='../../<?php echo $selectview['image'] ?>' /></td>
          <td>
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
<script src="<?php echo"$js" ?>/popup.js"></script>
<script src="<?php echo"$js" ?>/update-data.js"></script>
