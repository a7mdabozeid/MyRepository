<?php require(realpath(__DIR__ .'/header.php')); ?>

<?php if(isset($_SESSION['first_name'])){ ?>
<script>
    $(document).ready(function() { // start jquery code
      $(".rate_content").click(function() {
        var id_content = $(this).attr("id_content");
        var module     = $(this).attr("module");
        var ip_adress  = $(this).attr("ip_adress");
        var rate_value = $(this).attr("rate_value");
        var user_id    = $(this).attr("user_id");
        var up         = $(this).attr("up");
      if(up ==1){ var masg = ".rate_masg1"; }else { var masg = ".rate_masg";}

       var data = {"rate_value":rate_value,"id_content":id_content,"module":module,"ip_adress":ip_adress,"user_id":user_id};
      $.ajax({
      type:"post",
      url:"ajax_progress.php?action=update_rate",
      data:data,
      success: function(msg) {
      //  $(masg).html(msg).delay(4000).fadeOut();
        $(masg).fadeOut();
        $(masg).html(msg).fadeIn("slow");
      	$(masg).fadeIn().delay(2000).fadeOut();
        }
        });
      });
    });// end all jquery code
 </script>

 <?php } ?>
<div class="banner-intro-bx container">
<article>
<h1 class="animated fadeInUp">Are you a yoga teacher with  passion for travel?</h1>
<p class="animated fadeInDown">
Do you dream about giving classes and performing Surya Namaskar to a sunrise in Bali, a sunset in
Costa Rica ?
</p>
</article>

<div class="row">
<div class="col-md-12 relative">
  <div class="icons-arrows">
    <span class="g-arrow left-arrow red-color icons-back"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
    <span class="g-arrow right-arrow red-color icons-next"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
  </div>
<div class="intro-icons-cont non-dotts relative">
  <div class="item">
    <figure class="animated fadeInLeft">
      <img src="<?=$temp_front;?>images/yogi_icon_1.png" alt="Create Your Profile">
      <figcaption>
        Create: Sign up &amp; create your yoga profile to join the community
      </figcaption>
    </figure>
  </div><!-- End item-->
  <div class="item">
    <figure class="animated fadeInUp">
    <img src="<?=$temp_front;?>images/yogi_icon_2.png" alt="Choose your dream destination">
      <figcaption>
        Search: Choose your dream destination &amp; go through your filtered results
      </figcaption>
    </figure>
  </div><!-- End item-->
  <div class="item">
    <figure class="animated fadeInRight">
    <img src="<?=$temp_front;?>images/yogi_icon_3.png" alt="Message Your YogiSwap-mate">
      <figcaption>
        Swap: Message your desired yoga teacher &amp; start your journey
      </figcaption>
    </figure>
  </div><!-- End item-->
</div>
</div>
</div>
<?php if(!isset($_SESSION['first_name'])){?>
<div class="row">
<div class="col-md-2 col-sm-6 col-xs-8 col-md-offset-5 col-sm-offset-3 col-xs-offset-2">
<a href="membership_plans.php" class="custom-btn btn-box red-hover red-bg animated bounceInDown">Join Us Now</a>
</div>
</div>
<?php } ?>
</div>
</section><!-- End header_section-->

<section class="welcome-section r-cover">
<div class="container">
<div class="row">
  <div class="col-sm-12">
    <article class="text_article txt_center">
      <small class="blue-color wow fadeInUp" data-wow-delay="0.5s">
      YogiSwap is a unique platform that gives you the chance to travel the world while teaching yoga.</small>
      <p class="gray-color wow fadeIn" data-wow-delay="0.7s">
      With us, you can temporarily swap classes and living arrangements with other yoga teachers from all over the world<span class="br-hide"><br></span>
      as well as connecting to other yoga communities.<span class="br-hide"><br></span>
      While you’re gone, you can rest assured that your clients back home are well taken care of, by a qualified YogiSwap-mate<span class="br-hide"><br></span>
      </p>
    </article>

    <?php if(!isset($_SESSION['first_name'])){ ?>
    <div class="col-md-2 col-sm-6 col-xs-8 col-md-offset-5 col-sm-offset-3 col-xs-offset-2">
       <a href="membership_plans.php" class="custom-btn btn-box red-hover red-bg wow fadeInUp" data-wow-delay="0.5s" >Sign Up</a>
    </div>
    <?php } ?>

 </div>
