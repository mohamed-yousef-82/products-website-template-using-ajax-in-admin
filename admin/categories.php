<?php
$pageTitle ="categories";
include "init.php";

if(isset($_SESSION['username'])){

$do = isset($_GET['do'])?$_GET['do'] : 'manage';
//Manage Page
?>
<section class="main-section box box-5">
<div class="view-data">
<div class="page-container">
<?php
//Pending Users
if($do =='manage'){
  pages();
  $sort = 'ASC';
  $sort_array = array('ASC','DESC');
  if (isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
     $sort = $_GET['sort'];
  }

  //Select Categories Data From database
  $category = sql("SELECT * FROM categories ORDER By ordering DESC LIMIT $page_start,$page_items","fetchAll");

?>
<h3 class="table-title"><span>Categories</span><i class="fa fa-sitemap" aria-hidden="true"></i></h3>


<!-- <div class="ordering pull-right">
  <a href="?sort=ASC" class="<? if ($sort == 'ASC') {echo 'active';} ?>">ASC</a>
  <a href="?sort=DESC" class="<? if ($sort == 'DESC') {echo 'active';} ?>">DESC</a>

</div> -->
        </h3>
        <table class="table">
        <thead>
          <tr>
            <th><?php echo lang('NUMBER') ?></th>
            <th><?php echo lang('CATEGORY_NAME') ?></th>
            <th><?php echo lang('DESC') ?></th>
            <th><?php echo lang('PARENT') ?></th>
            <th><?php echo lang('ORDERING') ?></th>
            <th><?php echo lang('VISIBILITY') ?></th>
            <th><?php echo lang('ALLOW_COMMENT') ?></th>
            <th><?php echo lang('ALLOW_ADS') ?></th>
            <th><?php echo lang('CONTROL') ?></th>
          </tr>
            </thead>
           <tbody>
          <?php
          $num = 1;
          foreach ($category as $cat) {
            echo"<tr>";
            echo"<td>$num</td>";
            echo"<td>$cat[name]</td>";
            echo"<td>$cat[description]</td>";
            $parent_cats = sql("SELECT * FROM categories WHERE cat_id = $cat[parent]","fetch");
            echo"<td>$parent_cats[name]</td>";
            echo"<td>$cat[ordering]</td>";
            echo"<td>$cat[visibility]</td>";
            echo"<td>$cat[allow_comment]</td>";
            echo"<td>$cat[allow_ads]</td>";
            echo"<td><a href='?do=edit&catid=$cat[cat_id]' class='start-btn green'><i class='fa fa-edit'></i>";?><?php echo lang('EDIT') ?><?php echo "</a>
            <a href='?do=delete&catid=$cat[cat_id]' class='confirm start-btn orangered confirm'><i class='fa fa-close'></i>";?><?php echo lang('DELETEBTN') ?><?php echo "</a></td>";
            // Get Sub Categoriey
            echo "<ul>";
          //  $subcategories = select("*","categories","where parent = $cat[ID]","","ID");
          //  $subcategories = sql("SELECT * FROM categories WHERE parent = $cat[cat_id] ORDER By cat_id","fetchAll");
          //  foreach ($subcategories as $subcat) {
          //   echo "<li>";
          //   echo $subcat['name'];
          //   echo"<a href='?do=edit&catid=$subcat[cat_id]' class='start-btn green'><i class='fa fa-edit'></i>Edit</a>
          //   <a href='?do=delete&catid=$subcat[cat_id]' class='confirm start-btn orangered confirm'><i class='fa fa-close'></i>Delete</a>";
          //   echo "</li>";
          //   echo "</ul>";
          //   echo"<tr>";
          //  }
           $num++;
          }
          ?>
          </tbody>
  </table>

        <a href="?do=add" class="start-btn blue add"><span class="fa fa-plus"></span><?php echo lang('ADDNEW') ?></a>
<?php
pages_links("categories");
}
elseif($do == 'add'){
?>
  <h3 class="table-title"><span>Add New Category</span><i class="fa fa-sitemap" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=insert" method="post">
  <!--Start Name -------------->
    <label  class="col-sm-2 control-label">Name</label>
    <input type="text" class="form-control" name="name" placeholder="name" required="required">
  <!--Start Description-------------->
    <label  class="col-sm-2 control-label">Description</label>
    <input type="text"  class="form-control" name="description"  placeholder="Description">
  <!--Start Ordering -------------->
    <label class="col-sm-2 control-label">Ordering</label>
      <input type="number" class="form-control" name="ordering"  placeholder="Ordering">
  <!--Start Category Parent -------------->

    <label class="col-sm-2 control-label">Category Parent</label>
    <select name="parent">
      <option value="0">None</option>
      <?php
      //Select Categories Data From database
      $cats = sql("SELECT * FROM categories WHERE parent = 0 ORDER By cat_id","fetchAll");
      foreach ($cats as $cat) {
      echo "<option value='$cat[name]'> $cat[name]</option>";
    }
      ?>
    </select>
  <!----------------Start Full Visibility -------------->
    <div class="radio-row">
    <label for="inputEmail3" class="col-sm-2 control-label">Visibile</label>
        <input id="vis-yes" type="radio" name="visibility" value="0" checked />
        <label for="vis-yes">Yes</label>
        <input id="vis-no" type="radio" name="visibility" value="1"  />
        <label for="vis-no">No</label>
        </div>
  <!----------------Start Allow Commenting -------------->
    <div class="radio-row">
    <label for="inputEmail3" class="col-sm-2 control-label">Allow Commenting</label>
        <input id="com-yes" type="radio" name="commenting" value="0" checked />
        <label for="com-yes">Yes</label>
        <input id="com-no" type="radio" name="commenting" value="1"/>
        <label for="com-no">No</label>
        </div>
  <!----------------Start Allow Ads -------------->
    <div class="radio-row">
    <label for="inputEmail3" class="col-sm-2 control-label">Allow Ads</label>
        <input id="ads-yes" type="radio" name="ads" value="0" checked />
        <label for="ads-yes">Yes</label>
        <input id="ads-no" type="radio" name="ads" value="1" />
        <label for="ads-no">No</label>
        </div>
  <!----------------Start Sent -------------->
      <button type="Add Category" class="start-btn blue"><?php echo lang('EDIT') ?></button>
</form>
</div>
<?php
}
elseif($do == 'insert'){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  echo '<h3>Insert Category</h3>';
  //Get Category Data From Form
  $name      =$_POST['name'];
  $desc      =$_POST['description'];
  $parent    =$_POST['parent'];
  $order     =$_POST['ordering'];
  $visible   =$_POST['visibility'];
  $comment   =$_POST['commenting'];
  $ads       =$_POST['ads'];

    // Check If Category Exit In Database
    $check = checkItems("name","categories",$name );
    if($check == 1){
      $Msg = 'Sorry This category Id Exist';
      redirect($Msg,'back');
    }else{
    sql("INSERT INTO categories (name, description,parent, ordering, visibility, allow_comment, allow_ads)
    VALUES ('$name', '$desc','$parent','$order', '$visible','$comment','$ads')","");

  $Msg = "<div class='alert alert-success'>Inserted Successfully</div>";
  redirect($Msg,'back');
  }
  }else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
  }


}
elseif($do == 'edit'){
  $Msg ="<div class='alert alert-danger'>Wrong Request</div>";
  $catid = isset($_GET['catid']) && is_numeric($_GET['catid'])?intval($_GET['catid']) : redirect($Msg,'back',3);
//Select Category Data From database
$cat = sql("SELECT * FROM categories WHERE cat_id = '$catid'","fetch");
if ($count == 1){
  ?>
  <h3 class="table-title"><span>Edit Category</span><i class="fa fa-sitemap" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post">
    <input type="hidden" name="catid" value="<?php echo $catid ?>">
  <!----------------Start Name -------------->
    <label  class="col-sm-2 control-label">Name</label>
    <input type="text" class="form-control" name="name" placeholder="name" required="required" value="<?php echo $cat['name']?>">
  <!----------------Start Description-------------->
    <label>Description</label>
      <input type="text"  class="form-control" name="description"  placeholder="Description" value="<?php echo $cat['description']?>">
  <!----------------Start Ordering -------------->
    <label class="col-sm-2 control-label">Ordering</label>
      <input type="number" class="form-control" name="ordering"  placeholder="Ordering" value="<?php echo $cat['ordering']?>">
  <!----------------Start Category Parent -------------->

    <label>Category Parent</label>
    <select name="parent">
      <option value="0">None</option>
      <?php
      //Select Categories Data From database
      $allcats = sql("SELECT * FROM categories WHERE parent = 0 ORDER BY cat_id","fetchAll");
      foreach ($allcats as $catparent) {
      echo "<option value='$catparent[cat_id]'";
      if ($catparent['cat_id'] == $cat['parent'] ){echo "selected";}
      echo "> $catparent[name]</option>";
    }
      ?>
    </select>
  <!----------------Start Full Visibility -------------->
    <div class="radio-row">
    <label>Visibile</label>
        <input id="vis-yes" type="radio" name="visibility" value="0" <?php if($cat['visibility'] == 0){echo 'checked';} ?>/>
        <label for="vis-yes">Yes</label>
        <input id="vis-no" type="radio" name="visibility" value="1" <?php if($cat['visibility'] == 1){echo 'checked';} ?> />
        <label for="vis-no">No</label>
        </div>
  <!----------------Start Allow Commenting -------------->
  <div class="radio-row">
    <label>Allow Commenting</label>
        <input id="com-yes" type="radio" name="commenting" value="0" <?php if($cat['allow_comment'] == 0){echo 'checked';} ?>/>
        <label for="com-yes">Yes</label>
        <input id="com-no" type="radio" name="commenting" value="1" <?php if($cat['allow_comment'] == 1){echo 'checked';} ?> />
        <label for="com-no">No</label>
        </div>
  <!----------------Start Allow Ads -------------->
    <div class="radio-row">
    <label>Allow Ads</label>
        <input id="ads-yes" type="radio" name="ads" value="0" <?php if($cat['allow_ads'] == 0){echo 'checked';} ?> />
        <label for="ads-yes">Yes</label>
        <input id="ads-no" type="radio" name="ads" value="1" <?php if($cat['allow_ads'] == 1){echo 'checked';} ?> />
        <label for="ads-no">No</label>
        </div>
  <!----------------Start Sent -------------->
      <button type="Update" class="start-btn blue"><?php echo lang('UPDATEBTN') ?></button>
  </form>
  </div>
<?php
}
}
elseif($do == 'update'){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo '<h3>update</h3>';

  //Get User Data From Form

  $id        =$_POST['catid'];
  $name      =$_POST['name'];
  $desc      =$_POST['description'];
  $order     =$_POST['ordering'];
  $parent     =$_POST['parent'];
  $visible   =$_POST['visibility'];
  $comment   =$_POST['commenting'];
  $ads       =$_POST['ads'];


  //Update In Database
  $update_category = sql("UPDATE categories SET name = '$name',description = '$desc',ordering = '$order',
                  parent = '$parent',visibility = '$visible',allow_comment = '$comment',allow_ads = '$ads'
                  WHERE cat_id = '$id'","");
                  echo "<div class='success'>";
                  $Msg = "<p>Updated Successfully</p>";
                  redirect($Msg,'back',3);
                  echo "</div>";


}else{
  $Msg = 'no allow';
  redirect($Msg,'back',3);
}


}
elseif($do == 'delete'){
  //Delete Category Page
  echo"<h1>Delete Category</h1>
  <div class='container'>";
  $catid = isset($_GET['catid']) && is_numeric($_GET['catid'])?intval($_GET['catid']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("cat_id","categories",$catid);
//Select User Data From database
if ($check == 1){
  $delete_category = sql("DELETE FROM categories WHERE cat_id = '$catid'","");
  $Msg = "<div class='alert alert-success'>Deleted Successfully</div>";
  redirect($Msg);
}else{
  $Msg ="This Id Is Not Exist";
  redirect($Msg,'back');
}
echo"</div>";

}
else{
$Msg = '<div class="alert alert-danger">Error</div>';
redirect($Msg,'back');
}
}else{
  $Msg ="You Must Login";
  redirect($Msg);
}


echo"</div>";
echo"</div>";
echo "</section>";
include "$str/footer.php";
?>
