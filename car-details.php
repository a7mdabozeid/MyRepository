<?php require(realpath(__DIR__ . '/header.php'));
require (realpath(__DIR__ .'/libraries/class.security.php'));
  $id=intval($_GET['id']);////id
$module   = clean_value($_GET['module']);//// get module
@$get_data = mysqli_fetch_array(mysqli_query($db,"select * from $tab where `active`=1 and `id`='$id'"));
if(!empty($get_data['id_cat'])){
@$get_cat=select("*","$tab_cat","WHERE `active`=1 and `id`='$get_data[id_cat]'");///select cat  name
}
//echo $get_cat['name'];

if(isset($get_data['name']) && isset($id) ){
update("$tab","`view`=view + 1","WHERE `id`=$id");

if (empty($get_data['image'])){
         $src=$temp_front."img/slider/banner1.jpg";
}else if(!file_exists("upload/content/".$get_data['image'])){
         $src=$temp_front."img/slider/banner1.jpg";
}else if(file_exists("upload/content/".$get_data['image'])){
         $src="upload/content/".$get_data['image'];
}else {
         $src="upload/content_thumbs/".$get_data['image'];
}

?>




<section class="taqseet-calc">
  <div class="container">
    <div class="row">
      <!-- Ad -->
      <div class="col-xs-12">
          <div class="adv">
            <img src="http://35.202.208.179/wp-content/themes/rawaj/img/ads/ad_banner.png" class="img-responsive" alt="" hidden="" style="display: none !important;">
          </div>
      </div>
      <!-- End Ad -->
    </div>

    <!-- Car Title -->
    <div class="car-title">
      <h2 id="make-model"><?=$get_data['manufactor_year']. ' '.$get_data['name_ar'];?></h2>
      <div class="left-panel">
        <h2 id="car-price"><?=number_format($get_data['price']);?> L.E</h2>
        <a href="car-search.php?module=cars&id_cat=<?=$_GET['id_cat'];?>" id="search_for_more">
          ابحث عن المزيد
          <i class="fa fa-arrow-left lft_arr" aria-hidden="true"></i>
        </a>
      </div>
    </div>
    <!-- End Car Title -->

    <!-- Car image slider carousel -->
    <div class="row car-details">
      <div class="col-xs-12">
        <!-- new carousel  -->
        <div class="row">
         <!--<div class="col-xs-2"></div>-->
          <div class="col-xs-12">
            <div class="owl-carousel car-details-carousel">

                        <?php if(!empty($get_data['image'])){ ?>
                             <div class="item">
                                <img src="<?=$src;?>" alt="Car Image">
                              </div>
                        <?php } ?>

                       <?php  //::::::::::::::::::::: get  multi_img here :::::::::::::::::::::::::::
                           $multi_img=$get_data['multi_img'];
                          if(!empty($multi_img)){
                             $multi_img = explode(',',$multi_img);
                             foreach($multi_img as  $value) {
                                if (empty($value)){
                                   $src=$temp_front."/images/post.jpg";
                                }else if(file_exists("upload/content/".$value)){
                                   $src="upload/content/".$value;
                                }else{
                                   $src="upload/content/".$value;
                                }
                       ?>
                    <div class="item">
                      <img src="<?=$src;?>" alt="Car Image">
                    </div>
              <?php } } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Car image slider carousel -->
    <!--  -->
    <!--  -->
    <!-- Car Details information -->
    <div class="row">
      <div class="col-xs-12">
        <div class="row">
          <div class="col-xs-3">
            <ul class="tabs-right" id="myTabs" role="tablist">
              <li class="active"><a href="#tabs-1" role="tab" data-toggle="tab">الآداء</a></li>
              <li><a href="#tabs-2" role="tab" data-toggle="tab">المواصفات الخارجية</a></li>
              <li><a href="#tabs-3" role="tab" data-toggle="tab">التجهيزات الداخلية</a></li>
              <li><a href="#tabs-4" role="tab" data-toggle="tab">مواصفات السلامة والآمان</a></li>
              <li><a href="#tabs-5" role="tab" data-toggle="tab">البيانات والمعلومات</a></li>
              <?php if($_GET['id_cat']==2){ ?>
                <li><a href="#tabs-6" id="ownerInfo" role="tab" data-toggle="tab">بيانات المالك</a></li>
             <?php } ?>

            </ul>
          </div>
          <div class="col-xs-9">
            <div class="tab-content">
              <div id="tabs-1" role="tabpanel" class="tab-pane active">
                <table class="table table-striped table-hover">
                  <tbody>   <?php $get_car_model=select("*","cars_shape","where `id`='$get_data[car_shape_id]'"); ?>
                    <tr><td>المحرك</td><td><?=(!empty($get_car_model['name_ar']))? $get_car_model['name_ar'] :'-'?></td></tr>
                    <tr><td>عدد السلندرات / الاسطوانات</td><td><?=(!empty($get_data['cc']))? $get_data['cc'] :'-'?></td></tr>
                    <tr><td>ناقل الحركة</td><td><?=(!empty($get_data['gearbox']))? $get_data['gearbox'] :'-'?></td></tr>
                    <tr><td>أقصي آداء</td><td><?=(!empty($get_data['no_of_speeds']))? $get_data['no_of_speeds'] :'-'?></td></tr>
                    <tr><td>أقصي عزم</td><td><?=(!empty($get_data['max_performance']))? $get_data['max_performance'] :'-'?></td></tr>
                  </tbody>
                </table>
              </div>
              <div id="tabs-2" role="tabpanel" class="tab-pane">
                <table class="table table-striped table-hover">
                  <tbody>
                    <tr><td>فتحة سقف</td><td><?=(!empty($get_data['sunroof']))? 'يوجد':'-'?></td></tr>
                    <tr><td>سقف بانوراما</td><td><?=(!empty($get_data['panorama_roof']))? 'يوجد':'-'?></td></tr>
                    <tr><td>مصابيح ضباب أمامية</td><td><?=(!empty($get_data['front_fog_lamps']))? 'يوجد':'-'?></td></tr>
                    <tr><td>مصابيح ضباب خلفية</td><td><?=(!empty($get_data['back_fog_lamps']))? 'يوجد':'-'?></td></tr>
                    <tr><td>مصابيح LED أمامية</td><td><?=(!empty($get_data['front_led_lamps']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>مصابيح LED خلفية</td><td><?=(!empty($get_data['back_led_lamps']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>مصابيح زينون</td><td><?=(!empty($get_data['xenon_lamps']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>مرايات كهرباء</td><td><?=(!empty($get_data['']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>مرايات ضم كهرباء</td><td><?=(!empty($get_data['electric_mirror']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>جنوط سبور</td><td><?=(!empty($get_data['sport_rims']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>مقاس الجنط</td><td><?=(!empty($get_data['rims_size']))? $get_data['rims_size']:'-'?></td></tr>
                    <tr style="display: none;"><th>زجاج ملون</th><td><?=(!empty($get_data['colored_glass']))? 'يوجد':'-'?></td></tr>
                  </tbody>
                </table>
                <a class="loadMoreCars_owners" href="#">المزيد</a> <a class="loadLessCars_owners" href="#">تقليل </a>
              </div>
              <div id="tabs-3" role="tabpanel" class="tab-pane">
                <table class="table table-striped table-hover">
                  <tbody><tr><td>عدد المقاعد</td><td><?=(!empty($get_data['no_of_seats']))? $get_data['no_of_seats']:'-'?></td></tr>
                    <tr><td>باور ستيرنج</td><td><?=(!empty($get_data['power_steering']))? 'يوجد':'-'?></td></tr>
                    <tr><td>عجلة القيادة متعدده الوظائف</td><td><?=(!empty($get_data['multi_function_wheel']))? 'يوجد':'-'?></td></tr>
                    <tr><td>زجاج كهربائى أمامى</td><td><?=(!empty($get_data['multi_function_wheel']))? 'يوجد':'-'?></td></tr>
                    <tr><td>زجاج كهربائى خلفى</td><td><?=(!empty($get_data['electric_back_window']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>مثبت سرعة</td><td><?=(!empty($get_data['']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>عجلة القيادة مكسوه بالجلد</td><td><?=(!empty($get_data['']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>فرش جلد</td><td><?=(!empty($get_data['']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>مسند ذراع أمامى</td><td><?=(!empty($get_data['front_chair_armrest']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>مسند ذراع خلفى</td><td><?=(!empty($get_data['back_chair_armrest']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>نظام إضاءة اوتوماتيك</td><td><?=(!empty($get_data['automatic_light_system']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>ضبط مستوى المصابيح</td><td><?=(!empty($get_data['lamb_level_adjustment']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>نظام الإضاءة الذكى</td><td><?=(!empty($get_data['smart_lighting']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>حساسات للمطر</td><td><?=(!empty($get_data['rain_sensors']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>مرآه داخلية حساسة للضوء</td><td><?=(!empty($get_data['lightsensing_internal_mirror']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>مخرج كهربائى</td><td><?=(!empty($get_data['electrical_output']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>بيان ضغط الإطارات</td><td><?=(!empty($get_data['tire_pressure_statment']))? $get_data['tire_pressure_statment']:'-'?></td></tr>
                    <tr style="display: none;"><td>الدخول وإدارة المحرك بدون مفتاح</td><td><?=(!empty($get_data['enter_engine_keyless']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>توصيل المحمول عبر البلوتوث</td><td><?=(!empty($get_data['blutooth_phone_connection']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>حساسات للركن أمامية</td><td><?=(!empty($get_data['front_parking_sensor']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>حساسات للركن خلفية</td><td><?=(!empty($get_data['back_parking_sensor']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>سعة الحقيبة الخلفية</td><td><?=(!empty($get_data['back_trunk_capacity']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>كراسى كهرباء</td><td><?=(!empty($get_data['electric_chair']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>كاميرا خلفية</td><td><?=(!empty($get_data['back_camera']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>ناقل حركة من عجلة القيادة</td><td><?=(!empty($get_data['gearbox_wheel']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>استهلاك الوقود</td><td><?=(!empty($get_data['fuel_consumption']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>سعة خزان الوقود</td><td><?=(!empty($get_data['tank_capacity']))? $get_data['tank_capacity']:'-'?></td></tr>
                  </tbody>
                </table>
                <a class="loadMoreCars_owners" href="#">المزيد</a> <a class="loadLessCars_owners" href="#">تقليل </a>
              </div>
              <div id="tabs-4" role="tabpanel" class="tab-pane">
                <table class="table table-striped table-hover">
                  <tbody>
                    <tr><td>فرامل مانعه للإنغلاق ABS</td><td><?=(!empty($get_data['abs']))? 'يوجد':'-'?></td></tr>
                    <tr><td>نظام فرامل مانع للإنزلاق ESP</td><td><?=(!empty($get_data['esb']))? 'يوجد':'-'?></td></tr>
                    <tr><td>نظام الركن الإلكترونى</td><td><?=(!empty($get_data['electronic_parking']))? 'يوجد':'-'?></td></tr>
                    <tr><td>وسائد هوائية</td><td><?=(!empty($get_data['airbags']))? 'يوجد':'-'?></td></tr>
                    <tr><td>جهاز إنذار</td><td><?=(!empty($get_data['alarm']))? 'يوجد':'-'?></td></tr>
                    <tr style="display: none;"><td>مفتاح مشفر</td><td><?=(!empty($get_data['']))? 'يوجد':'-'?></td></tr>
                  </tbody>
                </table>
              </div>
              <div id="tabs-5" role="tabpanel" class="tab-pane">
                <table class="table table-striped table-hover">
                  <tbody><tr><td>رايود/ سى دى </td><td><?=(!empty($get_data['radio_cd']))? 'يوجد':'-'?></td></tr>
                    <tr><td>MP3</td><td><?=(!empty($get_data['mp3']))? 'يوجد':'-'?></td></tr>
                    <tr><td>AUX</td><td><?=(!empty($get_data['aux']))? 'يوجد':'-'?></td></tr>
                    <tr><td>USB</td><td><?=(!empty($get_data['usb']))? 'يوجد':'-'?></td></tr>
                    <tr><td>سماعات</td>
                      <td><?=(!empty($get_data['speakers']))? 'يوجد':'-'?></td></tr>
                      <tr style="display: none;"><td>شاشة عرض معلومات</td><td><?=(!empty($get_data['']))? 'يوجد':'-'?></td></tr>
                  </tbody>
                </table>
              </div>
              <?php if($_GET['id_cat']==2){ ?>
                <div id="tabs-6" role="tabpanel" class="tab-pane">
                    <table class="table table-striped table-hover"></table>
                     <p> الاسم : julian julian</p>
                     <p> البريد الالكتروني : <a href="mailto:julian@gmail.com" target="_top">julian@gmail.com</a></p>
                     <p> الموبايل : null</p>
                  </div>
              <?php } ?>

            </div>
          </div>
          <div class="col-xs-12">
            <?php if($_GET['id_cat']==1){ ?>
                <a id="buyCarButton" class="btn btn-primary btn-block" href="request.php">قسط الان</a>
            <?php } ?>
          </div>
        </div>
        <!-- Tab panes -->
      </div>
    </div>

    <!-- End Car Details information -->
    <!--  -->
    <!--  -->
  </div>
</section>



<input name="carId" id="carId" type="hidden" value="<?php  echo $_GET["carId"];?>" />
<input name="carType" id="carType" type="hidden" value="<?php  echo $_GET["carType"];?>" />
<input id="imagesRoot" type="hidden" value="<?php //echo content_url(); ?>" />
<form method="post" action="" id="searchParam">
    <input name="make" id="make" type="hidden" value="" />
    <input name="model" id="model" type="hidden" value="" />
    <input name="structure" id="structure" type="hidden" value="" />
    <input name="gearbox" id="gearbox" type="hidden" value="" />
</form>



<?php  }else{  echo '<br><br><div class="text-center">NO data available </div>';}
require(realpath(__DIR__ .'/footer.php'));?>