</div>
</div>
</section><!-- End welcome-section-->





<section class="search-section">
<div class="container">
<div class="row search-bx">

  <script>
      $(function() {
      $("#clickcountry").click(function() {
      $("#swap_board").submit();
      });
      });

      $(document).ready(function (){
      $('select#countries').on('change',function(){
        var countries = $('select[name=countries]').val();
      //  alert(countries);
      $("#contry_id").attr("value", countries );

      });
      });
  </script>
<form action="swap_board.php" method="get" id="swap_board">

<div class="col-md-4">
<label class="animated wow fadeInLeft" data-wow-delay="0.2s">Where Do You Want To Swap ?</label>
</div>


<div class="col-md-5">

  <select <?php if(!isset($_SESSION['first_name'])){echo 'disabled="true"'; }?> id="countries" name="countries"  class="custom-select select-h-50 wow fadeInUp" data-wow-delay="0.4s">
    <option disabled="" selected="" value="0">anywhere in the world...</option>
    <?php $countries = mysqli_query($holol, "SELECT * FROM `eara` where `countries`=0 ORDER BY `name` ASC");
    while ($row = mysqli_fetch_assoc($countries)){ ?>
    <option  value="<?=$row['id'];?>" ><?php echo $row['name'];?> </option>
    <?php } ?>
  </select>

</div>
<input type="hidden" name="swap_country" id="contry_id" value="" >

  <div class="col-md-2">
    <a href="javascript:void(0)" id="clickcountry">
      <input type="button" value="Find Swap" class="custom-btn btn-box blue-bg white-hover wow bounceInRight" data-wow-delay="0.5s" >
    </a>
  </div>

</form>

</div>
</div>
</section><!-- End search-section-->



<section class="trip-section r-cover h-auto section-block">
    <div class="container">
    <div class="row">
    <div class="col-md-12">
       <article class="text_article">
           <h2 class="blue-color wow fadeIn" data-wow-delay="0.5s"><b>YogiSwap</b> Tribe</h2>
           <span class="custom-space-small"></span>
             <dl class="text-list gray-color wow fadeIn" data-wow-delay="0.6s">
                 <dt>Would you like to connect with other yoga teachers nearby?</dt>
                 <dt>Learn about their favorite restaurants, things to do or favorite locations to practice yoga? </dt>
                 <dt>Are you willing to help travelling yogis make the most out of your city or simply <span class="br-hide"><br></span>connect with your yogi community?</dt>
                 <dt>Like-minded people offer the best tips and become great friends!</dt>
                 <dt>Visit the <a href="#" class="gray-color blue-hover"><b>YogiSwap</b></a> tribe to connect with yoga teachers nearby.</dt>
             </dl>
           <span class="custom-space-small"></span>
      </article>
    </div>

    <div class="col-md-2 col-sm-6 col-xs-8 col-md-offset-0 col-sm-offset-3 col-xs-offset-2">
    <a class="custom-btn btn-box red-bg red-hover wow bounceInLeft" data-wow-delay="0.7s" href="<?php if(isset($_SESSION['first_name'])):echo 'yogitrib.php'; else: echo 'yogitrib_notsigned.php'  ; endif;?> ">Read more</a>
    </div>

    <?php if(!isset($_SESSION['first_name'])){ ?>
      <div class="col-md-2 col-sm-6 col-xs-8 col-md-offset-0 col-sm-offset-3 col-xs-offset-2">
         <a href="membership_plans.php" class="custom-btn btn-box red-hover red-bg wow fadeInUp" data-wow-delay="0.5s" >Sign Up</a>
      </div>
    <?php } ?>
    </div>
    </div>
