<?php require(realpath(__DIR__ . '/header.php')); ?>
<?php require(realpath(__DIR__ . '/slider.php')); ?>

<!-- taqseet section -->
<section class="taqseet-calc">
 <div class="container">
   <div class="row">
     <div class="col-xs-12 col-sm-8 col-md-8">
       <form class="form-wrap" >
         <h3 style="font-size:30px;padding-bottom:20px"><?=get_topic_name(78,200)?></h3>
       </form>
       <div class="block row calculate-text">
         <div class="col-md-10">
           <div class="col-md-3 col-sm-3 col-xs-3"> <a href="car-search.php?module=cars&id_cat=1">
             <img src="upload/content/<?=get_topic_image(69);?>"></a> </div>
           <div class="col-md-5 col-sm-9 col-xs-9" >
             <h3 style="font-size:30px"><?=get_topic_name(69,200);?></h3>
             <p><?=get_topic_desc(69,250);?></p>
           </div>
         </div>
       </div>

       <div class="block row calculate-text">
         <div class="col-md-10">
           <div class="col-md-offset-3 col-md-5 col-sm-9 col-xs-9" >
             <h3 style="font-size:30px;"><?=get_topic_name(68,200);?></h3>
             <p style="text-align:justify"><?=get_topic_desc(68,250);?></p>
           </div>
           <div class="col-md-3 col-sm-3 col-xs-3"> <a href="installment.php"><img src="upload/content/<?=get_topic_image(68);?>"></a></div>
         </div>
       </div>

       <div class="block row calculate-text">
         <div class="col-md-10">
           <div class="col-md-3 col-sm-3 col-xs-3"> <a href="<?php //echo get_site_url(); ?>/reuest/">
             <img src="upload/content/<?=get_topic_image(71);?>"></a></div>
           <div class="col-md-5 col-sm-9 col-xs-9" >
             <h3 style="font-size:30px"><?=get_topic_name(71,200);?></h3>
             <p><?=get_topic_desc(71,250);?></p>
           </div>
         </div>
       </div>
     </div>
     			<!-- start main valid of form -->

 <script>
     $(document).ready(function(){

     //:::::: disabled all form
     $(".installement_programs").attr("disabled","true");
     $(".downPayment").attr("disabled","true");
     $(".months_count").attr("disabled","true");

     //:::::::::::::: start keyup function
     $(document).on('keyup','.cashPriceVal',function(){

       $(".installement_programs").removeAttr("disabled");
       $(".downPayment").removeAttr("disabled");
       $(".months_count").removeAttr("disabled");

     //::::::::::::::::::::::
       var cash_price=$('.cashPriceVal').val();

           if(cash_price==0){
             $(".installement_programs").attr("disabled","true");
             $(".downPayment").attr("disabled","true");
             $(".months_count").attr("disabled","true");
            }else{
             $(".installement_programs").removeAttr("disabled");
             $(".downPayment").removeAttr("disabled");
             $(".months_count").removeAttr("disabled");
            }

     	    var downPayment=$('.downPayment').val();
     	    var months_count=$('.months_count').val();

           var total=cash_price*downPayment/100;
           var ex=cash_price-total;
           var installment_monthly=parseFloat(ex/months_count);
          	$(".mindownPaymentInMoney").val(total);

           var FormatPrice=installment_monthly.toLocaleString('ar-EG') // to format number in arabic
           document.getElementById("installment_monthly").innerHTML = FormatPrice;


     //::::::::::::::::::::::: on change Months function
      $('.months_count').change(function(e) {
         var months_count = $(e.target).val();
         //  alert(months_count);
         var cash_price=$('.cashPriceVal').val();
         var downPayment=$('.downPayment').val();
         var total=cash_price*downPayment/100;
         var ex=cash_price-total;
         var installment_monthly=parseFloat(ex/months_count);
         $(".mindownPaymentInMoney").val(total);

         var FormatPrice=installment_monthly.toLocaleString('ar-EG') // to format number in arabic
         document.getElementById("installment_monthly").innerHTML = FormatPrice;



        });

     //::::::::::::::::::::::::: on change downPayment value

     $(document).on('keyup','.downPayment',function(){

           var cash_price=$('.cashPriceVal').val();

           var downPayment=$('.downPayment').val();
     	    var months_count=$('.months_count').val();

           var total=cash_price*downPayment/100;
           var ex=cash_price-total;
           var installment_monthly=parseFloat(ex/months_count);
          	$(".mindownPaymentInMoney").val(total);

           var FormatPrice=installment_monthly.toLocaleString('ar-EG') // to format number in arabic
           document.getElementById("installment_monthly").innerHTML = FormatPrice;
         });



   //::::::::::::::::::::::: on change installment system function
    $('.installement_programs').change(function(e) {
       var installement_programs = $(e.target).val();
        // alert(installement_programs);

       $(".downPayment").val(installement_programs);

       var months_count = $('.months_count').val();

      var cash_price=$('.cashPriceVal').val();
       var downPayment=$('.downPayment').val();
       var total=cash_price*downPayment/100;
       var ex=cash_price-total;
       var installment_monthly=parseFloat(ex/months_count);
       $(".mindownPaymentInMoney").val(total);

       var FormatPrice=installment_monthly.toLocaleString('ar-EG') // to format number in arabic
       document.getElementById("installment_monthly").innerHTML = FormatPrice;



      });






       });
     });
     </script>



                 <div class="col-xs-12 col-md-4">
                     <form class="form-wrap" >
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
                                 ج.م </div>
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
    <div id="newest-cars" class="owl-carousel owl-theme owl-loaded owl-drag">
      <div class="owl-stage-outer">
        <div class="owl-stage" style="transform: translate3d(-3285px, 0px, 0px); transition: 0.25s; width: 6995px; padding-left: 30px; padding-right: 30px;">


          <?php
          foreach(getdata('cars','where `id_cat`=1','ORDER BY `id` DESC',25) AS $key=>$row){
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

          <div class="owl-item active" style="width: 350px; margin-right: 15px;">
          <div class="item inproduct">

            <div class="item-inner">
            <a class="" href="car-details.php?module=cars&id_cat=1&id=<?=$row->id;?>" id="carDetailURL" title="اضغط لتعرف المزيد">
              <img src="<?=$src?>" class="img-responsive fixed-size rawaj-car-image">
              <span class="left-align priceValueForCar"><?=number_format($row->price);?> كاش</span>
            </a>
              <ul>
                <li><a href="#" title="اضف للمفضلة">
                  <i class="fa fa-heart-o add_favorite" rate_value="0" module="favorite" id_content="<?=$row->id;?>" user_id="<?=$user_id_front;?>" ip_adress="<?=$_SERVER[REMOTE_ADDR]?>" name="<?=($_SESSION[lang]=='en')? $row->name : $row->name_ar;?>">
                </i>
               </a>
              </li>
                <li>
                  <a href="#" title="قارن"><i class="fa fa-plus add_favorite" rate_value="0" module="compare" id_content="<?=$row->id;?>" user_id="<?=$user_id_front;?>" ip_adress="<?=$_SERVER[REMOTE_ADDR]?>" name="<?=($_SESSION[lang]=='en')? $row->name : $row->name_ar;?>"></i></a>
                </li>
                <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?=$url?>car-details.php?module=cars&id=<?=$row->id;?>" target="_blank" title="شارك على الفيس بوك"><i class="fa fa-share-alt"></i></a>
                </li>
                <li><a class="calculator" onclick="whenClickCalculate(this,5)" href="#" title="احسب قسطك" data-toggle="modal" data-target="#calculatorForm"><i class="fa fa-calculator"></i><input class="clickedCarPrice" name="clickedCarPrice" type="hidden" value="565000"></a></li>
            </ul>
          </div>

          <div class="btm-bar">
            <label class="center-block">
              <span class="center-align car-name"><?php if($_SESSION['lang']=="en"){echo $row->name;}else{echo $row->name_ar;}?></span>
              <span class="center-align"></span>
            </label>
            <label class="flex-block">
              <span class="flex-inner-block">اوتوماتيك</span>
              <span class="flex-inner-block"><?=$row->manufactor_year;?></span>
              <span class="flex-inner-block intallementValueForCar">7534 قسط</span>
            </label>
          </div>
        </div>
      </div>

<?php } ?>

 </div></div><div class="owl-nav"><div class="owl-prev"><i class="fa fa-chevron-left home_slider_arrow"></i></div><div class="owl-next"><i class="fa fa-chevron-right home_slider_arrow"></i></div></div><div class="owl-dots"><div class="owl-dot"><span></span></div><div class="owl-dot active"><span></span></div><div class="owl-dot"><span></span></div></div></div>
  </div>
