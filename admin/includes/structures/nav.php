<aside class="box box-1">
<nav>
      <a class="admin-logo" href="dashboard.php"><img src="<?php echo"$img/logo.png" ?>" /></a>
        <?php
        if(isset($_SESSION['username'])){
        echo "<p class='welcome'>welcome $_SESSION[username]<p/>";
        }else{
          header('Location:index.php');
          exit();
        }
        ?>
        <ul class="admin-nav">
        <li class="nav-active"><a href="dashboard.php" class="homepage"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('INDEX') ?></a></li>
        <li>
        <a role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-text" aria-hidden="true"></i>More Links<span class="caret"></span></a>
            <ul>
            <li><a href="../index.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('VISIT_SHOP') ?></a></li>
            <li><a href="users.php?do=edit&user_id=<?php echo $_SESSION['id']?>"><i class="fa fa-file-text" aria-hidden="true"></i>Edit</a></li>
            <li><a href="../logout.php"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('LOGOUT') ?></a></li>
            </ul>
        </li>
        <li>
        <a><i class="fa fa-file-text" aria-hidden="true"></i>Website Info<span class="caret"></span></a>
        <ul>
          <li><a data-table="about" data-folder="about" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('ABOUT') ?></a></li>
          <li><a data-table="logo" data-folder="logo" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('LOGO') ?></a></li>
          <li><a data-table="contact" data-folder="contact" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('CONTACT') ?></a></li>
        </ul>
        </li>
        <li><a data-table="users" data-folder="cp-users" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('CONTROLPANELUSERS') ?></a></li>
        <li><a data-table="users" data-folder="ws-users" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('WEBSITEUSERS') ?></a></li>
        <li><a data-table="categories" data-folder="categories" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('CATEGORIES') ?></a></li>
        <li><a data-table="items" data-folder="cp-items" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('CONTROLPANELITEMS') ?></a></li>
        <li><a data-table="items" data-folder="ws-items" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('WEBSITEITEMS') ?></a></li>
        <li><a data-table="comments" data-folder="comments" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('COMMENTS') ?></a></li>
        <li><a data-table="clients" data-folder="clients" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('CLIENTS') ?></a></li>
        <li><a data-table="slideshow" data-folder="slideshow" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('SLIDESHOW') ?></a></li>
        <li><a data-table="socialmedia" data-folder="socialmedia" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('SOCIALMEDIA') ?></a></li>
        <li><a data-table="accordion" data-folder="accordion" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('ACCORDION') ?></a></li>
        <li><a data-table="tabs" data-folder="tabs" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('TABS') ?></a></li>
        <li><a data-table="tabsitems" data-folder="tabs-items" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('TABSITEMS') ?></a></li>
        <li><a data-table="counter" data-folder="counter" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('COUNTER') ?></a></li>
        <li><a data-table="prograss" data-folder="prograss" class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('PROGRASS') ?></a></li>
        <li><a data-table="message" data-folder="message"  class="link"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo lang('MESSAGE') ?></a></li>
        </ul>
</nav>
</aside>