</section><!--End trip-section-->


<section class="gallery-section h-auto r-cover">
<div class="container non-padding">
  <article class="text_article text-center">
     <h2 class="white-color wow fadeIn" data-wow-delay="0.5s"><b style="font-size:1.3em;">Gallery</b> </h2>
     <span class="custom-space"></span>
        <p class="white-color">
          With so many yoga teachers performing amazing asanas in beautiful places all around the world,
          <span class="br-hide"><br></span> we’d
          love for you to share your experience with the rest of the YogiSwap community by uploading your
          pictures!<span class="br-hide"><br></span>

          Post your pictures and learn about our rewards!
        </p>
    </article>
    <span class="custom-space"></span>
    <div class="row">
    <div class="col-md-12 relative wow bounceInUp" data-wow-delay="0.4s">
      <div class="gallery-arrows">
        <span class="g-arrow left-arrow white-color swap-back"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
        <span class="g-arrow right-arrow white-color swap-next"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
      </div>
    <div class="swapping-gallery gallery-slider non-dotts">

<?php
      @$total = mysqli_num_rows(mysqli_query($holol,"SELECT * FROM `gallery` where `stiky`=1 AND `active` = 1 AND `lang`='$_SESSION[lang]'  ORDER BY `id` DESC "));

      if($total > 0){///check num
      @$select = mysqli_query($holol,"SELECT * FROM `gallery` WHERE `stiky`=1 AND `lang`='$_SESSION[lang]' AND  `active`= 1 ORDER BY `id` DESC LIMIT 20 ");//select topics
      while($row = mysqli_fetch_object($select)) {

      $image_id[]=$row->id;

      //:::::::::: rate
     $get_rat=mysqli_query($holol, "SELECT sum(rate) as `total` FROM `rate` WHERE  `id_content` = '$row->id' AND `module`='gallery'");
     while($get_rate=mysqli_fetch_assoc($get_rat)){
     $total_rate_content= $get_rate['total'];
     }
     $sql_content=mysqli_query($holol, "select `id` FROM `rate` WHERE  `id_content` = '$row->id' AND `module`='gallery'");
     $num_content=mysqli_num_rows($sql_content);
     $rate_content=round($total_rate_content/$num_content);

        if (!empty($row->upload)){
          $src="upload/content_thumbs/".$row->upload;
          $src2="upload/content/".$row->upload;

        }else if(!empty($row->url) ){
          $src=$row->url;
          $src2=$row->url;

        }else if(!empty($row->image)){
          $src="upload/content_thumbs/".$row->image;
          $src2="upload/content/".$row->image;
        }else{
          $src=$temp_front."images/g-photo.jpg";
          $src2=$temp_front."images/g-photo.jpg";
        }


      ?>

      <div class="item">
        <figure class="gallery-figure">
          <span class="fig-pic">
          <span class="photo-total-rating"><i class="glyphicon glyphicon-star"></i><big><?=$rate_content;?></big><small>/ 5 </small></span>
          <a data-toggle="modal" data-target="#<?=$row->id;?>"><span class="zoom-ico"></span></a>
          <img src="<?=$src;?>">
          </span>
        </figure>
      </div>
    <?php } } ?>


    </div>
    </div>
    </div>




    <!-- gallery photos PopUp ----------------------------------->



    <?php foreach ($image_id as $value) {

      @$select2 = mysqli_query($holol,"SELECT * FROM `gallery` WHERE  id='$value' AND `lang`='$_SESSION[lang]' AND `stiky`=1 AND `active`= 1 ORDER BY `id` DESC LIMIT 20 " );//select topics
      while($row2 = mysqli_fetch_object($select2)) {


          if (!empty($row2->upload)){
            $src="upload/content_thumbs/".$row2->upload;
            $src2="upload/content/".$row2->upload;

          }else if(!empty($row2->url) ){
            $src=$row2->url;
            $src2=$row2->url;

          }else if(!empty($row2->image)){
            $src="upload/content_thumbs/".$row2->image;
            $src2="upload/content/".$row2->image;
          }else{
            $src=$temp_front."images/g-photo.jpg";
            $src2=$temp_front."images/g-photo.jpg";
          }

          //::: rate
          $get_rat=mysqli_query($holol, "SELECT sum(rate) as `total` FROM `rate` WHERE  `id_content` = '$row2->id' AND `module`='gallery'");
          while($get_rate=mysqli_fetch_assoc($get_rat)){
          $total_rate_content= $get_rate['total'];
          }
          $sql_content=mysqli_query($holol, "select `id` FROM `rate` WHERE  `id_content` = '$row2->id' AND `module`='gallery'");
          $num_content=mysqli_num_rows($sql_content);
          $rate_content=round($total_rate_content/$num_content);
      ?>


    <div id="<?=$row2->id;?>" class="modal fade l-5m" role="dialog">

    <div class="modal-dialog modal-lg">
    <div class="modal-content gallery-modal">
    <button type="button" class="close top-right white-color" data-dismiss="modal">&times;</button>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 relative">
          <div class="gallery-popup-slider non-dotts">
            <div class="item">
              <img src="<?=$src2?>">
            </div>
          </div>
        </div>
      </div>


    <span class="custom-space"></span>


    <div class="row">
      <div class="col-sm-8">
        <article class="gallery-popup-article white-color">
<?php if(!empty($row2->user_name)): ?>
          <a href="user_profile.php?user_id=<?=$row2->user_id;?>" class="white-color">
            <h1><?=ucwords(strtolower($row2->user_name));?></h1>
          </a>
<?php else: echo '<h1 class="white-color">By admin</h1>'; endif; ?>

          <small>Posted on : <?=date('d / F /Y',$row2->pubtime);?></small>
        </article>
      </div>

      <div class="col-sm-4">
      <span class="g-total-rating"><span class="glyphicon glyphicon-star"></span>
      <big><?=$rate_content;?> </big><small>/ 5 </small>
      </span>


          <dl class="stars-example-fontawesome-o">
            <dt>
              <?php if(isset($_SESSION['first_name'])){?> <label for="rate"> Rate this : </label><?php } ?>
             <a href="javascript:void(0)" >
              <i class="fa fa-star <?php if($rate_content == 1 || $rate_content == 2 || $rate_content == 3 || $rate_content == 4 || $rate_content == 5):
                echo 'star-on';endif;?> rate_content" rate_value="1" module="gallery" id_content="<?=$row2->id?>"
                ip_adress="<?=$_SERVER['REMOTE_ADDR']?>" user_id="<?=$user_id_front;?>">
              </i>
            </a>

            <a href="javascript:void(0)" >
              <i  class="fa fa-star <?php if($rate_content == 2  || $rate_content == 3 || $rate_content == 4 || $rate_content == 5):
                echo 'star-on';endif;?> rate_content" rate_value="2" module="gallery" id_content="<?=$row2->id?>" ip_adress="<?=$_SERVER['REMOTE_ADDR']?>" user_id="<?=$user_id_front;?>">
              </i>
            </a>

            <a href="javascript:void(0)"  >
              <i  class="fa fa-star <?php if($rate_content == 3 || $rate_content == 4 || $rate_content == 5):
                echo 'star-on';endif;?> rate_content" rate_value="3" module="gallery" id_content="<?=$row2->id?>" ip_adress="<?=$_SERVER['REMOTE_ADDR']?>" user_id="<?=$user_id_front;?>">
              </i>
            </a>

            <a href="javascript:void(0)"   >
              <i  class="fa fa-star <?php if($rate_content == 4  || $rate_content == 5):
                echo 'star-on';endif;?> rate_content" rate_value="4" module="gallery" id_content="<?=$row2->id?>" ip_adress="<?=$_SERVER['REMOTE_ADDR']?>" user_id="<?=$user_id_front;?>">
              </i>
            </a>

            <a href="javascript:void(0)"   >
              <i  class="fa fa-star <?php if($rate_content == 5):
                echo 'star-on';endif;?> rate_content" rate_value="5" module="gallery" id_content="<?=$row2->id?>" ip_adress="<?=$_SERVER['REMOTE_ADDR']?>" user_id="<?=$user_id_front;?>">
              </i>
            </a>
            <span class="custom-space-small"></span>
             <div  class="rate_masg" style="display: inline;" ></div>

            </dt>
          </dl>
      </div>
    </div>
<!--
    <div class="row">
    <div class="col-md-12">
    <div class="users-comments-area">

    <figure class="comment-box-item">
    <dl>
    <dt><img src="images/g-photo.jpg" class="comment-user-photo"></dt>
    <dt>
    <figcaption>
    <b>John Doe said : <time>2 hrs ago</time></b>
    <small>I am a superhero, and I like this ! Nice work.</small>
    <button class="replay-comment-btn">Replay</button>
    </figcaption>
    </dt>
    </dl>
    </figure>

    <figure class="comment-box-item">
    <dl>
    <dt><img src="images/replay-arrow.png"></dt>
    <dt><img src="images/g-photo.jpg" class="comment-user-photo"></dt>
    <dt>
    <figcaption>
    <b>John Doe said : <time>2 hrs ago</time></b>
    <small>I am a superhero, and I like this ! Nice work.</small>
    <button class="replay-comment-btn">Replay</button>
    </figcaption>
    </dt>
    </dl>
    </figure>

    <figure class="comment-box-item sub-replay-comment">
    <dl>
    <dt><img src="images/replay-arrow.png"></dt>
    <dt><img src="images/g-photo.jpg" class="comment-user-photo"></dt>
    <dt>
    <figcaption>
    <b>John Doe said : <time>2 hrs ago</time></b>
    <small>I am a superhero, and I like this ! Nice work.</small>
    <button class="replay-comment-btn">Replay</button>
    </figcaption>
    </dt>
    </dl>
    </figure>




    <form class="gallary-comments-form">
    <ul>
    <li><textarea placeholder="Add a comment or a reply here ..."></textarea></li>
    <li><input type="button" value="Send" class="add-comment-btn"></li>
    </ul>
    </form>


    </div>



    </div>
    </div>

--->


    </div>
    </div>

    </div>

    </div><!--End gallery popup-->

<?php } } ?>

    <span class="custom-space"></span>
    <div class="row">
      <div class="col-md-2 col-sm-6 col-xs-8 col-md-offset-4 col-sm-offset-3 col-xs-offset-2">
        <a href="<?php if(isset($_SESSION['first_name'])):echo 'gallery.php'; else: echo 'gallery_notsigned.php'  ; endif;?>" class="custom-btn btn-box white-hover red-bg wow fadeIn" data-wow-delay="0.7s">Read more</a>
      </div>

      <?php if(!isset($_SESSION['first_name'])){ ?>
       <div class="col-md-2 col-sm-6 col-xs-8 col-md-offset-0 col-sm-offset-3 col-xs-offset-2">
         <a href="membership_plans.php" class="custom-btn btn-box red-hover red-bg wow fadeInUp" data-wow-delay="0.5s" >Sign Up</a>
       </div>
     <?php } ?>
    </div>