</section>


<!-- sell your car -->
<section class="sell"> <img src="<?=$temp_front?>img/banners/banner3.jpg" class="top-img">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-5">
              <!--  <h2 class="sell-ur-car">بيع عربيتك</h2>
                <div class="login-form">
                    <form class="form-wrap form-horizontal login_reg" id="home_loginForm"  method="post" >
                        <p class="message text-center"></p>
                        <h4>يمنحك رواج إمكانية التواصل
                            معنا ومشاركتنا في كل جديد...</h4>
                        <p>فى اقل من دقيقتين</p>
                        <div class="form-group">
                            <label class="control-label required-field">اسم المستخدم</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label class="control-label required-field">كلمة السر</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <a href="#">هل نسيت كلمه المرور ؟</a>
                        <button type="submit" class="btn btn-block login_reg_btn" name="login" id="home_login_btn">دخول</button>
                    </form>
                    <form class="form-wrap form-horizontal login_reg" id="home_reqistrationForm"  method="post" >
                        <span>او</span>
                        <div class="line"></div>
                        <p class="message text-center"></p>
                        <p>مجانى وسيبقى مجانى دائما</p>
                        <div class="form-group">
                            <label class="control-label">الاسم الاول</label>
                            <input type="text" class="form-control" name="firstname" id="firstname">
                        </div>
                        <div class="form-group">
                            <label class="control-label">اسم العائلة</label>
                            <input type="text" class="form-control"  name="lastname" id="lastname">
                        </div>
                        <div class="form-group">
                            <label class="control-label required-field">رقم المحمول</label>
                            <input type="text" class="form-control" name="mobile" id="mobile">
                        </div>
                        <div class="form-group">
                            <label class="control-label required-field">اسم المستخدم</label>
                            <input type="text" class="form-control" name="username"  id="username">
                        </div>
                        <div class="form-group">
                            <label class="control-label required-field">البريد الالكتروني</label>
                            <input type="text" class="form-control" name="email"  id="email">
                        </div>
                        <div class="form-group">
                            <label class="control-label required-field">كلمة السر</label>
                            <input type="password" class="form-control" name="password" id="home_password">
                        </div>
                        <div class="form-group">
                            <label class="control-label">اعادة كلمة السر</label>
                            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword">
                        </div>
                        <div class="form-group">
                            <input name="" type="button" class="choose_image btn btn-primary btn-xs" value="   اختر صورة الحساب   " />
                            <input type="file" class="" name="user_img" id="user_img" style="display:none;">
                            <label class="control-label" id="user_image_val"></label>
                        </div>
                        <button type="submit" class="btn btn-block" name="register" id="home_register_btn">اشترك الان</button>
                    </form>
                </div>--->

            </div>





            <div class="col-xs-12 col-md-12">
                <div class="row">
                    <div class="col-xs-12 col-md-4 text-center">
                        <div class="sell-block orange">
                        <!--  <a href="javascript:void(0)"><img src="<?php echo $temp_front; ?>img/sell1.png" class="sellimg-num"></a>-->
                          <a href="javascript:void(0)"><img src="upload/content/<?=get_topic_image(73);?>" class="sellimg-view"></a>
                            <h4><span><?=get_topic_name(73,200);?> </span> </h4>
                            <p><?=get_topic_desc(73,250);?> </p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4 text-center">
                        <div class="sell-block">
                        <!--  <a href="javascript:void(0)"><img src="<?php echo $temp_front; ?>img/sell2.png" class="sellimg-num"></a>-->
                          <a href="javascript:void(0)"><img src="upload/content/<?=get_topic_image(74);?>" class="sellimg-view"></a>
                            <h4 class="greencolor"><span><?=get_topic_name(74,200);?> </span> </h4>
                            <p><?=get_topic_desc(74,250);?> </p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4 text-center">
                        <div class="sell-block blue">
                        <!--  <a href="javascript:void(0)"><img src="<?php echo $temp_front; ?>img/sell3.png" class="sellimg-num"></a>-->
                          <a href="javascript:void(0)"><img src="upload/content/<?=get_topic_image(75);?>" class="sellimg-view"></a>
                            <h4><span><?=get_topic_name(75,250);?> </span> </h4>
                            <p><?=get_topic_desc(75,250);?></p>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
