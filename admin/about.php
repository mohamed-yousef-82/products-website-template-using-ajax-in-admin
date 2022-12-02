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
  echo "<h3 class='table-title'><span>";?><?php echo lang('ABOUT') ?><?php echo"</span><i class='fa fa-building' aria-hidden='true'></i></h3>";
  echo "<div class='row row-medium'>";
  echo "<div class='box box-1'>";
  echo "<div class='panel'>";
  //Select User Data From database
  $about = sql("SELECT * FROM about","fetch");
  if(!empty($about)){
    echo "<img class='single-img' src='../$about[image]'/>";
    echo "<br/>";
    echo "<h3> $about[title]</h3>";
    echo "<br/>";
    echo "<p> $about[description]</p>";
    echo"<br/><a href='?do=edit' class='start-btn blue'><i class='fa fa-edit'></i>";?><?php echo lang('EDIT') ?><?php echo "</a>";;
  ?>
  <?php
  }
  else{
    ?>



    <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
    <!----------------Start Name -------------->
      <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
      <input type="text" class="form-control" name="title" placeholder="Title" required="required">

    <!----------------Start Description -------------->
      <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
      <input type="text" class="form-control" name="description"  placeholder="Description" required="required">
    <!----------------Start Image -------------->
      <label  class="col-sm-2 control-label">Image</label>
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
  $title            =$_POST['title'];
  $description      =$_POST['description'];

  //php validation

$formErrors=array();

  if(empty($title)){
    $formErrors[] = "Title  Required";
  }

  if(empty($description)){
    $formErrors[] = "description Required";
  }


  foreach ($formErrors as $error){
  echo "<div class='alert alert-danger'>$error</div>";
  }
  //Update In Database
  if (empty($formErrors)){

      upload("file","","../data/uploads/");
      sql("INSERT INTO about (title,description,image)
              VALUES ('$title', '$description','$insert_src')","");
  $Msg = "<div class='alert alert-success'>Inserted Successfully</div>";
  redirect($Msg,'back');
}
}else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
}



}elseif($do == 'edit'){

$edit_about = sql("SELECT * FROM about","fetch");

  ?>
  <h3 class="table-title"><span><?php echo lang('ABOUTEDIT') ?></span><i class="fa fa-building" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
  <!----------------Start Name -------------->
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="title" value="<?php echo $edit_about['title'] ?>">
    </div>
  </div>
  <!----------------Start Full Name -------------->
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">description</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="description"><?php echo $edit_about['description'] ?></textarea>
    </div>
  </div>
  <!----------------Start Image -------------->
  <div class="form-group">
    <label  class="col-sm-2 control-label">Image</label>
    <div class="col-sm-10">
      <input type="hidden"  class="form-control" name="oldfile" value="<?php echo $edit_about['image'] ?>">
      <input type="file" class="form-control" name="file" placeholder="image">
    </div>
  </div>
  <!----------------Start Sent -------------->
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="start-btn blue"><?php echo lang('EDIT') ?></button>
    </div>
  </div>
</form>
  </div>
<div class="col-md-8">
<?php
}elseif($do == 'update'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Get User Data From Form
    $title            =$_POST['title'];
    $description      =$_POST['description'];
    $oldfile          =$_POST['oldfile'];
    //Update In Database
      upload("file",$oldfile,"../data/uploads/");
      sql("UPDATE about SET title = '$title',description = '$description',image = '$insert_src'","");
      echo "<div class='success'>";
      $Msg = "<p>Updated Successfully</p>";
      redirect($Msg,'back',1);
      echo "</div>";

}else{
    $Msg = 'no allow';
    redirect($Msg,'back',3);
}
echo "</div>";
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
