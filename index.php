<?php
$pageTitle ="Home";
include "init.php";
?>
        <div class="main-content">
          <div id="section1">
            <div class="slide-show-container">
              <ul class="circles">
                <?php
                //Get Category Items
                $select=sql("SELECT * FROM slideshow WHERE activity = 1 ORDER BY id LIMIT 5","fetchAll");
                $num = 1;
                foreach($select As $selectview){
                  ?>
                <li class="circle" data-show="#<?php echo $num ?>">
                </li>
                <?php
                $num ++;
              }
              ?>
              </ul>
              <div class="slide-show">
                <?php
                //Get Category Items
                $select=sql("SELECT * FROM slideshow ORDER BY id LIMIT 5","fetchAll");
                $num = 1;
                foreach($select As $selectview){
                  ?>
                <div class="slider" id="<?php echo $num ?>">
                <div class="details">
                <?php echo "<h3>$selectview[title]</h3>"; ?>
                <?php echo "<p>$selectview[description]</p>"; ?>
                <?php echo "<a class='start-btn orangered' href='slideshow.php?id=$selectview[id]&name=$selectview[title]'>";?><?php echo lang('READMORE') ?><?php echo "</a>"; ?>
                <?php echo "</div>"; ?>
                <?php $img = $selectview['image'];
                 $src=str_replace("../","",$img);
                 echo "<img src='$src' />";
                  ?>
                </div>
                  <?php
                  $num ++;
                }
                ?>
                </div>
              <div class="links">
                <a class="arrow next" id="next">
                  <i class="fa fa-chevron-circle-right">
                  </i>
                </a>
                <a class="arrow prev" id="prev">
                  <i class="fa fa-chevron-circle-left">
                  </i>
                </a>
              </div>
              
              <div id="stop">
                <button id="run">
                </button>
              </div>
            </div>
              </div>
            <div class="welcome padding-vertical" id="section2">
              <div class="container">
                      <?php
                        $about_page = sql("SELECT * FROM about","fetch");
                          $aboutname=str_replace("-","%20",$about_page["title"]);
                          echo "<a href='about.php?id=$about_page[id]&name=$aboutname'>";
                          echo "<h3 class='section-title'>$about_page[title]</h3>";
                          echo "<span class='separate'>
                               <span class='line'></span>
                               <span class='separate-circle'></span>
                               <span class='line'></span>
                               </span>";
                          echo "</a>";
                          ?>
                          <div class="row row-medium padding-vertical">
                            <div class="box box-1 about  wow fadeInLeft">
                              <div>
                          <?php
                          function custom_echo($x, $length)
                            {
                            if(strlen($x)<=$length)
                            {
                              echo $x;
                            }
                            else
                            {
                              $y=substr($x,0,$length) . '...';
                              echo $y;
                            }
                          }
                          custom_echo("<p>$about_page[description]</p>",600);

                          echo "<br /><a style='display:inline-block;' class='start-btn blue' href='about.php?id=$about_page[id]&name=$aboutname'>";?><?php echo lang('READMORE') ?><?php echo "</a>";
                        ?>

                    </div>
                    </div>
                    <div class="box box-1">
                    <img class="intro-img wow fadeInRight" src="layout/img/about.png" />
                  </div>
                  </div>



                </div>
              </div>
            <div class="items-slider padding-vertical" id="section5">
              <div class="container">
                <h3 class="section-title">Recently added
                </h3>
                <span class="separate">
                               <span class="line"></span>
                               <span class="separate-circle"></span>
                               <span class="line"></span>
                               </span>
                <div class="items-slider-container">
                  <div class="items-slider-horizontal wow fadeInLeft">
                    <div id="prev">
                      
                    </div>
                    <div id="slide-image">
                      <ul>
                        <?php
                          $last_items = sql("SELECT * FROM items WHERE activity = 1 ORDER BY id","fetchAll");
                          foreach ($last_items as $last) {
                            echo "<li><div>";
                            echo "<img src='$last[image]' />";
                            echo "<p><a style='color:#fff;' href='items.php?itemid=$last[id]'>$last[name]</a></p>";
                            echo "</div></li>";
                          }
                          ?>
                      </ul>
                    </div>
                    <div id="next">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>

           <div class="accordion-container">
           <div class="container">
            <div class="row row-medium">
              <div class="box box-1">
                <h3>Our Services
                </h3>
                <div class="accordion">
                  <?php
               $select = sql("SELECT * FROM accordion WHERE activity = 1 ORDER BY id","fetchAll");
             foreach ($select as $select_view) {
               ?>
               <div class="item">
                 <div class="title">
                   <i class="fa">
                   </i>
                     <?php echo $select_view['title'];?>
                 </div>
                 <div class="content">
                   <ul>
                     <li class="start-media-object">
                     <div class="media-object-section">
                     <div class="thumbnail">
                       <?php
                       $img = $select_view['image'];
                      $src=str_replace("../","",$img);
                       echo "<img src='$src' />";
                       ?>
                     </div>
                     </div>
                     <div class="media-object-section">
                     <p><?php echo $select_view['description'];?></p>
                     <a href="slideshow.php?id=<?php echo $select_view['id'];?>&name=<?php echo $select_view['title'];?>" class="about-btn"><?php echo lang('READMORE') ?></a>
                     </div>
                     </li>
                   </ul>
                 </div>
      </div>
            <?php
            }
            ?>
                </div>
              </div>
              <div class="box box-1">
                <img class="responsive-img" src="layout/img/services.png" />
              </div>
              </div>
              </div>
              </div>

              <div class="counter-outer">
                  <div class="container">
                <!-- <h3 class="section-title">Counter
                </h3> -->
                <ul class="counter row row-medium">
                  <?php
               $select = sql("SELECT * FROM counter WHERE activity = 1 ORDER BY id","fetchAll");
             foreach ($select as $select_view) {
               ?>
               <li class="box box-1">
                 <div>
                 <img src="<?php echo $select_view['image'];?>" />
                 <p><?php echo $select_view['title'];?></p>
                  <span class="number"><?php echo $select_view['count'];?></span>
                </div>
                </li>
                  <?php
        }
               ?>
             </ul>
              </div>
              </div>

              <div class="filter">
              <div class="row row-medium">
                <div class="box box-1">
              <ul class="items-filter">
                <li class="all"><a class='all'>all</a></li>
              <?php
              $select = sql("SELECT * FROM tabs WHERE activity = 1 ORDER BY id","fetchAll");
            foreach ($select as $select_view) {
?>
<li>
<a data-filter="<?php echo $select_view['id'] ?>"><?php echo $select_view['title'] ?></a>
</li>
          <?php
          }
          echo "</ul><div class='container'><ul class='row'>";
          $select = sql("SELECT * FROM tabsitems WHERE activity = 1 ORDER BY id","fetchAll");
          foreach ($select as $select_view) {
          ?>
          <li class="box box-1 item-filter-show" data-filter-item="<?php echo $select_view['tab_id'] ?>">
          <img class="responsive-img" src="<?php echo $select_view['image'] ?>" />
          <h3><?php echo $select_view['title'] ?></h3>
          <p><?php echo $select_view['description'] ?></p>
          </li>
          <?php
          }
          ?>
        </ul>
        </div>
        </ul>
        </div> <!-- Container Full End -->
      </div>
      </div>
      </div>
      <div class="clients padding-vertical">
          <div class="container">
        <h3 class="section-title">Clients
        </h3>
        <span class="separate">
                       <span class="line"></span>
                       <span class="separate-circle"></span>
                       <span class="line"></span>
                       </span>
        <div>
          <ul class="row row-medium">
            <?php
            $clients = sql("SELECT * FROM clients WHERE activity = 1 ORDER By id DESC LIMIT 6","fetchAll");
            foreach ($clients as $client) {
              echo "<li class='box box-1'>";
              echo "<img src='$client[image]' />";
              echo "</li>";
             }
            ?>
            <li class="start-media-object">

            </li>
          </ul>
        </div>
      </div>
      </div>
      <div class="progress-container">
        <div class="row row-medium">

          <div class="box box-1">
            <div class="container">
              <h3 class="section-title">
                Skills
              </h3>
            <div class="Progress">
              <?php
           $select = sql("SELECT * FROM prograss WHERE activity = 1 ORDER BY id","fetchAll");
         foreach ($select as $select_view) {
           ?>
           <div class="myProgress">
             <div class="mybar">
               <p><?php echo $select_view['name'];?></p>
               <div data-width="<?php echo $select_view['count'];?>" class="label">

            </div>
              </div>
              </div>
              <?php
    }
           ?>
            </div>
          </div>
        </div>
        <div class="box box-1">
          <img class="responsive-img" src="layout/img/skills.gif" />
      </div>
      </div>
      </div>

              <div class="contact padding-vertical">
                  <div class="container">
                <h3 class="section-title">
                  Contact Us
                </h3>
                <span class="separate">
                 <span class="line"></span>
                 <span class="separate-circle"></span>
                 <span class="line"></span>
                 </span>
                <div>
                  <div class="contact">
                  <div class="row row-medium">
                    <!-- <div class="box box-1">
                      <img class="responsive-img" src="layout/img/contact.png" />
                  </div> -->
                    <div class="box box-1">

                    <?php
                    if (!isset ($_POST['action']))
                    {
                    ?>
                        <form action="" class="form" method="post" >
                        <input type="hidden" name="action" value="submit">
                        <label for="fname">Name :
                        </label>
                        <input type="text" id="name" name="name">
                        <label for="country">Email :
                        </label>
                        <input type="text" id="email" name="email">
                        <label for="country">Message :
                        </label>
                        <textarea name="message">
                        </textarea>
                        <input type="submit" class="start-btn orangered" name="send" value="<?php echo lang('INSERT') ?>" />
                        </form>
          </div>

        </div>
                    <?php
                    }
                    else
                    {

                    function myEmail(){
                    $contact = sql("SELECT * FROM contact","fetch");

                    $to =$contact['email'];
                    return $to;

                    }
                    $name=$_POST['name'];
                    $email=$_POST['email'];
                    $message=$_POST['message'];

                    if (($name=="")||($email=="")||($message==""))
                    {
                    echo "All fields are required, please fill <a href=\"\">the form</a> again.";
                    }
                    else{
                    $from="From: $name<$email<\r\nReturn-path: $email";
                    mail(myEmail(), $name,$message, $from);
                    echo "Email sent!";
                    }
                    }
                    ?>
                  </div>
                  </div>
                </div>
              </div>




              </div>
<?php
include "$str/footer.php";
?>
