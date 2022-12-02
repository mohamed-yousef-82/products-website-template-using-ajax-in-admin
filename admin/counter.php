<?php
$pageTitle ="Slideshow";
include "init.php";

if(isset($_SESSION['username'])){

$do = isset($_GET['do'])?$_GET['do'] : 'manage';
?>

<section class="main-section box box-5">
<div class="view-data">
  <div class="page-container">
  <?php
//Pending Users
if($do =='manage'){
echo "<h3 class='table-title'><span>Counter</span><i class='fa fa-building' aria-hidden='true'></i></h3>";
  //Select Categories Data From database
  $select = sql("SELECT * FROM counter ORDER By id DESC ","fetchAll");

?>
<table class="table">
<thead>
  <tr>
    <th><?php echo lang('NUMBER') ?></th>
    <th><?php echo lang('TITLE') ?></th>
    <th><?php echo lang('COUNT') ?></th>
    <th><?php echo lang('IMAGE') ?></th>
    <th><?php echo lang('CONTROL') ?></th>
  </tr>
    </thead>
          <?php
          $num = 1;
          foreach ($select as $selectview) {
            echo "<tr>";
            echo "<td>$num</td>";
            echo "<td>$selectview[title]</td>";
            echo "<td>$selectview[count]</td>";
            echo "<td><img style='width:100px;height:100px;' src='../$selectview[image]' /></td>";
            echo "<td><a href='?do=edit&id=$selectview[id]' class='start-btn green'><i class='fa fa-edit'></i>";?><?php echo lang('EDIT') ?><?php echo "</a>
            <a href='?do=delete&id=$selectview[id]' class='confirm start-btn orangered confirm'><i class='fa fa-close'></i>";?><?php echo lang('DELETEBTN') ?><?php echo "</a></td>";
            $num++;
           }
            echo"</tr>";
          ?>
        </table>
        <a href="?do=add" class="start-btn blue add"><i class="fa fa-plus"></i> <?php echo lang('ADDNEW') ?></a>
<?php
}
elseif($do == 'add'){
?>
    <h3 class="table-title"><span>Add New</span><i class="fa fa-users" aria-hidden="true"></i></h3>
    <div class="child-page">
  <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
    <label>Title</label>
    <input type="text" name="title" placeholder="Title" required="required">
    <label>Count</label>
    <input type="number" name="count" placeholder="Count" required="required">
    <label>Image</label>
    <input type="file" name="file" placeholder="Image" required="required">
  <!----------------Start Sent -------------->
      <button type="Add Category" class="start-btn blue"><?php echo lang('ADDNEW') ?></button>
</form>
  </div>
<?php
}
elseif($do == 'insert'){
  $title = $_POST['title'];
  $count = $_POST['count'];
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  echo '<h3>Insert New</h3>';

      upload("file","","../data/uploads/");
    sql("INSERT INTO Counter (title,count,image)
    VALUES ('$title','$count','$insert_src')","");

  $Msg = "<div class='alert alert-success'>Inserted Successfully</div>";
  redirect($Msg,'back');

  }else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
  }
}
elseif($do == 'edit'){
  $Msg ="<div class='alert alert-danger'>Wrong Request</div>";
  $id = isset($_GET['id']) && is_numeric($_GET['id'])?intval($_GET['id']) : redirect($Msg,'back',3);
  //Select Category Data From database
  $select = sql("SELECT * FROM counter WHERE id = '$id'","fetch");
  ?>
  <h3 class="table-title"><span>Edit Counter</span><i class="fa fa-users" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $id ?>">
  <!----------------Start Category Parent -------------->
  <label>Title</label>
  <input type="text" name="title" value="<?php echo $select['title'] ?>">
  <label>Count</label>
  <input type="number" name="count" value="<?php echo $select['count'] ?>">
  <label>Image</label>
  <input type="hidden" name="oldfile" value="<?php echo $select['image'] ?>">
  <input type="file" name="file" placeholder="Image">
  <!----------------Start Sent -------------->
  <button type="Update" class="start-btn blue"><?php echo lang('EDIT') ?></button>
  </form>
  </div>
<?php

}
elseif($do == 'update'){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo '<h3>update</h3>';

  //Get User Data From Form
  $title = $_POST['title'];
  $count = $_POST['count'];
  $oldfile   =$_POST['oldfile'];
  $id        =$_POST['id'];
  //Update In Database
  upload("file",$oldfile,"../data/uploads/");
  $update = sql("UPDATE counter SET title = '$title',count = '$count',image = '$insert_src'
                  WHERE id = '$id'","");
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
  echo"<h1>Delete Counter</h1>
  <div class='container'>";
  $id = isset($_GET['id']) && is_numeric($_GET['id'])?intval($_GET['id']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("id","counter",$id);
//Select User Data From database
if ($check == 1){
  $delete = sql("DELETE FROM counter WHERE id = '$id'","");
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
echo"</section>";
include "$str/footer.php";
?>
