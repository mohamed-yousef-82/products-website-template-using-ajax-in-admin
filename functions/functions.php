<?php

function input_security(){
global $con;
// تنظيف get
$GET_KEYS = array_keys($_GET); // مدخلات المصفوفة
for($i = 0;$i <= sizeof($GET_KEYS) ;$i++){ // التكرار
    $_GET[$GET_KEYS[$i]] = mysqli_real_escape_string($con,$_GET[$GET_KEYS[$i]]);
}
// تنظيف post
$POST_KEYS = array_keys($_POST); // مدخلات المصفوفة
for($i = 0;$i <= sizeof($POST_KEYS) ;$i++){ // التكرار
    $_POST[$POST_KEYS[$i]] = mysqli_real_escape_string($con,$_POST[$POST_KEYS[$i]]);
}
}
// input_security();
/*---Select From Database ---*/
Function sql($sql,$fetch){
  global $con;
  global $count;
  global $data;
  $stmt = $con->prepare($sql);
  $stmt->execute();
  if ($fetch !== ""){
  $count = $stmt->rowCount();
  $data = $stmt->$fetch();
  return $data;
  }
}
/*---Upload File ---*/
Function upload($upload,$oldupload,$src){
  global $file_src;
  global $tmp_file;
  global $insert_src;
  global $allow_extension;
  $file=$_FILES[$upload]["name"];
  $ext = pathinfo($file, PATHINFO_EXTENSION);
  $file = "file_".time().rand(5, 15).".".$ext;
  $tmp_file=$_FILES[$upload]["tmp_name"];
  $file_src=$src.$file;
  $insert_src=str_replace("../","",$file_src);
  $allow_extension = array("jpeg","jpg","gif","png","pdf","pptx");
  $file_ext = explode(".",$file);
  $file_extension = strtolower(end($file_ext));
  if (isset($_FILES[$upload])){
  if (!empty($_FILES[$upload]) && !empty($_FILES[$upload]["tmp_name"])){
  if (in_array($file_extension,$allow_extension)){
  move_uploaded_file($tmp_file,$file_src);
}else{
  echo "File Extension Not Allowed";
}
  }else{
    $insert_src=$oldupload;
  }
  }
  }
/*---Insert In Database ---*/
// Function sql($sql){
//   global $con;
//   $stmt = $con->prepare($sql);
//   $stmt->execute();
//   }
/*--- Echo Page Title ---*/
function getTitle(){
  global $pageTitle;
  if(isset($pageTitle)){
  echo $pageTitle;
  }else{
  echo 'Default';
  }
}
/*--- Redirect Function ---*/
function redirect($Msg,$url=null,$seconds=0){
  if($url === null){
    $url="index.php";
    $link ="Home Page";
  }else{
    $url = isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !==''?$_SERVER['HTTP_REFERER']:'index.php';
  }
  echo "$Msg";
  // echo "<div class='alert alert-danger'>You Will Be Redirect To $url After $seconds Seconds</div>";
  header("refresh:$seconds;url=$url");
 // header('Location: '.$_SERVER['REQUEST_URI']);
  exit();
}

// Check Items In Database Function
function checkItems($select,$from,$value){
  global $con;
  $stmt = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
  $stmt->execute(array($value));
  $count = $stmt->rowCount();
  return "$count";
}

// Counter Function

function counter($item,$table){
  global $con;
  $stmt = $con->prepare("SELECT COUNT($item) From $table");
  $stmt->execute();
  return $stmt->fetchcolumn();
}

// Latest Items Function
Function getLatest($select){
  global $con;
  $stmt = $con->prepare($select);
  $stmt->execute();
  $rows = $stmt -> fetchAll();
  return $rows;
}

function Check_User_Status($user){
  global $con;
  $stmts = $con->prepare("SELECT
    username,activity
    FROM users
    WHERE
    username = ?
    AND activity = 0 ");

  $stmts->execute(array($user));
  $status = $stmts->rowCount();
  return $status;
}

// function pages(){
//   global $page_items;
//   global $page_start;
//   $page_items =3;
//   if (isset($_GET['page'])){
//   $page=$_GET['page'];
//   if ($page =="" || $page =="1"){
//   $page_start =0;
//   }else{
//   $page_start=($page*$page_items)-$page_items;
//   }
//   }else{
//   $page_start =0;
//   }
// }
function pages_links($table){
  global $con;
  $page_items =3;
  $stmt = $con->prepare("SELECT * FROM $table");
  $stmt->execute();
  $count = $stmt->rowCount();
  $pages_num = ceil($count/$page_items);
  echo "<ul class='pages'>";
  for($page=1;$page<=$pages_num;$page++){
      $page_start=($page*$page_items)-$page_items;
  echo "<li><a class='pager' page_start=$page_start page_items=$page_items>$page</a><li>";
  }
  echo "</ul>";
  }

  function admin_security(){
  if(!isset($_SESSION)){ session_start(); }
  $url = $_SERVER['REQUEST_URI'];
  $word = "admin";
  if(!isset($_SESSION['username']) && (strpos($url, $word) !== false )){
      header('Location:../index.php');
      }
  }

?>
