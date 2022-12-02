<?php
$pageTitle ="New Ad";
include "init.php";
 ?>
<div class="container">
<div class="page-style-one createads">
<h2 class="page-title">Create New Ad</h2>
<?php
if(isset($_SESSION['user'])){
if($_SERVER['REQUEST_METHOD'] == 'POST'){

/*--- Set Variables ---*/
$formErrors = array();
$name       = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
$desc       = filter_var($_POST['description'],FILTER_SANITIZE_STRING);
$price      = filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);
$category   = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
$uid        = $_SESSION['uid'];

/*--- PHP Validation ---*/
if(strlen($name) < 4){
  $formErrors[] = "Name Must Be More Than 4 Characters";
}
if(strlen($desc) < 10){
  $formErrors[] = "Description Must Be More Than 10 Characters";
}
if(empty($price)){
  $formErrors[] = "Price Required";
}
if(empty($category)){
  $formErrors[] = "Category Required";
}
foreach ($formErrors as $error){
echo "<div class='alert alert-danger'>$error</div>";
}

/*--- Update In Database ---*/
if (empty($formErrors)){
   upload("file","","data/uploads/");
  $stmt = sql("INSERT INTO items (name, description, price,date,cat_id,user_id,image)
  VALUES ('$name', '$desc', '$price',NOW(),'$category','$uid','$insert_src')","");
  echo "Added Succefully";
}
}
?>
<form class="form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<!----------------Start Name -------------->
<div class="form-group">
<label  class="col-sm-2 control-label">Name</label>
<div class="col-sm-10">
<input type="text" class="form-control live"  data-class=".live-name" name="name" placeholder="name" required="required">
</div>
</div>
<!----------------Start Description -------------->
<div class="form-group">
<label  class="col-sm-2 control-label">Description</label>
<div class="col-sm-10">
<input type="text" class="form-control live" data-class=".live-desc" name="description" placeholder="Description" required="required">
</div>
</div>
<!----------------Start Price -------------->
<div class="form-group">
<label  class="col-sm-2 control-label">Price</label>
<div class="col-sm-10">
<input type="text" class="form-control live" data-class=".live-price" name="price" placeholder="Price" required="required">
</div>
</div>
<!----------------Start Categories -------------->
<div class="form-group">
<label class="col-sm-2 control-label">Categories</label>
<div class="col-sm-10">
<select name="category" class="form-control" required="required">
  <option value="">Choose Category</option>
<?php
/*--- Select Categories Data From database ---*/
$cats = sql("SELECT * FROM categories WHERE activity = 1 ORDER BY id","fetchAll");
foreach ($cats as $cat) {
echo "<option value='$cat[id]'> $cat[name]</option>";
}
?>
</select>
</div>
</div>
<!----------------Start Image -------------->
  <labe>Image</label>
  <input type="file" class="form-control" name="file" placeholder="Image" required="required">
<!----------------Start Send -------------->
<button type="Add Item" class="start-btn blue">Add Item</button>
</form>
</div>
</div>
</div>
<?php
}else{
  header('Location:login.php');
  exit();
}
include "$str/footer.php";
?>
