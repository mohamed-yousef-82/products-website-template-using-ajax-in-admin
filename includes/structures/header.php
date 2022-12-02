<?php
ob_start();
session_start();
$siteuser = "";
  if(isset($_SESSION['user'])){
    $siteuser = $_SESSION['user'];
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php getTitle() ?></title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo"$css" ?>/start.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/style.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/responsive.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/font-awesome.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/animate.css" />
  <link rel="stylesheet" href="<?php echo"$css" ?>/rtl.css" />
</head>
<body>
    <div class="start">
    <main>
      <div class="header-top-container">
      <div class="header-top">
      <div class="container">
          <div class="top-contact">
            <?php
            $contact = sql("SELECT * FROM contact","fetch");
            ?>
            <div class="contact-data"><i class="fa fa-phone"></i><span><?php echo $contact["phone"] ?></span></div>
            <div class="contact-data"><i class="fa fa-envelope"></i><span><?php echo $contact["email"] ?></span></div>
          </div>
        <div class="social-icons">
          <?php
                          $socialmedia = sql("SELECT * FROM socialmedia WHERE activity = 1 ORDER By id DESC ","fetchAll");
                          foreach ($socialmedia as $social) {
                            echo "<a href='$social[link]' class='social'><i class='$social[icon]' aria-hidden='true'></i></a>";
                          }
           ?>
          <div style="clear:both;">
          </div>
        </div>
      </div>
      </div>
      <div class="container">
        <div class="header-middle row row-medium">
        <img class="header-left-shadow" src="layout/img/header-left-shadow.png" />
        <img class="header-right-shadow" src="layout/img/header-right-shadow.png" />
        <div class="box box-1">
      <a class="logo" href="index.php">
        <!-- <img src="layout/img/logo.png" /> -->
        <?php
          $logo = sql("SELECT * FROM logo","fetch");
          echo "<img src='$logo[image]' />";
          ?>
      </a>
        </div>
        <div class="box box-1">
      <form class="search-form" action="search.php">
                        <i class="fa fa-search">
                        </i>
                        <input type="text" name="search" placeholder="<?php echo lang('SEARCHTEXT') ?>">
                        <input type="submit" name="submit" value="<?php echo lang('SEARCH') ?>" class="start-btn blue">

                    </form>
      </div>
      </div>
      </div>
      </div>
      <div class="fa fa-align-justify" id="menu-icon">
      </div>
      <div class="nav-container">
        <ul class="nav" id="nav">
         <div class="container">
        <ul class="nav-left">
          <li>
            <a class="home" href="index.php">
              <i class="fa fa-home">
              </i>
            </a>
          </li>
          <?php
            $categories = sql("SELECT * FROM categories WHERE parent = 0 AND activity = 1 ORDER BY id","fetchAll");
            foreach ($categories as $cat) {
              $catname=str_replace("-","%20",$cat["name"]);
              echo "<li><a href='categories.php?id=$cat[id]&name=$catname'>";
              echo $cat['name'];
              echo "</a>";
              echo "<ul class='dropdown'>";
              $select = sql("SELECT * FROM categories WHERE parent = $cat[id] AND activity = 1 ORDER BY id","fetchAll");
              foreach ($select as $sub_cat) {
              $catname=str_replace("-","%20",$sub_cat["name"]);
              echo "<li><a href='categories.php?id=$sub_cat[id]&name=$catname'>";
              echo $sub_cat['name'];
              echo "</a></li>";
              }
              echo "</ul>";
              echo "</li>";
            }
            ?>
            <?php
              $about_page = sql("SELECT * FROM about","fetch");
                $aboutname=str_replace("-","%20",$about_page["title"]);
                echo "<li><a href='about.php?id=$about_page[id]&name=$aboutname'>";
                echo $about_page['title'];
                echo "</a></li>";
              ?>
              <li>
                <a href="request.php">
                  Price Request
                </a>
              </li>
          </ul>
          <ul class="nav-right">
          <?php
          if(isset($_SESSION['user'])){
            echo "<li class='user-box'><a>welcome ".$siteuser."</a>
                  <ul class='dropdown'>
                  <li><a href='profile.php'>Profile</a></li>
                  <li><a href='new.php'>Create New Ad</a></li>
                  <li><a href='logout.php'>Logout</a></li>
                  </ul>
            </li>";
            $usersratus = Check_User_Status($siteuser);
            if($usersratus == 1){
      echo "Your Account Need To Upgrade";
            }
          }else{
      ?>
          <li class="login-link"><a href="login.php">Login</a></li>
          <li><a href="registration.php">Registration</a></li>
          <?php
          }
              ?>
</ul>

          </div>
        </ul>
      </div>
