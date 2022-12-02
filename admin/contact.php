
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
  echo "<h3 class='table-title'><span>About Company</span><i class='fa fa-building' aria-hidden='true'></i></h3>";
  //Select User Data From database
  $contact = sql("SELECT * FROM contact","fetch");
  if(!empty($contact)){
    echo "<div class='row row-medium'>";
    echo "<div class='box box-1'>";
    echo "<div class='panel'>";
    echo "<p>Email : $contact[email]</p>";
    echo "<p>Phone : $contact[phone]</p>";
    echo"<br/><a href='?do=edit' class='start-btn blue'><i class='fa fa-edit'></i>";?><?php echo lang('EDIT') ?><?php echo "</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  ?>

  <?php
  }
  else{
    ?>



    <form class="form" action="?do=insert" method="post" enctype="multipart/form-data">
      <h3>Contact Data</h3>
    <!----------------Start Name -------------->
      <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
      <input type="text" class="form-control" name="email" placeholder="email" required="required">

    <!----------------Start Description -------------->
      <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
      <input type="text" class="form-control" name="phone"  placeholder="phone" required="required">
    <!----------------Start Sent -------------->
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="start-btn blue"><?php echo lang('EDIT') ?></button>
      </div>
    </div>
  </form>

    <?php
  }
  ?>

<?php
}elseif($do == 'insert'){

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  echo '<h3>Insert</h3>';
  //Get User Data From Form
  $email            =$_POST['email'];
  $phone      =$_POST['phone'];

  //php validation

$formErrors=array();

  if(empty($email)){
    $formErrors[] = "Email  Required";
  }

  if(empty($phone)){
    $formErrors[] = "Phone Required";
  }


  foreach ($formErrors as $error){
  echo "<div class='alert alert-danger'>$error</div>";
  }
  //Update In Database
  if (empty($formErrors)){

      // upload("file","","../data/uploads/");
      sql("INSERT INTO contact (email,phone)
              VALUES ('$email', '$phone')","");
  $Msg = "<div class='alert alert-success'>Inserted Successfully</div>";
  redirect($Msg,'back');
}
}else{
  $Msg='<div class="alert alert-danger">Wrong Request</div>';
  redirect($Msg,'back');
}



}elseif($do == 'edit'){

$contact = sql("SELECT * FROM contact","fetch");

  ?>
  <h3 class="table-title"><span>Edit Contact Data</span><i class="fa fa-building" aria-hidden="true"></i></h3>
  <div class="child-page">
  <form class="form" action="?do=update" method="post" enctype="multipart/form-data">
  <!----------------Start Name -------------->
  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
  <input type="text" class="form-control" name="email" value="<?php echo $contact['email'] ?>" >
  <!----------------Start Full Name -------------->
  <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
  <input type="text" class="form-control" name="phone" value="<?php echo $contact['phone'] ?>" />
  <!----------------Start Sent -------------->
  <button type="submit" class="start-btn blue"><?php echo lang('INSERT') ?></button>
</form>
</div>
<?php
}elseif($do == 'update'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Get User Data From Form
    $email      =$_POST['email'];
    $phone      =$_POST['phone'];
    //Update In Database
      // upload("file",$oldfile,"../data/uploads/");
      sql("UPDATE contact SET email = '$email',phone = '$phone'","");
      echo "<div class='success'>";
      $Msg = "<p>Updated Successfully</p>";
      redirect($Msg,'back',3);
      echo "</div>";

}else{
    $Msg = 'no allow';
    // redirect($Msg,'back',3);
}
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
