<?php

/*---Prevent Including Header And Navbar---*/
$noNavbar="";
$noHeader="";
include "../init2.php";
/*---Get Last Admin Users ---*/
$Latest_Admin_Users =getLatest("SELECT * FROM users WHERE level != 2 ORDER BY id DESC LIMIT 5");
/*---Get Last Admin Users ---*/
$Latest_Interface_Users =getLatest("SELECT * FROM users WHERE level = 2 ORDER BY id DESC LIMIT 5");
/*---Get Last Items ---*/
$Latest_Items =getLatest("SELECT * FROM items ORDER BY id DESC LIMIT 5");
/*---Get Last Items ---*/
$Latest_Comments =getLatest("SELECT comments.*,items.name As item,users.username As username,users.image As image
              FROM comments INNER JOIN items ON items.id = comments.item_id
              INNER JOIN users ON users.id = comments.user_id ORDER BY id Desc");
 ?>
<div class="page-container">
<div class="row stats">
      <div class="box box-1">
        <div class="stat">
          <i class="fa fa-users" aria-hidden="true"></i>
          <p><?php echo lang('TOTAL_USERS') ?></p>
          <span><a href="users.php"><?php echo counter('id','users'); ?></a></span>
        </div>
      </div>
      <div class="box box-1">
        <div class="stat">
          <i class="fa fa-user" aria-hidden="true"></i>
          <p><?php echo lang('PENDING_USERS') ?></p>
          <span><a href="users.php?do=manage&page=pending"><?php echo checkItems('activity','users','0'); ?></a></span>
        </div>
      </div>
      <div class="box box-1">
        <div class="stat">
          <i class="fa fa-pencil" aria-hidden="true"></i>
          <p><?php echo lang('TOTAL_ITEMS') ?></p>
          <span><a href="items.php"><?php echo counter('id','items'); ?></a></span>
        </div>
      </div>
      <div class="box box-1">
        <div class="stat">
          <i class="fa fa-comments" aria-hidden="true"></i>
          <p><?php echo lang('TOTAL_COMMENTS') ?></p>
          <span><a href="comments.php"><?php echo counter('id','comments'); ?></a></span>
        </div>
      </div>
      <div class="box box-1">
        <div class="stat">
          <i class="fa fa-comments" aria-hidden="true"></i>
          <p><?php echo lang('TOTAL_CATEGORIES') ?></p>
          <span><a href="comments.php"><?php echo counter('id','categories'); ?></a></span>
        </div>
      </div>
    </div>
<div class="row top-space">
    <div class="box box-1">
<div class="panel">
      <h3 class="section-title"><i class="fa fa-folder-open" aria-hidden="true"></i><?php echo lang('LAST_REGISTERED_USERS') ?></h3>
          <ul>
          <?php
          if(!empty($Latest_Admin_Users)){
          foreach ($Latest_Admin_Users as $selectview) {
            ?>
            <li class="dash-row">
            <span><?php echo $selectview['username']; ?></span>
            <div class="dash-details">
            <img style="width:80px;height:80px;" src="../../<?php echo $selectview['image']; ?>" />
            <div class="dash-control">
            <button class='start-btn green' data-table='users' data-folder='cp-users' data-popup-open='popup-<?php echo $selectview['id'] ?>'><i class='fa fa-edit'></i><?php echo lang('EDIT') ?></button>
            <!--Edit And Update Data-->
              <div class="popup" data-popup="popup-<?php echo $selectview['id'] ?>">
                <div class="popup-inner">
                  <form class="form form-update" method="post" enctype="multipart/form-data">
                  <h4 class="form-title"><?php echo lang('Edit ITEM') ?></h4>
                  <!--Table Name-->
                  <input type="hidden" name="table" value="users">
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
                  <option value="0" <?php if($selectview['level']==0){echo 'selected';}  ?>><?php echo lang('MANAGER') ?></option>
                  <option value="1" <?php if($selectview['level']==1){echo 'selected';}  ?>><?php echo lang('EDITOR') ?></option>
                  </select><!--Edit email-->
                  <!--Image-->
                  <label><?php echo lang('IMAGE') ?></label>
                  <input type="hidden" name="oldfile" value="<?php echo $selectview['image'] ?>">
                  <input type="file" name="file" placeholder="Image">
                  <!--Update BTN-->
                  <button type="button" class="start-btn blue data-update" data-table="users" data-folder="cp-users" ><?php echo lang('UPDATEBTN') ?></button>
                  </form>
                  <!--Close BTN-->
                  <button class="popup-close" data-popup-close="popup-<?php echo $selectview['id'] ?>">x</button>
              </div>
          </div>
            <button data-id=<?php echo $selectview['id'] ?> data-table='users' class='start-btn orangered dash-delete'><i class='fa fa-close'></i><?php echo lang('DELETEBTN') ?></button>
            <?php
            if($selectview['activity']==0){
              ?>
              <button data-id=<?php echo $selectview['id'] ?> data-table='users' class='start-btn dark dash-active'><i class='fa fa-check'></i><?php echo lang('ACTIVATE') ?></button>
              <?php
            }else{
            ?>
            <button data-id=<?php echo $selectview['id'] ?> data-table='users' class='start-btn blue dash-inactive'><i class='fa fa-hand-paper-o'></i><?php echo lang('INACTIVE') ?></button>
            </div>
            <?php
          }
          }
            }
          else{
              echo "<div class='nodata'>No Data To Show</div>";
          }
          ?>

          </div>
          </li>
          </ul>
        </div>
</div>
<div class="box box-1">
<div class="panel">
<h3 class="section-title"><i class="fa fa-folder-open" aria-hidden="true"></i><?php echo lang('LAST_REGISTERED_USERS') ?></h3>
    <ul>
    <?php
    if(!empty($Latest_Interface_Users)){
    foreach ($Latest_Interface_Users as $selectview) {
      ?>
      <li class="dash-row">
      <span><?php echo $selectview['username']; ?></span>
      <div class="dash-details">
      <img style="width:80px;height:80px;" src="../../<?php echo $selectview['image']; ?>" />
      <div class="dash-control">
      <button class='start-btn green' data-table='users' data-folder='ws-users' data-popup-open='popup-<?php echo $selectview['id'] ?>'><i class='fa fa-edit'></i><?php echo lang('EDIT') ?></button>
      <!--Edit And Update Data-->
        <div class="popup" data-popup="popup-<?php echo $selectview['id'] ?>">
          <div class="popup-inner">
            <form class="form form-update" method="post" enctype="multipart/form-data">
            <h4 class="form-title"><?php echo lang('Edit ITEM') ?></h4>
            <!--Table Name-->
            <input type="hidden" name="table" value="users">
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
            <option value="0" <?php if($selectview['level']==0){echo 'selected';}  ?>><?php echo lang('MANAGER') ?></option>
            <option value="1" <?php if($selectview['level']==1){echo 'selected';}  ?>><?php echo lang('EDITOR') ?></option>
            </select><!--Edit email-->
            <!--Image-->
            <label><?php echo lang('IMAGE') ?></label>
            <input type="hidden" name="oldfile" value="<?php echo $selectview['image'] ?>">
            <input type="file" name="file" placeholder="Image">
            <!--Update BTN-->
            <button type="button" class="start-btn blue data-update" data-table="users" data-folder="ws-users" ><?php echo lang('UPDATEBTN') ?></button>

            </form>
            <!--Close BTN-->
            <button class="popup-close" data-popup-close="popup-<?php echo $selectview['id'] ?>">x</button>
        </div>
    </div>
      <button data-id=<?php echo $selectview['id'] ?> data-table='users' class='start-btn orangered dash-delete'><i class='fa fa-close'></i><?php echo lang('DELETEBTN') ?></button>
      <?php
      if($selectview['activity']==0){
        ?>
        <button data-id=<?php echo $selectview['id'] ?> data-table='users' class='start-btn dark dash-active'><i class='fa fa-check'></i><?php echo lang('ACTIVATE') ?></button>
        <?php
      }else{
      ?>
      <button data-id=<?php echo $selectview['id'] ?> data-table='users' class='start-btn blue dash-inactive'><i class='fa fa-hand-paper-o'></i><?php echo lang('INACTIVE') ?></button>
      </div>
      <?php
    }
    }
      }
    else{
        echo "<div class='nodata'>No Data To Show</div>";
    }
    ?>

    </div>
    </li>
    </ul>
  </div>
</div>
</div>
    <div class="row row-medium top-space">
      <div class="box box-1">
<div class="panel">
        <h3 class="section-title"><i class="fa fa-folder-open" aria-hidden="true"></i><?php echo lang('LAST_ITEMS') ?></h3>
            <ul>
            <?php
            if(!empty($Latest_Items)){
            foreach ($Latest_Items as $selectview) {
              ?>
              <li class="dash-row">
              <span><?php echo $selectview['name']; ?></span>
              <div class="dash-details">
              <img style="width:80px;height:80px;" src="../../<?php echo $selectview['image']; ?>" />
              <div class="dash-control">
              <button class='start-btn green' data-table='items' data-folder='cp-items' data-popup-open='popup-<?php echo $selectview['id'] ?>'><i class='fa fa-edit'></i><?php echo lang('EDIT') ?></button>
              <!--Edit And Update Data-->
                <div class="popup" data-popup="popup-<?php echo $selectview['id'] ?>">
                  <div class="popup-inner">
                    <form class="form form-update" method="post" enctype="multipart/form-data">
                    <h4 class="form-title"><?php echo lang('Edit ITEM') ?></h4>
                    <!--Table Name-->
                    <input type="hidden" name="table" value="items">
                    <!--Id-->
                    <input type="hidden" name="id" value="<?php echo $selectview['id'] ?>">
                    <!--Edit Name-->
                    <input type="text" name="name" value="<?php echo $selectview['name'] ?>">
                    <!--Edit Description-->
                    <textarea name="description"><?php echo $selectview['description'] ?></textarea>
                    <!--Edit Price-->
                    <input type="text" name="price" value="<?php echo $selectview['price'] ?>">
                    <!--Edit Category-->
                    <label><?php echo lang('CATEGORY') ?></label>
                    <select name="category">
                        <?php
                        //--Select Categories Data From database--//
                        $cats = sql("SELECT * FROM categories WHERE parent = 0 ORDER BY id","fetchAll");
                        foreach ($cats as $cat) {
                        echo "<option value='$cat[id]'> $cat[name]</option>";
                        $childcat = sql("SELECT * FROM categories WHERE parent = $cat[id] ORDER BY id","fetchAll");
                        foreach ($childcat as $child) {
                        echo "<option value='$child[id]'>--- $child[name]</option>";
                      }
                      }
                        ?>
                      </select>
                    <!--Image-->
                    <label><?php echo lang('IMAGE') ?></label>
                    <input type="hidden" name="oldfile" value="<?php echo $selectview['image'] ?>">
                    <input type="file" name="file" placeholder="Image">
                    <!--Update BTN-->
                    <button type="button" class="start-btn blue data-update" data-table="items" data-folder="cp-items" ><?php echo lang('UPDATEBTN') ?></button>
                    </form>
                    <!--Close BTN-->
                    <button class="popup-close" data-popup-close="popup-<?php echo $selectview['id'] ?>">x</button>
                </div>
            </div>
              <button data-id=<?php echo $selectview['id'] ?> data-table='items' class='start-btn orangered dash-delete'><i class='fa fa-close'></i><?php echo lang('DELETEBTN') ?></button>
              <?php
              if($selectview['activity']==0){
                ?>
                <button data-id=<?php echo $selectview['id'] ?> data-table='items' class='start-btn dark dash-active'><i class='fa fa-check'></i><?php echo lang('ACTIVATE') ?></button>
                <?php
              }else{
              ?>
              <button data-id=<?php echo $selectview['id'] ?> data-table='items' class='start-btn blue dash-inactive'><i class='fa fa-hand-paper-o'></i><?php echo lang('INACTIVE') ?></button>
              </div>
              <?php
            }
            }
              }
            else{
                echo "<div class='nodata'>No Data To Show</div>";
            }
            ?>
            </div>
            </li>
            </ul>
          </div>
</div>
<div class="box box-1">
<div class="panel">
  <h3 class="section-title"><i class="fa fa-folder-open" aria-hidden="true"></i><?php echo lang('LAST_COMMENTS') ?></h3>
      <ul>
      <?php
      if(!empty($Latest_Comments)){
      foreach ($Latest_Comments as $selectview) {
        ?>
        <li class="dash-row">
        <span><?php echo $selectview['username']; ?></span>
        <div class="dash-details">
        <img style="width:80px;height:80px;" src="../../<?php echo $selectview['image']; ?>" />
        <div class="dash-control">
        <button class='start-btn green' data-table='comments' data-folder='comments' data-popup-open='popup-<?php echo $selectview['id'] ?>'><i class='fa fa-edit'></i><?php echo lang('EDIT') ?></button>
        <!--Edit And Update Data-->
          <div class="popup" data-popup="popup-<?php echo $selectview['id'] ?>">
            <div class="popup-inner">
              <form class="form form-update" method="post" enctype="multipart/form-data">
              <h4 class="form-title"><?php echo lang('Edit ITEM') ?></h4>
              <!--Table Name-->
              <input type="hidden" name="table" value="comments">
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
              <option value="0" <?php if($selectview['level']==0){echo 'selected';}  ?>><?php echo lang('MANAGER') ?></option>
              <option value="1" <?php if($selectview['level']==1){echo 'selected';}  ?>><?php echo lang('EDITOR') ?></option>
              </select><!--Edit email-->
              <!--Image-->
              <label><?php echo lang('IMAGE') ?></label>
              <input type="hidden" name="oldfile" value="<?php echo $selectview['image'] ?>">
              <input type="file" name="file" placeholder="Image">
              <!--Update BTN-->
              <button type="button" class="start-btn blue data-update" data-table="comments" data-folder="comments" ><?php echo lang('UPDATEBTN') ?></button>
              </form>
              <!--Close BTN-->
              <button class="popup-close" data-popup-close="popup-<?php echo $selectview['id'] ?>">x</button>
          </div>
      </div>
        <button data-id=<?php echo $selectview['id'] ?> data-table='comments' class='start-btn orangered dash-delete'><i class='fa fa-close'></i><?php echo lang('DELETEBTN') ?></button>
        <?php
        if($selectview['activity']==0){
          ?>
          <button data-id=<?php echo $selectview['id'] ?> data-table='comments' class='start-btn dark dash-active'><i class='fa fa-check'></i><?php echo lang('ACTIVATE') ?></button>
          <?php
        }else{
        ?>
        <button data-id=<?php echo $selectview['id'] ?> data-table='comments' class='start-btn blue dash-inactive'><i class='fa fa-hand-paper-o'></i><?php echo lang('INACTIVE') ?></button>
        </div>
        <?php
      }
      }
        }
      else{
          echo "<div class='nodata'>No Data To Show</div>";
      }
      ?>

      </div>
      </li>
      </ul>
    </div>
</div>
</div>
</div>
<script src="<?php echo $js ?>/popup.js"></script>
<script src="<?php echo $js ?>/update-data.js"></script>
