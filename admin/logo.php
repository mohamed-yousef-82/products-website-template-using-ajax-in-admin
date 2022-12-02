
<?php
$pageTitle ="users";
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
echo "<h3 class='table-title'><span>";?><?php echo lang('LOGO') ?><?php echo"</span><i class='fa fa-building' aria-hidden='true'></i></h3>";
echo "<div class='row row-medium'>";
echo "<div class='box box-1'>";
echo "<div class='panel'>";
  //Select User Data From database
  $logo = sql("SELECT * FROM logo","fetch");
  if(!empty($logo)){
    echo "<img class='single-img' src='../$logo[image]'/>";
    echo "<br/>";
    echo "<h3> $logo[name]</h3>";
    echo"<br/><a href='?do=edit' class='start-btn blue'><i class='fa fa-edit'></i>";?><?php echo lang('EDIT') ?><?php echo "</a>";
  ?>

  <?php
  }
  else{
    ?>
    <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
    <!----------------Start Name -------------->
      <label>Name</label>
      <input type="text" class="form-control" name="name" placeholder="Title" required="required">
    <!----------------Start Image -------------->
      <label>Logo</label>
      <input type="file" class="form-control" name="file" placeholder="Image" required="required">
    <!----------------Start Sent -------------->
      <button type="submit" class="start-btn blue"><?php echo lang('INSERT') ?></button>
  </form>
    <?php
  }
  ?>
<?php
}elseif($do == 'insert'){

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //Get User Data From Form
  $title            =$_POST['name'];
  //php validation

$formErrors=array();

  if(empty($title)){
    $formErrors[] = "Name  Required";
  }


  foreach ($formErrors as $error){
  echo "<div class='alert alert-danger'>$error</div>";
  }
  //Update In Database
  if (empty($formErrors)){

      upload("file","","../data/uploads/");
      sql("INSERT INTO logo (name,image)
      VALUES ('$title','$insert_src')","");
  $Msg = "<div class='alert alert-success'>Inserted Successfully</div>";
  redirect($Msg,'back');
}
}else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
}



}elseif($do == 'edit'){

$edit_logo = sql("SELECT * FROM logo","fetch");

  ?>
  <h3 class="table-title"><span><?php echo lang('LOGOEDIT') ?></span><i class="fa fa-building" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
  <!----------------Start Name -------------->
    <label>Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo $edit_logo['name'] ?>">
  <!----------------Start Image -------------->
    <label>Image</label>
      <input type="hidden" name="oldfile" value="<?php echo $edit_logo['image'] ?>">
      <input type="file" name="file" placeholder="image">
  <!----------------Start Sent -------------->
      <button type="submit" class="start-btn blue"><?php echo lang('EDIT') ?></button>
  </form>
  </div>
<?php
}elseif($do == 'update'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Get User Data From Form
    $name            =$_POST['name'];
    $oldfile          =$_POST['oldfile'];
    //Update In Database
      upload("file",$oldfile,"../data/uploads/");
      sql("UPDATE logo SET name = '$name',image = '$insert_src'","");
      echo "<div class='success'>";
      $Msg = "<p>Updated Successfully</p>";
      redirect($Msg,'back',3);
      echo "</div>";

}else{
    $Msg = 'no allow';
    redirect($Msg,'back',3);
}
}

}else{
  $Msg ="You Must Login";
  redirect($Msg);
}
echo "</div>";
echo "</div>";
echo "</div>";
echo"</div>";
echo"</div>";
echo"</section>";
include "$str/footer.php";
?>