</div>
</section><!--End gallery-section-->




<section class="blog-section r-cover h-auto bg-hide">
<div class="container">
<div class="row">
<div class="col-md-7">

     <article class="text_article">
       <h2 class="blue-color wow fadeIn" data-wow-delay="0.5s"><b>Blog</b></h2>
       <span class="custom-space"></span>
         <dl class="text-list gray-color wow fadeIn" data-wow-delay="0.7s">
           <dt>YogiSwap is a community for yoga teachers passionate about yoga,<span class="br-hide"><br></span> travel and culture.</dt>
           <dt>Writing your own blog is a great way to share your knowledge and experience<span class="br-hide"><br></span> with fellow yoga instructors. </dt>
           <dt>It’s the ultimate platform for real, personal storytelling by yogis for yogis.</dt>
         </dl>
       <span class="custom-space"></span>
    </article>

  </div>
</div>
<?php //if(!isset($_SESSION['first_name'])){?>
  <div class="row">
  <div class="col-md-2 col-sm-6 col-xs-8 col-md-offset-0 col-sm-offset-3 col-xs-offset-2">
    <a href="blog.php" class="custom-btn btn-box red-bg red-hover wow bounceInLeft" data-wow-delay="0.4s">Visit Now</a>
  </div>
    <?php if(!isset($_SESSION['first_name'])){ ?>
      <div class="col-md-2 col-sm-6 col-xs-8 col-md-offset-0 col-sm-offset-3 col-xs-offset-2">
         <a href="membership_plans.php" class="custom-btn btn-box red-hover red-bg wow fadeInUp" data-wow-delay="0.5s" >Sign Up</a>
      </div>
   <?php }  ?>
  </div>
