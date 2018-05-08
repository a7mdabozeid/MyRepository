<?php require(realpath(__DIR__ . '/header.php')); ?>
<?php require(realpath(__DIR__ . '/slider.php')); ?>
<?php $user_id_front = ''?>
<!-- taqseet section -->
<section class="taqseet-calc">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6">
        <form class="form-wrap">
          <h3 style="font-size:30px;padding-bottom:20px"><?=get_topic_name(78,200)?></h3>
        </form>
        <div class="block row calculate-text">
          <div class="col-md-12">
            <div class="col-md-3 col-sm-3 col-xs-3"> <a href="car-search.php?module=cars&id_cat=1">
              <img src="upload/content/<?=get_topic_image(69);?>"></a>
            </div>
            <div class="col-md-5 col-sm-9 col-xs-9">
              <h3 style="font-size:30px"><?=get_topic_name(69,200);?></h3>
              <p><?=get_topic_desc(69,250);?></p>
            </div>
          </div>
        </div>
        <div class="block row calculate-text">
          <div class="col-md-12">
            <div class="col-md-offset-3 col-md-5 col-sm-9 col-xs-9">
              <h3 style="font-size:30px;"><?=get_topic_name(68,200);?></h3>
              <p style="text-align:justify"><?=get_topic_desc(68,250);?></p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3"> <a href="installment.php"><img src="upload/content/<?=get_topic_image(68);?>"></a>
            </div>
          </div>
        </div>
        <div class="block row calculate-text">
          <div class="col-md-12">
            <div class="col-md-3 col-sm-3 col-xs-3"> <a href="<?php //echo get_site_url(); ?>/reuest/">
              <img src="upload/content/<?=get_topic_image(71);?>"></a>
            </div>
            <div class="col-md-5 col-sm-9 col-xs-9">
              <h3 style="font-size:30px"><?=get_topic_name(71,200);?></h3>
              <p><?=get_topic_desc(71,250);?></p>
            </div>
          </div>
        </div>
      </div>
      <!-- start main valid of form -->
      <script>
       
      </script>

      <div class="col-xs-12 col-sm-6 col-md-6 home-calc">
        <form class="form-wrap" id="home_calculator">
          <h4><?=get_topic_name(79,200)?></h4>
          <p><?=get_topic_desc(79,250)?></p>
          <div class="form-group">
              <label class="control-label">اجمالي سعر الشراء</label>
              <input  name="cashPriceVal" type="text" class="form-control cashPriceVal"  placeholder="ادخل سعر الشراء اولا" />
          </div>
          <div class="form-group">
            <label class="control-label">برامج التقسيط</label>
            <select name="installement_programs"  class="form-control installement_programs">
              <?php foreach(getdata('installment_system','where `active`=1','ORDER BY `id` ASC',25) AS $row){ ?>
                <option value="<?=$row->value;?>"><?php if($_SESSION['lang']=="en"){echo $row->name;}else{echo $row->name_ar;}?> </option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">الدفعة المقدمة</label>
            <input class="downPayment" value="40" name="downPayment" type="text" size="2" maxlength="2" />
            % أي تساوي
            <input class="mindownPaymentInMoney" value="0" name="mindownPaymentInMoney" type="text"  size="10" maxlength="10"  disabled="true"/>
            ج.م
          </div>
          <div class="form-group">
            <label class="control-label">عدد شهور الدفع</label>
            <select class="form-control months_count" name="months_count" >
                <option value="12">12</option>
                <option value="24">24</option>
                <option value="36">36</option>
                <option value="48">48</option>
                <option value="60">60</option>
            </select>
          </div>
          <h4 class="text-center">قيمة القسط <span id="installment_monthly" class="red-text">0</span> ج.م</h4>
        </form>
      </div>
    </div>
  </div>
</section>
<section class="newest-cars">
  <div class="real">
    <h2><span><?=get_topic_name(72,200);?> </span></h2>
    <p><?=get_topic_desc(72,250);?></p>
  </div>
  <div class="container">
    <div id="newest-cars" class="owl-carousel owl-theme">
      <?php foreach(getdata( 'cars', 'where `id_cat`=1', 'ORDER BY `id` DESC',25) AS $key=>$row){ if (empty($row->image)){ $src=$temp_front."img/slider/banner1.jpg"; }else if(!file_exists("upload/content/".$row->image)){ $src=$temp_front."img/slider/banner1.jpg"; }else if(file_exists("upload/content/".$row->image)){ $src="upload/content/".$row->image; }else { $src="upload/content_thumbs/".$row->image; } ?>
      <div class="item inproduct">
        <a class="card-link" href="car-details.php?module=cars&id_cat=1&id=<?=$row->id;?>" id="carDetailURL" title="اضغط لتعرف المزيد">
        </a>
        <div class="item-inner">
            <img src="<?=$src?>" class="img-responsive fixed-size rawaj-car-image">
            <span class="left-align priceValueForCar"><?=number_format($row->price);?> كاش</span>
          <ul>
            <li>
              <a href="#" title="اضف للمفضلة">
                <i class="fa fa-heart-o add_favorite" rate_value="0" module="favorite" id_content="<?=$row->id;?>" user_id="<?=$user_id_front;?>" ip_adress="<?=$_SERVER['REMOTE_ADDR']?>" name="<?=($_SESSION['lang']=='en')? $row->name : $row->name_ar;?>">
                </i>
              </a>
            </li>
            <li>
              <a href="#" title="قارن">
                <i class="fa fa-plus add_favorite" rate_value="0" module="compare" id_content="<?=$row->id;?>" user_id="<?=$user_id_front;?>" ip_adress="<?=$_SERVER['REMOTE_ADDR']?>" name="<?=($_SESSION['lang']=='en')? $row->name : $row->name_ar;?>">
                </i>
              </a>
            </li>
            <li>
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$url?>car-details.php?module=cars&id=<?=$row->id;?>" target="_blank" title="شارك على الفيس بوك">
                <i class="fa fa-share-alt"></i>
              </a>
            </li>
            <li>
              <a class="calculator" onclick="whenClickCalculate(this,5)" href="#" title="احسب قسطك" data-toggle="modal" data-target="#calculatorForm">
                <i class="fa fa-calculator"></i>
                <input class="clickedCarPrice" name="clickedCarPrice" type="hidden" value="565000">
              </a>
            </li>
          </ul>
        </div>
        <div class="btm-bar">
          <label class="center-block">
            <span class="center-align car-name"><?php if($_SESSION['lang']=="en"){echo $row->name;}else{echo $row->name_ar;}?></span>
          </label>
          <label class="flex-block">
            <span class="flex-inner-block"><?=($row->gearbox=="A/T")?'اوتوماتيك':'مانيوال'?></span>
            <span class="flex-inner-block"><?=$row->manufactor_year;?></span>
            <span class="flex-inner-block intallementValueForCar">7534 قسط</span>
          </label>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</section>
<!-- sell your car -->
<section class="sell">
  <img src="<?=$temp_front?>img/banners/banner3.jpg" class="top-img">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-12">
        <div class="row">
          <div class="col-xs-12 col-md-4 text-center">
            <div class="sell-block orange">
              <!--  <a href="javascript:void(0)"><img src="<?php echo $temp_front; ?>img/sell1.png" class="sellimg-num"></a>-->
              <a href="javascript:void(0)"><img src="upload/content/<?=get_topic_image(73);?>" class="sellimg-view"></a>
              <h4><span><?=get_topic_name(73,200);?> </span> </h4>
              <p>
                <?=get_topic_desc(73,250);?>
              </p>
            </div>
          </div>
          <div class="col-xs-12 col-md-4 text-center">
            <div class="sell-block">
              <!--  <a href="javascript:void(0)"><img src="<?php echo $temp_front; ?>img/sell2.png" class="sellimg-num"></a>-->
              <a href="javascript:void(0)"><img src="upload/content/<?=get_topic_image(74);?>" class="sellimg-view"></a>
              <h4 class="greencolor"><span><?=get_topic_name(74,200);?> </span> </h4>
              <p>
                <?=get_topic_desc(74,250);?>
              </p>
            </div>
          </div>
          <div class="col-xs-12 col-md-4 text-center">
            <div class="sell-block blue">
              <!--  <a href="javascript:void(0)"><img src="<?php echo $temp_front; ?>img/sell3.png" class="sellimg-num"></a>-->
              <a href="javascript:void(0)"><img src="upload/content/<?=get_topic_image(75);?>" class="sellimg-view"></a>
              <h4><span><?=get_topic_name(75,250);?> </span> </h4>
              <p>
                <?=get_topic_desc(75,250);?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--banner section -->
<section class="banner">
  <div class="container"> <img src="<?=$temp_front?>img/ads/ad_banner.png" class="img-responsive"> </div>
</section>
<!-- used-car section -->
<section class="newest-cars used-car">
  <!--<a href="#" class="call-pattern"><img src="<?=$temp_front?>img/call2.png"></a>-->
  <img src="<?=$temp_front?>img/used-pattern.png" class="used-pattern">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-7 title">
        <h3><?=get_topic_name(77,250);?></h3>
        <h6>المستعمله</h6>
        <p><?=get_topic_desc(77,350);?></p>
      </div>
      <div class="col-xs-12 col-md-5"> <img src="<?=$temp_front?>img/vlx-car.png" class="img-responsive"> </div>
    </div>
    <div id="used-cars" class="owl-carousel owl-theme">
      <?php 
      $usedCars = getdata( 'cars', 'where `id_cat`=2', 'ORDER BY `id` DESC',25);
      if($usedCars)
      {
      foreach($usedCars AS $row){
        if (empty($row->image)){ $src=$temp_front."img/slider/banner1.jpg";
        }else if(!file_exists("upload/content/".$row->image)){ $src=$temp_front."img/slider/banner1.jpg";
        }else if(file_exists("upload/content/".$row->image)){ $src="upload/content/".$row->image;
        }else { $src="upload/content_thumbs/".$row->image;
        }
        $car_brand_id=$row->car_brand_id;
        $car_model_id=$row->car_model_id;
        //:::::: to get cars_used data from cars table
        $get_used_cars=select("*","cars_used","where `id`='$row->id' ");
        //::::: to get car Brand
        $get_car_brand=select("*","cars_types","where `id`='$car_brand_id'");
         //::::: to get car Model
         $get_car_model=select("*","cars_types","where `id`='$car_model_id'"); ?>

        <div class="item inproduct">
          <a class="card-link" href="car-details.php?module=cars&id=<?=$row->id;?>" id="carDetailURL" title="اضغط لتعرف المزيد">
          </a>
          <div class="item-inner">
            <img src="<?=$src?>" class="img-responsive fixed-size rawaj-car-image"  alt="Car Image">
            <span class="left-align priceValueForCar"><?=number_format($row->price);?> LE</span>
            <ul>
              <li>
                <a href="#" title="اضف للمفضلة">
                  <i class="fa fa-heart-o add_favorite" rate_value="0" module="favourite" id_content="<?=$get_used_cars[car_id];?>" user_id="<?=$user_id_front;?>" ip_adress="<?=$_SERVER['REMOTE_ADDR']?>" name="<?=($_SESSION['lang']=='en')? $row->name : $row->name_ar;?>">
                  </i>
                </a>
              </li>
              <li>
                <a href="#" title="قارن">
                  <i class="fa fa-plus add_favorite" rate_value="0" module="compare" id_content="<?=$row->car_id;?>" user_id="<?=$user_id_front;?>" ip_adress="<?=$_SERVER['REMOTE_ADDR']?>" name="<?=($_SESSION['lang']=='en')? $row->name : $row->name_ar;?>">
                  </i>
                </a>
              </li>
              <li>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$url?>car-details.php?module=cars&id=<?=$row->id;?>" target="_blank" title="شارك">
                  <i class="fa fa-share-alt"></i>
                </a>
              </li>
          </ul>
          </div>
          <div class="btm-bar">
            <label class="center-block">
              <span class="center-align car-name">
                <?=$get_car_brand[ 'name_ar']. '-'.$get_car_model[ 'name_ar'];?>
              </span>
            </label>
            <label class="flex-block">
              <span class="flex-inner-block"><?=($row->gearbox=="A/T")?'اوتوماتيك':'مانيوال'?></span>
              <span class="flex-inner-block"><?=substr($row->manufactor_year,6);?></span>
              <span class="flex-inner-block intallementValueForCar"><?=$get_used_cars['km'];?>KM</span>
            </label>
          </div>
        </div>
      <?php }
      } ?>
    </div>
  </div>
</section>

<!--:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!--:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<?php include( "footer.php"); ?>
