<?php
$pageTitle ="Items";
include "init.php";

if(isset($_SESSION['username'])){

$do = isset($_GET['do'])?$_GET['do'] : 'manage';

// =======================================================================//
// Items Page                                                             //
// =======================================================================//
?>
<section class="main-section box box-5">
<div class="view-data">
<div class="page-container">
<?php
//Pending Items
  if($do =='manage'){
  pages();
  // $items_Count = sql("SELECT * FROM items LIMIT $page_start,3","fetch");

  //Select Items Data From database
  $items = sql("SELECT items.*,categories.name AS category,users.username
                   FROM items INNER JOIN categories ON categories.id = items.cat_id
                   INNER JOIN users ON users.user_id = items.user_id WHERE groupid != 2 ORDER BY item_id Desc LIMIT $page_start,$page_items","fetchAll");
 $Interface_Users_Items = sql("SELECT items.*,categories.name AS category,users.username
                  FROM items INNER JOIN categories ON categories.id = items.cat_id
                  INNER JOIN users ON users.user_id = items.user_id WHERE groupid = 2 ORDER BY item_id Desc LIMIT $page_start,$page_items","fetchAll");
  ?>
<?php
  if(!empty($items)){
?>
  <h3 class="table-title"><span>Admin Items</span><i class="fa fa-cubes" aria-hidden="true"></i></h3>
  <table class="main-table text-center table table-bordered">
    <thead>
      <tr>
        <th><?php echo lang('NUMBER') ?></th>
        <th><?php echo lang('TITLE') ?></th>
        <th><?php echo lang('DESC') ?></th>
        <th><?php echo lang('PRICE') ?></th>
        <th><?php echo lang('DATE') ?></th>
        <th><?php echo lang('CATEGORY') ?></th>
        <th><?php echo lang('USERNAME') ?></th>
        <th><?php echo lang('IMAGE') ?></th>
        <th><?php echo lang('CONTROL') ?></th>
      </tr>
        </thead>
        <tbody>
      <?php
      $num = 1;
foreach ($items as $item) {
echo"<tr>";
echo"<td>$num</td>";
echo"<td>$item[name]</td>";
echo"<td>$item[description]</td>";
echo"<td>$item[price]</td>";
echo"<td>$item[add_date]</td>";
echo"<td>$item[category]</td>";
echo"<td>$item[username]</td>";
echo"<td><img style='width:100px;height:100px;' src='../$item[image]' /></td>";
echo"<td><div class='inline-btn'><a href='?do=edit&itemid=$item[item_id]' class='start-btn green'><i class='fa fa-edit'></i>";?><?php echo lang('EDIT') ?><?php echo "</a>
<a href='?do=delete&itemid=$item[item_id]' class='start-btn orangered confirm'><i class='fa fa-close'></i>";?><?php echo lang('DELETEBTN') ?><?php echo "</a>";
if($item['approve']==0){
  echo "<a href='?do=approve&itemid=$item[item_id]' class='start-btn dark'><i class='fa fa-check'></i>";?><?php echo lang('APPROVE') ?><?php echo "</a>";
}
echo"
</div>
</td>
</tr>";
$num++;
}

}
else{
  echo "<div class='nodata'>No Data To Show</div>";
}
        ?>
        </tbody>
  </table>

 <h3 class="table-title"><span>Interface Items</span><i class="fa fa-cubes" aria-hidden="true"></i></h3>
 <?php
if(!empty($Interface_Users_Items)){
 ?>
<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Description</th>
      <th>Price</th>
      <th>Add_Date</th>
      <th>Category</th>
      <th>User</th>
      <th>image</th>
      <th>Control</th>
    </tr>
      </thead>
    <?php
foreach ($Interface_Users_Items as $item) {
echo"<tr>";
echo"<td>$item[item_id]</td>";
echo"<td>$item[name]</td>";
echo"<td>$item[description]</td>";
echo"<td>$item[price]</td>";
echo"<td>$item[add_date]</td>";
echo"<td>$item[category]</td>";
echo"<td>$item[username]</td>";
echo"<td><img style='width:100px;height:100px;' src='../$item[image]' /></td>";
echo"<td>
<a href='?do=delete&itemid=$item[item_id]' class='start-btn orangered confirm'><i class='fa fa-close'></i>";?><?php echo lang('DELETEBTN') ?><?php echo "</a>";
if($item['approve']==0){
echo "<a href='?do=approve&itemid=$item[item_id]' class='start-btn dark'><i class='fa fa-check'></i>";?><?php echo lang('APPROVE') ?><?php echo "</a>";
}
echo"
</td>
</tr>";

}
}
else{
    echo "<div class='nodata'>No Data To Show</div>";
}
      ?>
</table>
  <?php
  echo "<a href='?do=add' class='start-btn blue add'><i class='fa fa-plus'></i>";?><?php echo lang('ADDNEW') ?><?php echo "</a>";
  pages_links("items");

} elseif($do == 'add'){
  ?>
    <h3 class="table-title"><span>Add New Items</span><i class="fa fa-cubes" aria-hidden="true"></i></h3>
    <div class="child-page">
    <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
    <!----------------Start Name -------------->
      <label  class="col-sm-2 control-label">Name</label>
      <input type="text" class="form-control" name="name" placeholder="name" required="required">
    <!----------------Start Description -------------->
      <label  class="col-sm-2 control-label">Description</label>
      <input type="text" class="form-control" name="description" placeholder="Description" required="required">
    <!----------------Start Price -------------->
      <label  class="col-sm-2 control-label">Price</label>
      <input type="text" class="form-control" name="price" placeholder="Price" required="required">
    <!----------------Start Country Made -------------->
      <label  class="col-sm-2 control-label">Country Made</label>
        <input type="text" class="form-control" name="country" placeholder="Country Made" required="required">
    <!----------------Start Status -------------->
      <label  class="col-sm-2 control-label">Status</label>
      <select name="status" class="form-control">
        <option value="1">New</option>
        <option value="2">Used</option>
      </select>
    <!----------------Start Image -------------->
      <label  class="col-sm-2 control-label">Image</label>
        <input type="file" class="form-control" name="file" placeholder="Image" required="required">
    <!----------------Start Categories -------------->
      <label  class="col-sm-2 control-label">Categories</label>
      <select name="category" class="form-control">
        <?php
        //Select Categories Data From database
        $cats = sql("SELECT * FROM categories WHERE parent = 0 ORDER BY cat_id","fetchAll");
        foreach ($cats as $cat) {
        echo "<option value='$cat[cat_id]'> $cat[name]</option>";
        $childcat = sql("SELECT * FROM categories WHERE parent = $cat[cat_id] ORDER BY cat_id","fetchAll");
        foreach ($childcat as $child) {
        echo "<option value='$child[cat_id]'>--- $child[name]</option>";
      }
      }
        ?>
      </select>
    <!----------------Start Tags -------------->
      <label  class="col-sm-2 control-label">Tags</label>
      <input type="text" class="form-control" name="tags" placeholder="Seperate Tags With Comma (,)" >
      <!----------------Start Sent -------------->
        <button type="Add Item" class="start-btn blue"><?php echo lang('ADDNEW') ?></button>
  </form>
    </div>
  <?php

}elseif($do == 'insert'){


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo '<h3>Insert</h3>';
    //Get User Data From Form

    $name      =$_POST['name'];
    $desc      =$_POST['description'];
    $price     =$_POST['price'];
    $country   =$_POST['country'];
    $status    =$_POST['status'];
    $theuser   =$_SESSION['id'];
    $category  =$_POST['category'];
    $tags  =$_POST['tags'];

    //php validation

  $formErrors=array();

    if(empty($name)){
      $formErrors[] = "name Required";
    }

    if(empty($desc)){
      $formErrors[] = "description Required";
    }

    if(empty($price)){
      $formErrors[] = "price Required";
    }

    if(empty($country)){
      $formErrors[] = "country Required";
    }

    if(($status) === 0){
      $formErrors[] = "status Name Required";
    }

    if(($category) === 0){
      $formErrors[] = "Category Required";
    }


    foreach ($formErrors as $error){
    echo "<div class='alert alert-danger'>$error</div>";
    }
    //Update In Database

    if (empty($formErrors)){
     upload("file","","../data/uploads/");
      sql("INSERT INTO items (name, description, price, country_made,status,add_date,cat_id,user_id,tags,image)
              VALUES ('$name', '$desc', '$price', '$country','$status',NOW(),'$category','$theuser','$tags','$insert_src')","");
    $Msg = "<div class='alert alert-success'>Inserted Successfully</div>";
    redirect($Msg,'back');

  }
  }else{
    echo "<div class='success'>";
    $Msg = "<p>Updated Successfully</p>";
    redirect($Msg,'back',3);
    echo "</div>";
  }
  echo "</div>";
}elseif($do == 'edit'){
  $Msg ="<div class='alert alert-danger'>Wrong Request</div>";
  $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']) : redirect($Msg,'back',3);
//Select Item Data From database
$item = sql("SELECT * FROM items WHERE item_id ='$itemid'","fetch");
  ?>
  <h3 class="table-title"><span>Edit Item</span><i class="fa fa-cubes" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
  <input type="hidden" name="itemid" value="<?php echo $itemid ?>">
  <!----------------Start Name -------------->
    <label  class="col-sm-2 control-label">Name</label>
      <input
      type="text"
      class="form-control"
      name="name"
      placeholder="name"
      value="<?php echo $item['name']; ?>">
  <!----------------Start Description -------------->
    <label  class="col-sm-2 control-label">Description</label>
      <input
      type="text"
      class="form-control"
      name="description"
      placeholder="Description"
      value="<?php echo $item['description']; ?>">
  <!----------------Start Price -------------->
    <label  class="col-sm-2 control-label">Price</label>
      <input
      type="text"
      class="form-control"
      name="price"
      placeholder="Price"
      value="<?php echo $item['price']; ?>">
  <!----------------Start Country Made -------------->
    <label  class="col-sm-2 control-label">Country Made</label>
      <input
      type="text"
      class="form-control"
      name="country"
      placeholder="Country Made"
      value="<?php echo $item['country_made']; ?>">
  <!----------------Start Status -------------->
    <label  class="col-sm-2 control-label">Status</label>
    <select name="status" class="form-control">
      <option value="1" <?php if ($item['status'] == 1) {echo 'selected';} ?> >New</option>
      <option value="2" <?php if ($item['status'] == 2) {echo 'selected';} ?> >Used</option>
    </select>
  <!----------------Start Categories -------------->
    <label  class="col-sm-2 control-label">Categories</label>
    <select name="category" class="form-control">
      <?php
      //Select Categories Data From database
      $cats = sql("SELECT * FROM categories ORDER BY cat_id","fetchAll");
      foreach ($cats as $cat) {
      echo "<option value='$cat[cat_id]'";  if ($item['cat_id'] == $cat['cat_id']) {echo 'selected';} echo "> $cat[name]</option>";
    }
      ?>
    </select>
  <!----------------Start Tags -------------->
    <label  class="col-sm-2 control-label">Tags</label>
    <input type="text" class="form-control" name="tags" placeholder="Seperate Tags With Comma (,)" value="<?php echo $item['tags'] ?>" />
  <!----------------Start Image -------------->
    <label  class="col-sm-2 control-label">Image</label>
      <input type="hidden"  class="form-control" name="oldfile" value="<?php echo $item['image'] ?>">
      <input type="file" class="form-control" name="file" placeholder="Image" >
    <!----------------Start Sent -------------->
      <button type="Add Item" class="start-btn blue"><?php echo lang('EDIT') ?></button>
</form>
  </div>
<?php
//Select comments Data From database
$item_comments = sql("SELECT comments.*,users.username As username FROM comments INNER JOIN users
                      ON users.user_id = comments.user_id WHERE item_id='$itemid'","fetchAll");
if(!empty($item_comments)){
?>
<h3 class="child-page">Manage <?php echo $item["name"]; ?> Comments </h3>
<table class="main-table text-center table table-bordered">
  <thead>
    <tr>
      <th>Comment</th>
      <th>Username</th>
      <th>Date</th>
      <th>Control</th>
      </tr>
      </thead>
      <?php
foreach ($item_comments as $row) {
echo"<tr>";
echo"<td>$row[comment]</td>";
echo"<td>$row[username]</td>";
echo"<td>$row[comment_date]</td>";
echo"<td><a href='?do=edit&comid=$row[com_id]' class='start-btn green'><i class='fa fa-edit'></i>";?><?php echo lang('EDIT') ?><?php echo "</a>
<a href='?do=delete&comid=$row[com_id]' class='start-btn orangered confirm'><i class='fa fa-close'></i>";?><?php echo lang('DELETEBTN') ?><?php echo "</a>";
if($row['status']==0){
echo "<a href='?do=approve&comid=$row[com_id]' class='start-btn darb'><i class='fa fa-edit'></i>";?><?php echo lang('APPROVE') ?><?php echo "</a>";
}
echo"
</td>
</tr>";

}
      ?>
</table>
<?php
}
// }else{
//   $Msg='<div class="alert alert-danger">Wrong Request</div>';
//   redirect($Msg,'back');
// }
}elseif($do == 'update'){

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo '<h3>update</h3>';

  //Get Item Data From Form

  $id        =$_POST['itemid'];
  $name      =$_POST['name'];
  $desc      =$_POST['description'];
  $price     =$_POST['price'];
  $country   =$_POST['country'];
  $status    =$_POST['status'];
  $theuser   =$_SESSION['id'];
  $category  =$_POST['category'];
  $tags  =$_POST['tags'];
  $oldfile   =$_POST['oldfile'];

  //Update In Database
        upload("file",$oldfile,"../data/uploads/");
        $update_items = sql("UPDATE items SET name = '$name', description = '$desc',price = '$price',country_made = '$country',
                        status = '$status',user_id = '$theuser',cat_id = '$category',image='$insert_src',tags = '$tags'
                        WHERE item_id = '$id'","");
                        echo "<div class='success'>";
                        $Msg = "<p>Updated Successfully</p>";
                        redirect($Msg,'back',3);
                        echo "</div>";

}else{
  $Msg = 'no allow';
  redirect($Msg,'back',3);
}
echo "</div>";
}
elseif($do == 'delete'){
  //Delete Item Page
  echo"<h1>Delete Item</h1>
  <div class='container'>";
  $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("item_id","items",$itemid);
//Select Item Data From database
if ($check == 1){
       sql("DELETE FROM items WHERE item_id = '$itemid'","");

  $Msg = "<div class='alert alert-success'>Deleted Successfully</div>";
    redirect($Msg,'back');
}else{
  $Msg ="This Id Is Not Exist";
  redirect($Msg,'back');
}
echo"</div>";


}elseif($do == 'approve'){

  //Delete User Page
  echo"<h1>Approve Items</h1>
  <div class='container'>";
  $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("item_id","items",$itemid);
//Select User Data From database
if ($check == 1){
  sql("UPDATE items SET approve = 1 WHERE item_id ='$itemid'","");

  $Msg = "<div class='alert alert-success'>Approved Successfully</div>";
  redirect($Msg,'back');
}else{
  $Msg ="This Id Is Not Exist";
  redirect($Msg,'back');
}
echo"</div>";


}else{
$Msg = '<div class="alert alert-danger">Error</div>';
redirect($Msg,'back');

}
}else{
  $Msg ="You Must Login";
  redirect($Msg);
}
echo"</div>";
echo"</div>";
echo"</section>";
include "$str/footer.php";
?>