<?php // } ?>
</div>
</section><!--End blog-section-->


<section class="stories-section h-auto c-cover">
<div class="container non-padding">
  <article class="text_article text-center">
     <h2 class="blue-color wow bounceIn" data-wow-delay="0.5s"><b>Yogiswap</b> Stories</h2>
     <span class="custom-space"></span>
        <p class="gray-color wow fadeIn" data-wow-delay="0.7s">
          How was your YogiSwap adventure? Did you enjoy experiencing different cultures, teaching yoga and meeting yogis across the globe?
        <span class="br-hide"><br></span>
        We’d love to hear about it! Share your stories and check out what other members have to say about their YogiSwap experiences!
        </p>
    </article>
    <span class="custom-space"></span>

    <div class="row">
    <div class="col-md-12 relative wow bounceInDown" data-wow-delay="0.4s">

    <div class="gallery-arrows">
    <span class="g-arrow left-arrow red-color story-back"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
    <span class="g-arrow right-arrow red-color story-next"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
    </div>

  <div class="stories-gallery gallery-slider">

<?php  $x=0;
 foreach(getdata('stories','WHERE lang="'.$_SESSION['lang'].'" AND `active`=1 AND `pubtime` <='.time().'','ORDER BY `id` DESC',12) AS $row){
$stories[]=$row->id;

$res = mysqli_fetch_object(mysqli_query($holol,"SELECT * FROM `members` WHERE `id`='$row->user_id' AND `active`=1 "));
$get_country = mysqli_fetch_object(mysqli_query($holol,"SELECT * FROM `eara` WHERE `id`='$res->countries' AND `active`=1 "));

$a="Michaella Jones  - United States";
$b="Tracy Smith - India";
$c="Peter Coles  - Germany";

  if (empty($row->image)){
           $src=$temp_front."/images/inside-about-bg.jpg";
           }
   else if(file_exists("upload/content/".$row->image))
           {
           $src="upload/content/".$row->image;
           }
   else    {
           $src="upload/content_thumbs/".$row->image;
           }
  ?>
  <div class="item">
    <figure class="member-stories-box">
      <img src="<?=$src;?>">
      <figcaption>
        <big class="blue-color nowrap-text"><?=ucwords(strtolower($res->first_name)).' - '.ucwords(strtolower($get_country->name)); ?></big>
          <p class="gray-color">
            <?=news(strip_tags($row->desc),200);?>
          </p>
      </figcaption>
      <a data-toggle="modal" data-target="#<?=$row->id;?>"><span>Read more</span></a>
    </figure>
  </div>
<?php $x++; } ?>

  </div>
    </div>
