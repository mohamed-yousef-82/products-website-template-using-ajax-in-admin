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

  //Select Items Data From database
  $select = sql("SELECT * from tabs_items  ORDER BY id Desc","fetchAll");

 // $Interface_Users_Items = sql("SELECT items.*,categories.name AS category,users.username
 //                  FROM Items INNER JOIN categories ON categories.cat_id = items.cat_id
 //                  INNER JOIN users ON users.user_id = items.user_id WHERE groupid = 2 ORDER BY item_id Desc","fetchAll");
  ?>
<?php
  if(!empty($select)){
?>
  <h3 class="table-title"><span>Tabs Items</span><i class="fa fa-cubes" aria-hidden="true"></i></h3>
  <table class="main-table text-center table table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Tab</th>
        <th>image</th>
        <th>Control</th>
      </tr>
        </thead>
        <tbody>
      <?php
      $num = 1;
foreach ($select as $select_view) {
echo"<tr>";
echo"<td>$num</td>";
echo"<td>$select_view[title]</td>";
echo"<td>$select_view[description]</td>";
echo"<td>$select_view[tab]</td>";
echo"<td><img style='width:100px;height:100px;' src='../$select_view[image]' /></td>";
echo"<td><div class='inline-btn'><a href='?do=edit&itemid=$select_view[id]' class='start-btn green'><i class='fa fa-edit'></i>";?><?php echo lang('EDIT') ?><?php echo "</a>
<a href='?do=delete&itemid=$select_view[id]' class='start-btn orangered confirm'><i class='fa fa-close'></i>";?><?php echo lang('DELETEBTN') ?><?php echo "</a>";
if($select_view['approve']==0){
  echo "<a href='?do=approve&itemid=$select_view[id]' class='start-btn dark'><i class='fa fa-check'></i>";?><?php echo lang('APPROVE') ?><?php echo "</a>";
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
<?php
echo "<a href='?do=add' class='start-btn blue add'><i class='fa fa-plus'></i>";?><?php echo lang('ADDNEW') ?><?php echo "</a>";
 ?>


  <?php


} elseif($do == 'add'){
  ?>
    <h3 class="table-title"><span>Add New Items</span><i class="fa fa-cubes" aria-hidden="true"></i></h3>
    <div class="child-page">
    <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
    <!----------------Start Name -------------->
      <label>Title</label>
      <input type="text" name="title" placeholder="Title" required="required">
    <!----------------Start Description -------------->
      <label>Description</label>
      <input type="text" name="description" placeholder="Description" required="required">
    <!----------------Start Image -------------->
      <label>Image</label>
        <input type="file" class="form-control" name="file" placeholder="Image" required="required">
    <!----------------Start Categories -------------->
      <label>Tab</label>
      <select name="tab">
        <?php
        //Select Categories Data From database
        $select = sql("SELECT * FROM tabs ORDER BY id","fetchAll");
        foreach ($select as $select_view) {
        echo "<option value='$select_view[title]'> $select_view[title]</option>";
      }
        ?>
      </select>
      <!----------------Start Sent -------------->
        <button class="start-btn blue"><?php echo lang('ADDNEW') ?></button>
  </form>
    </div>
  <?php

}elseif($do == 'insert'){


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo '<h3>Insert</h3>';
    //Get User Data From Form
    $title      =$_POST['title'];
    $desc      =$_POST['description'];
    $tab  =$_POST['tab'];

    //php validation

  $formErrors=array();

    if(empty($title)){
      $formErrors[] = "Title Required";
    }

    if(empty($desc)){
      $formErrors[] = "description Required";
    }

      if(empty($tab)){
      $formErrors[] = "Tab Required";
    }


    foreach ($formErrors as $error){
    echo "<div class='alert alert-danger'>$error</div>";
    }
    //Update In Database

    if (empty($formErrors)){
     upload("file","","../data/uploads/");
      sql("INSERT INTO tabs_items (title, description,tab,image)
              VALUES ('$title', '$desc','$tab','$insert_src')","");
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
$item = sql("SELECT * FROM tabs_items WHERE id ='$itemid'","fetch");
  ?>
  <h3 class="table-title"><span>Edit Item</span><i class="fa fa-cubes" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
  <input type="hidden" name="itemid" value="<?php echo $itemid ?>">
  <!----------------Start Name -------------->
    <label  class="col-sm-2 control-label">Title</label>
      <input
      type="text"
      class="form-control"
      name="title"
      placeholder="Title"
      value="<?php echo $item['title']; ?>">
  <!----------------Start Description -------------->
    <label  class="col-sm-2 control-label">Description</label>
      <input
      type="text"
      class="form-control"
      name="description"
      placeholder="Description"
      value="<?php echo $item['description']; ?>">
  <!----------------Start Categories -------------->
    <label  class="col-sm-2 control-label">Tab</label>
    <select name="tab" class="form-control">
      <?php
      //Select Categories Data From database
      $select = sql("SELECT * FROM tabs ORDER BY id","fetchAll");
      foreach ($select as $tab) {
      echo "<option value='$tab[title]'";  if ($item['tab'] == $tab['title']) {echo 'selected';} echo "> $tab[title]</option>";
    }
      ?>
    </select>
  <!----------------Start Image -------------->
    <label>Image</label>
      <input type="hidden" name="oldfile" value="<?php echo $item['image'] ?>">
      <input type="file" name="file" placeholder="Image" >
    <!----------------Start Sent -------------->
      <button type="Add Item" class="start-btn blue"><?php echo lang('EDIT') ?></button>
</form>
  </div>
<?php
}elseif($do == 'update'){

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo '<h3>update</h3>';

  //Get Item Data From Form

  $id        =$_POST['itemid'];
  $title      =$_POST['title'];
  $desc      =$_POST['description'];
  $tab  =$_POST['tab'];
  $oldfile   =$_POST['oldfile'];

  //Update In Database
        upload("file",$oldfile,"../data/uploads/");
        $update_items = sql("UPDATE tabs_items SET title = '$title', description = '$desc',
                        tab = '$tab',image='$insert_src'
                        WHERE id = '$id'","");
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
  $check = checkItems("id","tabs_items",$itemid);
//Select Item Data From database
if ($check == 1){
       sql("DELETE FROM tabs_items WHERE id = '$itemid'","");

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
  $check = checkItems("id","tabs_items",$itemid);
//Select User Data From database
if ($check == 1){
  sql("UPDATE tabs_items SET approve = 1 WHERE id ='$itemid'","");

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
