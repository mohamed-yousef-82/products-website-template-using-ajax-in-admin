<?php
$pageTitle ="registration";
include "init.php";
//Manage Page
  ?>
  <div class="container">
  <div class="page-style-one">
  <h2 class="page-title">Registration</h2>
  <form class="form" action="?do=Insert" method="post" enctype="multipart/form-data">
  <!----------------Start Name -------------->
    <label class="col-sm-2 control-label">Name</label>
      <input type="text" class="form-control" name="username" placeholder="Username" required="required">
  <!----------------Start image -------------->
    <label  class="col-sm-2 control-label">Image</label>
      <input type="file" class="form-control" name="file" placeholder="Image" required="required">
  <!----------------Start Password -------------->
    <label class="col-sm-2 control-label">Password</label>
      <input type="password"  class="password form-control" name="password" autocomplete="new-password" placeholder="Password">
  <!----------------Start Email -------------->
    <label class="col-sm-2 control-label">Email</label>
      <input type="email" class="form-control" name="email" placeholder="Email" required="required">
  <!----------------Start Sent -------------->
      <button type="submit" class="start-btn blue"><?php echo lang('INSERT') ?></button>
</form>
<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //Get User Data From Form
  $user      =$_POST['username'];
  $pass      =$_POST['password'];
  $hashpass  =sha1($_POST['password']);
  $email     =$_POST['email'];

  //php validation

$formErrors=array();
  if(strlen($user) < 4){
    $formErrors[] = "Your Username Is Very Less";
  }

  if(strlen($user) > 20){
    $formErrors[] = "Your Username Is Very Long";
  }

  if(empty($user)){
    $formErrors[] = "Username Required";
  }

  if(empty($pass)){
    $formErrors[] = "Password Required";
  }

  if(empty($email)){
    $formErrors[] = "Email Required";
  }

  if(empty($email)){
    $formErrors[] = "Email Required";
  }

  foreach ($formErrors as $error){
  echo "<div class='alert alert-danger'>$error</div>";
  }
  //Update In Database
  if (empty($formErrors)){
    // Check If User Exit In Database
    $check = checkItems("username","users",$user);
    if($check > 0){
      $Msg = 'Sorry This User  Id Exist';
      redirect($Msg,'back');
    }else{
      upload("file","","data/uploads/");
      sql("INSERT INTO users (username, password, email,level,date,image)
              VALUES ('$user', '$hashpass', '$email',2,NOW(),'$insert_src')","");
  echo "<div class='alert alert-success'>Inserted Successfully</div>";
  // redirect($Msg,'back');
}
}
}
echo "</div>";
echo "</div>";
echo "</div>";
include "$str/footer.php";
?>