</div>

<!-- story info PopUp ----------------------------------->

<?php foreach ($stories as  $value) {

  $get_stories= mysqli_query($holol,"select * from stories where `id`='$value' AND `lang` = '$_SESSION[lang]' AND `active`=1 order by `id` desc limit 12");
  while($row=mysqli_fetch_object($get_stories)){

$res = mysqli_fetch_object(mysqli_query($holol,"SELECT * FROM `members` WHERE `id`='$row->user_id' AND `active`=1 "));
$get_country = mysqli_fetch_object(mysqli_query($holol,"SELECT * FROM `eara` WHERE `id`='$res->countries' AND `active`=1 "));


  if (empty($row->image)){
           $src=$temp_front."/images/inside-about-bg.jpg";
           }
   else if(file_exists("upload/content/".$row->image))
           {
           $src="upload/content/".$row->image;
           }
   else    {
           $src="upload/content_thumbs/".$row->image;
           }
 ?>

  <div id="<?=$value;?>" class="modal fade l-5m" role="dialog" >
    <div class="modal-dialog story-info-modal responsev-900 ">
    <div class="modal-content">
    <button type="button" class="close top-right white-color" data-dismiss="modal">&times;</button>

    <div class="container-fluid">

      <div class="row">
        <div class="col-sm-12">
          <figure>
            <img src="<?=$src;?>">
            <figcaption>
              <big><?=ucwords(strtolower($res->first_name));?></big>
              <small><?=$get_country->name;?></small>
            </figcaption>
          </figure>
        </div>
      </div>

      <div class="row">
          <div class="col-sm-12">
            <article>
              <h3><?=$row->name;?></h3>
              <p><?=$row->desc;?></p>
            </article>
          </div>
        </div>
    </div>

    </div>
    </div>
  </div><!--End story info popup-->
<?php }  } ?>
<!--::::::::::::::::::::::::: End Stories :::::::::::::::::::::::::::::::::::-->
<!--::::::::::::::::::::::::: End Stories :::::::::::::::::::::::::::::::::::-->

