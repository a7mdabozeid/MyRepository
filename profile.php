<?php  @session_start();
require(realpath(__DIR__ . '/header.php'));
if(!isset($_SESSION['name']) ){
   echo'<div class="message-page">
    <div class="col-sm-12">
       <div class="box">
         <div class="icon"><i class="fa fa-times-circle-o"></i></div><!-- End .icon -->
            <h1>'.get_lange('not_logged','backend=0').'</h1>
         </div><!-- End .box -->
      </div><!-- End .col-sm-12 -->
    </div><!-- End .message-page -->';
   echo '<meta http-equiv="refresh" CONTENT="3;URL=index.php">';

}else {
$res = mysqli_fetch_object(mysqli_query($db,"SELECT * FROM `members` WHERE `name`='$_SESSION[name]' AND `id`='$_SESSION[user_id_front]'"));
  if (empty($res->image)){
         $src=$temp_front."/images/user.png";
   } else if(file_exists("upload/content/".$res->image)){
         $src="upload/content/".$res->image;
   }else{
         $src="upload/content_thumbs/".$res->image;
   }
?>

<section class="short-image no-padding blog-short-title">
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-lg-12 short-image-title">
      <h5 class="subtitle-margin second-color"><?=get_lange('wel_come','backend=1')?>:</h5>
      <h1 class="second-color"><?=ucwords($res->name);?></h1>
      <div class="short-title-separator"></div>
    </div>
  </div>
</div>
</section>

<section class="section-light section-top-shadow">
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-9 col-md-push-3">
        <div class="row">

          <div class="col-xs-12 col-lg-7">
            <h1><?=get_lange("project_status","backend=0")?><span class="special-color">.</span></h1>
          </div>

          <div class="col-xs-12">
            <div class="title-separator-primary"></div>
          </div>

        </div>



        <div class="row list-offer-row">
          <div class="col-xs-12">




            <?php
            foreach(getdata('real_estate',"WHERE `id`='$res->id_real_estate' AND `active`=1",'ORDER BY `id` DESC',25) AS $key=>$row){
              if (empty($row->images)){
                       $src=$temp_front."images/slides/1.jpg";
              }else if(!file_exists("upload/content/".$row->images)){
                       $src=$temp_front."images/slides/1.jpg";
              }else if(file_exists("upload/content/".$row->images)){
                       $src="upload/content/".$row->images;
               }else {
                       $src="upload/content_thumbs/".$row->images;
              }

             ?>


            <div class="list-offer">
              <div class="list-offer-left">
                <div class="list-offer-front">

                  <div class="list-offer-photo">
                    <img src="<?=$src?>" alt="" />

                  </div>
                  <div class="list-offer-params">
                    <div class="list-area">
                      <img src="<?=$temp_front?>images/area-icon.png" alt="" /><?=$row->area;?>m<sup>2</sup>
                    </div>
                    <div class="list-rooms">
                      <img src="<?=$temp_front?>images/rooms-icon.png" alt="" /><?=$row->bedrooms; ?>
                    </div>
                    <div class="list-baths">
                      <img src="<?=$temp_front?>images/bathrooms-icon.png" alt="" /><?=$row->bathrooms; ?>
                    </div>
                  </div>
                </div>
                <div class="list-offer-back">
                  <div id="list-map<?=$row->id;?>" class="list-offer-map"></div>
                </div>
              </div>

              <div class="list-offer-right">
                <div class="list-offer-text">
                  <i class="fa fa-map-marker list-offer-localization"></i>
                  <div class="list-offer-h4"><a href="details.php?module=real_estate&id=<?=$row->id;?>"><h4 class="list-offer-title"><?php if($_SESSION['lang']=="en"):echo $row->name; else: echo $row->name_ar;endif;?></h4></a></div>
                  <div class="clearfix"></div>
                  <a href="details.php?module=real_estate&id=<?=$row->id;?>"><?php if($_SESSION['lang']=="en"):echo news(strip_tags($row->desc),150); else: echo news(strip_tags($row->desc_ar),150); endif;?></a>
                  <div class="clearfix"></div>
                </div>
                <div class="profile-list-footer">
                  <div class="list-price profile-list-price">
                    <?=number_format($row->price);?>
                  </div>

                  <div class="profile-list-info">
                    <div class="pull-left">Updated : </div><?=date('d/m/Y',$row->pubtime);?>
                  </div>
              <!--    <div class="profile-list-info hidden-xs hidden-sm hidden-md">
                  Status: Building
                </div>--->
                </div>
              </div>
             </div>
<?php } ?>






          </div>
        </div>


    </div>








    <div class="col-xs-12 col-md-3 col-md-pull-9">
      <div class="sidebar-left">
        <h3 class="sidebar-title"><?=get_lange('wel_come','backend=1')?><span class="special-color">.</span></h3>
        <div class="title-separator-primary"></div>

        <div class="profile-info margin-top-60">
          <div class="profile-info-title negative-margin"><?=ucwords($res->name);?></div>
          <img src="<?=$temp_front?>images/comment-photo1.jpg" alt="" class="pull-left" />
          <div class="profile-info-text pull-left">

            <a href="logout.php" class="logout-link margin-top-30">
              <i class="fa fa-lg fa-sign-out"></i><?=get_lange("log_out","backend=1")?></a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="center-button-cont margin-top-30">
          <a href="#" class="button-primary button-shadow button-full">
            <span><?=get_lange("project_status","backend=0")?></span>
            <div class="button-triangle"></div>
            <div class="button-triangle2"></div>
            <div class="button-icon"><i class="fa fa-th-list"></i></div>
          </a>
        </div>

        <div class="center-button-cont margin-top-15">
          <a href="add_property.php" class="button-alternative button-shadow button-full">
            <span><?=get_lange("submit_property","backend=0");?></span>
            <div class="button-triangle"></div>
            <div class="button-triangle2"></div>
            <div class="button-icon"><i class="jfont fa-lg">&#xe804;</i></div>
          </a>
        </div>



      </div>
    </div>
  </div>
</div>
</section>



<!--:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!--:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->

<?php

    }

 require(realpath(__DIR__ . '/footer.php'));
