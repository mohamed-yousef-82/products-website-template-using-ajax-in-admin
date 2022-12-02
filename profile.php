<?php
$pageTitle ="Home";
include "init.php";
  if(isset($_SESSION['user'])){
  $user_data = sql("SELECT * FROM users WHERE username = '$siteuser'","fetch");
  $user_id=$data["id"];
  $do = isset($_GET['do'])?$_GET['do'] : 'manage';
  if($do =='manage'){
?>
<div class="container">
  <div class="page-style-one profile">
  <h2 class="page-title">Profile</h2>
     <div class="panel-group">

     <div class="panel-heading">Personal Data</div>

       <?php
       $img = $user_data['image'];
       $profile_img=str_replace("../","",$img);
       ?>
     <p>Photo : </p><?php echo"<img class='profile-img' style='width:100px;height:100px;' src='$profile_img' />"; ?>
     <p>Name : <?php echo $user_data["username"]; ?></p>
     <p>Email : <?php echo $user_data["email"]; ?></p>
     <p>Regester Date : <?php echo $user_data["date"]; ?></p>

     <a href="?do=edit_profile&user_id=<?php echo $user_data['id']?>" class="btn btn-success">Edit Information</a>


     <div class="panel panel-success">
     <h2 class="page-title">Advertisements</h2>
     <div class="personal-data">
      <?php

      /*--- Get Category Items ---*/
      $Items = sql("SELECT * FROM items WHERE user_id = '$user_id' AND activity = 1 ORDER By id","fetchAll");
      if (!empty ($Items)){
      foreach($Items As $Item){
      echo "<a href='items.php?itemid=$Item[id]'>$Item[name]</a>"."<br />";
      echo "$Item[description]"."<br />";
      echo "$Item[date]"."<br />";
      echo"<img style='width:100px;height:100px;' src='$Item[image]' />";
      echo"<div><a href='?do=edit_item&itemid=$Item[id]' class='start-btn blue'><i class='fa fa-edit'></i>Edit</a>
      <a href='?do=delete_item&itemid=$Item[id]' class='start-btn orangered confirm delete'><i class='fa fa-close'></i>Delete</a></div>";
      if ($Item["activity"] == 0){echo "<div style='color:red'>Not Approved</div><br />";}
      }
      }else {
        echo "There In No Items";
      }
?>
  </div>
  <div class="lastcomments">
 <h2 class="page-title">Last Comments</h2>

    <?php

    /*--- Get Last Comments ---*/
    $lastcomments = sql("SELECT * FROM comments WHERE user_id = '$user_id' AND activity=1 ORDER BY id","fetchAll");
    if(!empty($lastcomments)){
    foreach ($lastcomments as $comment) {
    echo"<p>$comment[comment]</p>";
    echo"<p>$comment[comment_date]</p>";
    echo"<td><a href='?do=edit_comment&comid=$comment[id]' class='start-btn blue'><i class='fa fa-edit'></i>Edit</a>
    <a href='?do=delete_comment&comid=$comment[id]' class='start-btn orangered confirm'><i class='fa fa-close'></i>Delete</a>";
    }
    }else{
    echo "There Is No Comments";
    }
    ?>

  </div>
<?php

}elseif( $do == 'edit_profile'){

        $Msg ="<div class='alert alert-danger'>Wrong Request</div>";
        $userid = isset($_GET['user_id']) && is_numeric($_GET['user_id'])?intval($_GET['user_id']) : redirect($Msg,'back',3);
      //Select Item Data From database
      $profile = sql("SELECT * FROM users WHERE id ='$userid' ","fetch");

        ?>
        <div class="container">
          <div class="page-style-one edit-profile">
          <h2 class="page-title">Edit Profile</h2>

        <form class="form" action="?do=update_profile" method="post" enctype="multipart/form-data">
          <input type="hidden" name="user_id" value="<?php echo $userid ?>">
                <!----------------Start Password -------------->
          <label  class="col-sm-2 control-label">Password</label>
          <input type="password" class="form-control" name="password" value="<?php echo $profile['password']; ?>" >
        <!----------------Start Price -------------->
          <label>Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo $profile['email']; ?>">
        <!----------------Start Image -------------->
          <label  class="col-sm-2 control-label">Image</label>
            <input type="hidden"  class="form-control" name="oldfile" value="<?php echo $profile['image'] ?>">
            <input type="file" class="form-control" name="file" placeholder="Image" >
          <!----------------Start Sent -------------->
            <button type="Add Item" class="start-btn blue"><?php echo lang("UPDATEBTN") ?></button>
      </form>
      </table>
      </div>
      <?php
    }elseif($do == 'update_profile'){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Get User Data From Form
        $id        =$_POST['user_id'];
        $pass      =$_POST['password'];
        $hashpass  =sha1($_POST['password']);
        $email     =$_POST['email'];
        $oldfile   =$_POST['oldfile'];
        //Update In Database
              upload("file",$oldfile,"data/uploads/");
              $update_items = sql("UPDATE users SET password = '$hashpass',email = '$email',
                              image = '$insert_src' WHERE id = '$id'","");
?>
<div class="container">
  <div class="page-style-one edit-profile">
<?php
        $Msg = "<div class='alert alert-success'>Updated Successfully</div>";
        redirect($Msg,'back',3);
      }else{
        $Msg = 'no allow';
        redirect($Msg,'back',3);
      }
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }elseif($do == 'edit_item'){
      $Msg ="<div class='alert alert-danger'>Wrong Request</div>";
      $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']) : redirect($Msg,'back',3);
    //Select Item Data From database
    $item = sql("SELECT * FROM items WHERE id ='$itemid'","fetch");
      ?>
      <div class="container">
          <div class="page-style-one edit-profile">
      <h2 class="page-title">Edit Item</h2>
      <form class="form" action="?do=update_item" method="post" enctype="multipart/form-data">
        <input type="hidden" name="itemid" value="<?php echo $itemid ?>">
      <!----------------Start Name -------------->
      <div class="form-group">
        <label  class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
          <input
          type="text"
          class="form-control"
          name="name"
          placeholder="name"
          value="<?php echo $item['name']; ?>">
        </div>
      </div>
      <!----------------Start Description -------------->
      <div class="form-group">
        <label  class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
          <input
          type="text"
          class="form-control"
          name="description"
          placeholder="Description"
          value="<?php echo $item['description']; ?>">
        </div>
      </div>
      <!----------------Start Price -------------->
      <div class="form-group">
        <label  class="col-sm-2 control-label">Price</label>
        <div class="col-sm-10">
          <input
          type="text"
          class="form-control"
          name="price"
          placeholder="Price"
          value="<?php echo $item['price']; ?>">
        </div>
      </div>
      <!----------------Start Categories -------------->
      <div class="form-group">
        <label  class="col-sm-2 control-label">Categories</label>
        <div class="col-sm-10">
        <select name="category" class="form-control">
          <?php
          //Select Categories Data From database
          $cats = sql("SELECT * FROM Categories WHERE activity = 1 ORDER BY id","fetchAll");
          foreach ($cats as $cat) {
          echo "<option value='$cat[id]'";  if ($item['id'] == $cat['id']) {echo 'selected';} echo "> $cat[name]</option>";
        }
          ?>

        </select>
        </div>
      </div>
      <!----------------Start Image -------------->
      <div class="form-group">
        <label  class="col-sm-2 control-label">Image</label>
        <div class="col-sm-10">
          <input type="hidden"  class="form-control" name="oldfile" value="<?php echo $item['image'] ?>">
          <input type="file" class="form-control" name="file" placeholder="Image" >
        </div>
      </div>
        <!----------------Start Sent -------------->
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="start-btn blue"><?php echo lang("UPDATEBTN") ?></button>
        </div>
      </div>
    </form>
      </div>
      </div>
    <?php
    // }else{
    //   $Msg='<div class="alert alert-danger">Wrong Request</div>';
    //   redirect($Msg,'back');
    // }
  }elseif($do == 'update_item'){
?>
<div class="container">
  <div class="page-style-one edit-profile">
<?php
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

      //Get Item Data From Form

      $id        =$_POST['itemid'];
      $name      =$_POST['name'];
      $desc      =$_POST['description'];
      $price     =$_POST['price'];
      $category  =$_POST['category'];
      $oldfile   =$_POST['oldfile'];

      //Update In Database
      upload("file",$oldfile,"data/uploads/");
      $update_items = sql("UPDATE items SET name = '$name', description = '$desc',price = '$price',
      cat_id = '$category',image='$insert_src' WHERE id = '$id'","");
      $Msg = "<div class='alert alert-success'>Updated Successfully</div>";
      redirect($Msg,'back',3);

    }else{
      $Msg = 'no allow';
      redirect($Msg,'back',3);
    }
    echo "</div>";
    echo "</div>";
    echo "</div>";
    }
    elseif($do == 'delete_item'){
      //Delete Item Page
      echo"<h1>Delete Item</h1>
      <div class='container'>";
      $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid'])?intval($_GET['itemid']) : 0;
    //Chick If Item Exist In Database
      $check = checkItems("id","items",$itemid);
    //Select Item Data From database
    if ($check == 1){
           sql("DELETE FROM items WHERE id = '$itemid'","");

      $Msg = "<div class='alert alert-success'>Deleted Successfully</div>";
        redirect($Msg,'back');
    }else{
      $Msg ="This Id Is Not Exist";
      redirect($Msg,'back');
    }
    echo"</div>";


  }elseif($do == 'edit_comment'){
      $Msg ="<div class='alert alert-danger'>Wrong Request</div>";
      $comid = isset($_GET['comid']) && is_numeric($_GET['comid'])?intval($_GET['comid']) : redirect($Msg,'back',3);
    //Select Comments Data From database
        $comments = sql("SELECT * FROM comments WHERE id='$comid'","fetch");

    if ($count == 1){
      ?>
      <div class="container">
      <div class="page-style-one edit-comment">
      <h2 class="page-title">Edit Comment</h2>
      <form class="form" action="?do=update_comment" method="post">
        <input type="hidden" name="comid" value="<?php echo $comid ?>">
      <!----------------Start comment -------------->
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Comment</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="comment"  required="required"><?php echo $comments['comment'] ?></textarea>
        </div>
      </div>
      <!----------------Start Sent -------------->
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="start-btn blue">Save</button>
        </div>
      </div>
    </form>
    <div class="col-md-8">
    <?php
    }else{
      $Msg='<div class="alert alert-danger">Wrong Request</div>';
      redirect($Msg,'back');
    }
  }elseif($do == 'update_comment'){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Get Comment Data From Form

        $comid       =$_POST['comid'];
        $comment     =$_POST['comment'];

        //Update In Database
        $update_comment = sql("UPDATE comments SET comment = '$comment' WHERE id = '$comid'","");
?>
<div class="container">
<div class="page-style-one edit-comment">
<?php
        $Msg = "<div class='alert alert-success'>Updated Successfully</div>";
        redirect($Msg,'back',3);


    }else{
        $Msg = 'no allow';
        redirect($Msg,'back',3);
    }
    echo "</div></div></div>";
    }
    elseif($do == 'delete_comment'){
      //Delete Comments Page
      echo"<h1>Delete User</h1>
      <div class='container'>";
      $comid = isset($_GET['comid']) && is_numeric($_GET['comid'])?intval($_GET['comid']) : 0;
    //Chick If Item Exist In Database
      $check = checkItems("id","comments",$comid);
    //Select User Data From database
    if ($check == 1){
      $delete_comment = sql("DELETE FROM comments WHERE id = '$comid'","");
      $Msg = "<div class='alert alert-success'>Deleted Successfully</div>";
      redirect($Msg,"back");
    }else{
      $Msg ="This Id Is Not Exist";
      redirect($Msg,'back');
    }
    echo"</div>";
    }
      ?>
    </div>
    </div>
    </div>
    </div>
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
