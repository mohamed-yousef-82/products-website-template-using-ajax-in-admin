<?php
$pageTitle ="categories";
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
  pages();
echo "<h3 class='table-title'><span>Clients</span><i class='fa fa-building' aria-hidden='true'></i></h3>";
  $sort = 'ASC';
  $sort_array = array('ASC','DESC');
  if (isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
     $sort = $_GET['sort'];
  }

  //Select Categories Data From database
  $clients = sql("SELECT * FROM clients ORDER By client_id DESC  LIMIT $page_start,$page_items","fetchAll");

?>




<table class="table">
<thead>
  <tr>
    <th><?php echo lang('NUMBER') ?></th>
    <th><?php echo lang('CATEGORY_NAME') ?></th>
    <th><?php echo lang('CONTROL') ?></th>
  </tr>
    </thead>
          <?php
          $num = 1;
          foreach ($clients as $client) {
            echo "<tr>";
            echo "<td>$num</td>";
            echo "<td><img style='width:100px;height:100px;' src='../$client[image]' /></td>";
            echo "<td><a href='?do=edit&client_id=$client[client_id]' class='start-btn green'><i class='fa fa-edit'></i>"?><?php echo lang('EDIT') ?><?php echo "</a>
            <a href='?do=delete&client_id=$client[client_id]' class='confirm start-btn orangered confirm'><i class='fa fa-close'></i>"?><?php echo lang('DELETEBTN') ?><?php echo "</a></td>";
            $num++;
           }
            echo"</tr>";
          ?>
        </table>
        <a href="?do=add" class="start-btn blue add"><i class="fa fa-plus"></i> <?php echo lang('ADDNEW') ?></a>
<?php
pages_links("clients");
}
elseif($do == 'add'){
?>
    <h3 class="table-title"><span>Add New Client</span><i class="fa fa-users" aria-hidden="true"></i></h3>
    <div class="child-page">
  <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label  class="col-sm-2 control-label">Image</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" name="file" placeholder="Image" required="required">
    </div>
  </div>
  <!----------------Start Sent -------------->
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="Add Category" class="start-btn blue"><?php echo lang('ADDNEW') ?></button>
    </div>
  </div>
</form>
  </div>
<?php
}
elseif($do == 'insert'){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  echo '<h3>Insert Client</h3>';

      upload("file","","../data/uploads/");
    sql("INSERT INTO clients (image)
    VALUES ('$insert_src')","");

  $Msg = "<div class='alert alert-success'>Inserted Successfully</div>";
  redirect($Msg,'back');

  }else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
  }


}
elseif($do == 'edit'){
  $Msg ="<div class='alert alert-danger'>Wrong Request</div>";
  $client_id = isset($_GET['client_id']) && is_numeric($_GET['client_id'])?intval($_GET['client_id']) : redirect($Msg,'back',3);
  //Select Category Data From database
  $client = sql("SELECT * FROM clients WHERE client_id = '$client_id'","fetch");
  ?>
  <h3 class="table-title"><span>Edit Category</span><i class="fa fa-users" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="client_id" value="<?php echo $client_id ?>">
  <!----------------Start Category Parent -------------->
    <label  class="col-sm-2 control-label">Image</label>
      <input type="hidden"  class="form-control" name="oldfile" value="<?php echo $client['image'] ?>">
      <input type="file" class="form-control" name="file" placeholder="Image">
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
  $oldfile   =$_POST['oldfile'];
  $id        =$_POST['client_id'];
  //Update In Database
  upload("file",$oldfile,"../data/uploads/");
  $update_category = sql("UPDATE clients SET image = '$insert_src'
                  WHERE client_id = '$id'","");
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
  $client_id = isset($_GET['client_id']) && is_numeric($_GET['client_id'])?intval($_GET['client_id']) : 0;
//Chick If Item Exist In Database
  $check = checkItems("client_id","clients",$client_id);
//Select User Data From database
if ($check == 1){
  $delete_category = sql("DELETE FROM clients WHERE client_id = '$client_id'","");
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
