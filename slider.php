<!-- slider -->
<section class="slider" style="position:relative ">
  <div class="home-banner owl-carousel">
    <?php
      foreach(getdata('news','WHERE `active`=1','ORDER BY `id` DESC',1) AS $key=>$row){
        if (empty($row->image)){
          $src=$temp_front."img/slider/banner1.jpg";
        }else if(!file_exists("upload/content/".$row->image)){
          $src=$temp_front."img/slider/banner1.jpg";
        }else if(file_exists("upload/content/".$row->image)){
          $src="upload/content/".$row->image;
         }else {
          $src="upload/content_thumbs/".$row->image;
        }
      ?>
        <div class="item" style="background-image: url('<?=$src?>')" alt="<?php if($_SESSION['lang']=="en"):echo $row->name; else: echo $row->name_ar;endif;?>">
          <div class="container">
            <div class="slide-text">        
              <h1>إختيارك الأفضل.</h1>
              <h3>رواج تضمن لك أفضل خدمة تقسيط سيارات</h3>
            </div>
          </div>
        </div>
    <?php } ?>
  </div>
  <div class="container slider-buttons">
    <div class="row">
      <div class="newsearch">
        <ul>
          <li> <a href="car-search.php?module=cars&id_cat=1" class="new"> <i class="fa fa-car lft_arr" aria-hidden="true"></i></span> <span> <?=get_lange("new_cars","backend=0");?> </a> </li>
          <li> <a href="car-search.php?module=cars&id_cat=2" class="used">  <i class="fa fa-car lft_arr" aria-hidden="true"></i></span><span> <?=get_lange("used_cars","backend=0");?></a> </li>
        </ul>
      </div>
    </div>
  </div>
</section>
