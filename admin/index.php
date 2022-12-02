<?php
/*---To Hidden Navbar ---*/
$noNavbar="";
$pageTitle ="Login";
include "init.php";
if(isset($_SESSION['username'])){
  header('Location:dashboard/dashboard.php');
}
?>
<?php
/*---Check If User Comming From HTTP Post Request ---*/
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $username=$_POST['user'];
  $userpass=$_POST['pass'];
  $hashepass=sha1($userpass);

/*---Check If The User Comming Is Exist In Database ---*/
$check_user = sql("SELECT id,username,password FROM users WHERE username = '$username' AND password = '$hashepass' And activity = 1 And level !=2 LIMIT 1 ","fetch");
if ($count == 1){
$_SESSION['username'] = $username;
$_SESSION['id'] = $check_user['id'];
header('Location:dashboard/dashboard.php');
exit();
}
}
?>
<div class="login-page">
<form class="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
<h3 class="text-center">Admin Login</h3>
<input class="form-control input-lg" name="user" type="text" placeholder="username" autocomplete="off"  />
<input class="form-control input-lg" name="pass" type="password" placeholder="password" autocomplete="off"  />
<input class="start-btn orangered" type="submit" value="<?php echo lang('LOGON') ?>" name="submit" />
</form>
</div>