<span class="custom-space"></span>
   <span class="custom-space"></span>

<div class="row">
    <div class="col-md-2 col-sm-6 col-xs-8 col-md-offset-4 col-sm-offset-3 col-xs-offset-2">
    <a href="#" data-toggle="modal" data-target="#share-story-popup-box" class="custom-btn btn-box red-hover red-bg wow bounceIn" data-wow-delay="0.4s">Share Your Story
     </a>
    </div>
      <?php if(!isset($_SESSION['first_name'])){ ?>
         <div class="col-md-2 col-sm-6 col-xs-8 col-md-offset-0 col-sm-offset-3 col-xs-offset-2">
           <a href="membership_plans.php" class="custom-btn btn-box red-hover red-bg wow fadeInUp" data-wow-delay="0.5s" >Sign Up</a>
         </div>
       <?php } ?>
  </div>

</div>
</section><!--End story-section-->






<script> /*
  $(document).ready(function(){
  // Show the Modal on load
  $("#myModal").modal("show");
  // Hide the Modal
  $("#myBtn").click(function(){
  $("#myModal").modal("hide");
  });
}); */
  </script>
<!--  <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-body" >
            <img src="<?=$temp_front?>images/yogiswap-logo.png" style="margin-left:30%">
          <p style="text-align:center; font-size:16px;">
        Welcome to   <strong><b>YogiSwap!</b></strong> Our official worldwide launch is coming very soon!<br>
        During the pre-launch you can register to join the community for <b>FREE!</b><br>
        you can explore the site and see how things will look once we are live.<br>
        <a href="membership_plans.php">  <b><u>Register now</u></b></a> and be part our yoga teacher travel revolution!<br>
      </p>
      </div>
      <br>
      <button type="button" class="custom-btn btn-box red-hover red-bg wow " data-dismiss="modal">Close</button>
        </div>
       </div>
    </div>---->
<?php require(realpath(__DIR__ .'/footer.php')); ?>