</section>
<!--banner section -->
<section class="banner">
    <div class="container"> <img src="<?=$temp_front?>/img/installment.png" class="img-responsive"> </div>
</section>
<!-- used-car section -->










<section class="newest-cars used-car whitebg">
  <!--<a href="#" class="call-pattern"><img src="<?=$temp_front?>img/call2.png"></a>-->
  <img src="<?=$temp_front?>img/used-pattern.png" class="used-pattern">
    <div class="container">
      <div class="row">
          <div class="col-xs-12 col-md-7 title">
              <h3><?=get_topic_name(77,250);?></h3>
              <h6>المستعمله</h6>
              <p>ه<?=get_topic_desc(77,350);?></p>
          </div>
          <div class="col-xs-12 col-md-5"> <img src="<?=$temp_front?>img/vlx-car.png" class="img-responsive"> </div>
      </div>




        <div id="used-cars" class="owl-carousel owl-theme col-xs-12 owl-loaded owl-drag">
          <div class="owl-stage-outer">





        <div class="owl-stage" style="transform: translate3d(-2625px, 0px, 0px); transition: 0.25s; width: 7125px;">



          <?php
          foreach(getdata('cars','where `id_cat`=2','ORDER BY `id` DESC',25) AS $row){
            if (empty($row->image)){
                     $src=$temp_front."img/slider/banner1.jpg";
            }else if(!file_exists("upload/content/".$row->image)){
                     $src=$temp_front."img/slider/banner1.jpg";
            }else if(file_exists("upload/content/".$row->image)){
                   $src="upload/content/".$row->image;
            }else {
                     $src="upload/content_thumbs/".$row->image;
            }

            $car_brand_id=$row->car_brand_id;
            $car_model_id=$row->car_model_id;
//:::::: to get cars_used data from cars table
$get_used_cars=select("*","cars_used","where `id`='$row->id' ");

//::::: to get car Brand
$get_car_brand=select("*","cars_types","where `id`='$car_brand_id'");
//::::: to get car Model
$get_car_model=select("*","cars_types","where `id`='$car_model_id'");
 ?>
                      <div class="owl-item cloned" style="width: 360px; margin-right: 15px;">

                        <div class="item inproduct">
                            <div class="item-inner">
                              <img src="http://localhost/freelance/rawaj/wp-content/car_imgs/vehicle/1.png" class="img-responsive fixed-size rawaj-car-image" alt="Car Image">
                              <a class="overlay" href="car-details.php?module=cars&id=<?=$row->id;?>"  title="اضغط لتعرف المزيد"></a>
                            <ul>
                            <a class="overlay" href="car-details.php?module=cars&id=<?=$row->id;?>"  title="اضغط لتعرف المزيد">
                            </a>
                            <li>
                              <a class="overlay " href="car-details.php?module=cars&id=<?=$row->id;?>"  title="اضغط لتعرف المزيد"></a>
                              <a href="#" title="اضف للمفضلة"><i class="fa fa-heart-o add_favorite" rate_value="0" module="favourite" id_content="<?=$row->id;?>" user_id="<?=$user_id_front;?>" ip_adress="<?=$_SERVER[REMOTE_ADDR]?>" name="<?=($_SESSION[lang]=='en')? '1':'0';?>">
                              </i></a>
                            </li>
                            <li>
                              <a href="#" title="قارن"><i class="fa fa-plus add_favorite" rate_value="0" module="compare" id_content="<?=$row->id;?>" user_id="<?=$user_id_front;?>" ip_adress="<?=$_SERVER[REMOTE_ADDR]?>" name="<?=($_SESSION[lang]=='en')? $row->name : $row->name_ar;?>">
                            </i>
                          </a>
                          </li>
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?=$url?>car-details.php?module=cars&id=<?=$row->id;?>" target="_blank" title="شارك"><i class="fa fa-share-alt"></i></a></li>
                          </ul>

                         </div>
                        <div class="btm-bar">
                          <div class="right-align">

                            <p><?=$get_car_brand['name_ar'].'-'.$get_car_model['name_ar'];?></p>
                        <!--    <p>هيونداى-النترا</p>-->
                          <span class="priceValueForCar">
                          <?=number_format($row->price);?> LE</span>
                        </div>
                        <div class="center">
                          <p><?=$row->manufactor_year;?></p>
                          <p></p>
                        </div>
                        <div class="left-align"><p>اوتوماتيك</p>
                          <span><?=$get_used_cars['km'];?> KM</span>
                        </div>
                        </div>
                        </div>
                      </div>
                    <?php } ?>



    </div>







  </div>
    <div class="owl-nav">
      <div class="owl-prev"><i class="fa fa-chevron-left"></i></div>
      <div class="owl-next"><i class="fa fa-chevron-right"></i></div>
  </div>
    <div class="owl-dots"><div class="owl-dot active"><span></span></div>
    <div class="owl-dot"><span></span></div>
    <div class="owl-dot"><span></span></div>
    </div>
  </div>
    </div>
</section>
<!--:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<!--:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->

<?php  include("footer.php"); ?>
