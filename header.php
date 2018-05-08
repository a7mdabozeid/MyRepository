<?php session_start(); ob_start();
/*echo '<pre>';
print_r($_SESSION);
echo'</pre>';*/
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');
include_once realpath(__DIR__ . '/include/change_lang.php');
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'ar';
}
$_SESSION['lang'] ='ar';

/*
$vehicles_attribute_array = ["make", "make_en", "model", "model_en", "vehicle_type", "Vehicle_type_en", "category", "manufactor_year", "vehicle_engine",
    "no_of_cylinder", "cc", "gearbox", "gearbox_type", "no_of_speeds", "max_performance", "max_torque", "sunroof", "panorama_roof",
    "front_fog_lamps", "back_fog_lamps", "front_led_lamps", "back_led_lamps", "xenon_lamps", "electric_mirror",
    "electric_join_mirror", "sport_rims", "rims_size", "colored_glass", "no_of_seats", "power_steering",
    "multi_function_wheel", "electric_front_window", "electric_back_window", "cruise_control",
    "leather_covered_wheel", "leather_dressing", "front_chair_armrest", "back_chair_armrest", "automatic_light_system",
    "lamb_level_adjustment", "smart_lighting", "rain_sensors", "lightsensing_internal_mirror", "electrical_output_amp",
    "electrical_output", "tire_pressure_statment", "back_ac_vents", "enter_engine_keyless", "blutooth_phone_connection",
    "front_parking_sensor", "back_parking_sensor", "back_trunk_capacity", "electric_chair", "back_camera", "gearbox_wheel",
    "fuel_consumption", "tank_capacity", "abs", "esb", "electronic_parking", "ac", "airbags", "alarm", "encrypted_key", "radio_cd",
    "mp3", "aux", "usb", "speakers", "info_screen", "main_img", "price"];


            //print_r($_POST);
            $update_array = [];
            $attributes_type_array = [];

            unset($vehicles_attribute_array['make_en']);
            foreach ($vehicles_attribute_array as $value) {
                echo $value.'<br>';
}
*/



/*
//::::::::::: to update title and name
foreach(getdata('cars','','ORDER BY `id` DESC',1000) AS $row){
  $car_brand_id   =$row->car_brand_id;
  $car_model_id   =$row->car_model_id;
  $car_shape_id   =$row->car_shape_id;
  $car_categor_id =$row->car_category_id;

if($row->gearbox=="A/T"){
  $gearbox="أوتوماتيك";
}else {
  $gearbox="مانيوال";
}

  //::::: to get car Brand
  $get_car_brand=select("*","cars_brand","where `id`='$car_brand_id'");
  //::::: to get car Model
  $get_car_model=select("*","cars_model","where `id`='$car_model_id'");
  //::::: to get car Model
  $get_car_shape=select("*","cars_shape","where `id`='$car_shape_id'");
  //::::: to get car Model
  $get_car_category=select("*","cars_category","where `id`='$car_categor_id'");


  $name= $get_car_brand['name_ar'].' '.$get_car_model['name_ar'].' '.$get_car_shape['name_ar'].' '.$get_car_category['name_ar'];


if(update("cars","`name`='$name',`name_ar`='$name',`title`='$name',`title_ar`='$name'","where `id`='$row->id' ")){
echo "Done";
}else {
  echo "none";
}

}
*/


/*

$a = 1;
$query = mysqli_query($db, "select DISTINCT model from `Vehicle`");
$query = mysqli_query($db, "select DISTINCT make from `Vehicle`");
$query = mysqli_query($db, "select DISTINCT car_shape_id from `cars`");
//$query = mysqli_query($db, "select DISTINCT gearbox from `Vehicle`");
//$query = mysqli_query($db, "select DISTINCT category from `cars`");
while ($row = mysqli_fetch_object($query)) {
    foreach ($row as $val);
        echo $a . '-' . $val . '<br>';
    $a++;
}
*/


/*
$a = 1;
$query =mysqli_query($db,"select * from `cars_brand` where car_model=0 order by id ASC ");
while ($row = mysqli_fetch_object($query)) {
     echo '<option value="'.$row->id.'">********'.$row->name_ar.'</option><br>';

       $query2 =mysqli_query($db,"select * from `cars_brand` where `car_model` ='$row->id'");
       while ($row2 = mysqli_fetch_object($query2)) {
          echo '<option value="'.$row2->id.'">Model=>'.$row2->name_ar.'</option>';

          $query3 =mysqli_query($db,"select DISTINCT car_shape_id from `cars` where `car_model_id` ='$row2->id'");
          while ($row3 = mysqli_fetch_object($query3)) {
            foreach ($row3 as $valx);
             echo '<option value="'.$valx.'">shape=>'.$valx.'</option><br>';

              }

     }
     echo '=================XX===============';

  $a++;
}

*/



/*
//::::::::::to update pruce
foreach(getdata('newvehicle','','ORDER BY `n_id` DESC',1000) AS $row){
$price=$row->price;
$vehicle_id=$row->vehicle_id;
 //echo $vehicle_id.'='. $price.'<br>';
if(update("cars","`price`='$price'","where `id`='$vehicle_id' ")){
echo "Done";
}else {
  echo "none";
}

    }
*/






 if(isset($_SESSION['user_name']) && isset($_SESSION['user_id_front']) ) : // start check user loged or not
$user_name_f = $_SESSION['user_name'];
$user_id_front = $_SESSION['user_id_front'];
$get_user=mysqli_fetch_object(mysqli_query($db,"SELECT * FROM `members` where `user_name`='$user_name_f' ")) ;

endif; // end check user loged or not


//////////////////////// START MAIN FETCH DATA  /////////////////////////////
$get_setting = select("*", "site_pro", "where id = 4"); // get bada from setting
$parts = explode('/', $_SERVER["SCRIPT_NAME"]); // explode url to get file name
$file = $parts[count($parts) - 1]; // get files name
//////////////////////// END MAIN FETCH DATA /////////////////////////////
///////////////// START put module in array to page all//////////////////
get_module();
///////////////// END put module in array to page all//////////////////
///////////////////////// START MAIN GET PAGE /////////////////////////
if ($file == "car-details.php") { // start file detailes
    $id = intval($_GET['id']); ////id
    $get_data = select("*", "$tab", "WHERE id=$id");
    @$url_img_big = $url . '/upload/content/' . $get_data['image']; // get image of content big size
    @$url_img_thum = $url . '/upload/content_thumbs/' . $get_data['image']; // get image of content thmub size
}// end file detailes

if ($file == "cat.php") { // start file cat
    $id = intval($_GET['id_cat']); ////id
    $rows = select("*", "$tab_cat", "WHERE active=1 and id=$id"); ///select content  name
    @$url_img_big = $url . '/upload/content/' . $get_data['image']; // get image of content big size
    @$url_img_thum = $url . '/upload/content_thumbs/' . $get_data['image']; // get image of content thmub size
} // end file cat
else
{
    $url_img_big = '';
    $url_img_thum = '';
}
///////////////////////// END MAIN GET PAGE /////////////////////////
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta property="fb:app_id" content="1145460445473337" />
        <meta itemprop="image" content="<?= $url_img_big ?>">
        <meta property="og:image" content="<?= $url_img_big ?>">

        <!-- fav icon -->

        <link rel="shortcut icon" href="<?= $temp_front; ?>favicon.png" type="image/x-icon">


        <?php if ($file == "car-details.php") { // start detailes files get tags & name & keyword     ?>
            <meta name="keywords" content="<?php
            if ($get_data['meta_tag'] != '') {
                echo clean_value($get_data['meta_tag']);
            } elseif ($get_data['intro'] != '') {
                echo clean_value($get_data['intro']);
            } else {
                echo clean_value($get_setting['key_word']);
            }
            ?>">
            <meta name="description" content="<?php
            if ($get_data['meta_desc'] != '') {
                echo clean_value($get_data['meta_desc']);
            } elseif ($get_data['intro'] != '') {
                echo clean_value($get_data['intro']);
            } else {
                echo clean_value($get_setting['key_desc']);
            }
            ?>">
            <meta property="og:title" content="<?= $get_setting['site_name'] ?>  |  <?php
            if (!empty($og_j['title'])) {
                echo clean_value($get_data['title']);
            } else {
                echo clean_value($get_data['name']);
            }
            ?>">
            <meta itemprop="description" content="<?php
            if ($get_data['meta_desc'] != '') {
                echo clean_value($get_data['meta_desc']);
            } elseif ($get_data['intro'] != '') {
                echo clean_value($get_data['intro']);
            } else {
                echo clean_value($get_setting['key_desc']);
            }
            ?>">
            <meta property="og:description" content="<?php
            if ($get_data['meta_desc'] != '') {
                echo clean_value($get_data['meta_desc']);
            } elseif ($get_data['intro'] != '') {
                echo clean_value($get_data['intro']);
            } else {
                echo clean_value($get_setting['key_desc']);
            }
            ?>">
            <meta property="og:url" content="<?php echo $url.'car-details.php?module='.$module.'&id='.$get_data['id']?>" />
            <title>
              <?php
                if (!empty($get_data['title'])) {
                    echo clean_value($get_data['title']);
                } else {
                    echo clean_value($get_data['name']);
                }
                ?> - <?= $get_setting['site_name'] ?>
            </title>

        <?php } elseif ($file == "cat.php") { ?>
            <meta name="keywords" content="<?php
            if (!empty($rows['meta_tag'])) {
                echo clean_value($rows['meta_tag']);
            } else {
                echo clean_value($get_setting['key_word']);
            }
            ?>">
            <meta name="description" content="<?php
            if (!empty($rows['meta_desc'])) {
                echo clean_value($rows['meta_desc']);
            } else {
                echo clean_value($get_setting['key_desc']);
            }
            ?>">
            <meta property="og:title" content="<?= $get_setting['site_name'] ?>  |  <?php
            if (!empty($rows['title'])) {
                echo clean_value($rows['title']);
            } else {
                echo get_lange($name, 'backend=1');
            }
            ?>">
            <meta itemprop="description" content="<?php
            if (!empty($rows['meta_desc'])) {
                echo clean_value($rows['meta_desc']);
            } else {
                echo clean_value($get_setting['key_desc']);
            }
            ?>">
            <meta property="og:description" content="<?php
            if (!empty($rows['meta_desc'])) {
                echo clean_value($rows['meta_desc']);
            } else {
                echo clean_value($get_setting['key_desc']);
            }
            ?>">

            <title>
                <?php
                if ($file == 'car-search.php' || $file == 'about.php') {
                    if (!empty($_GET['id_cat'])) {
                        if ($_SESSION['lang'] == "en"): echo $rows['name'];
                        else: echo $rows['name_ar'];
                        endif;
                    }else {
                        echo get_lange($name, 'backend=1');
                    }
                }
                ?> - <?= $get_setting['site_name'] ?>  </title>
<?php } else { ?>
            <meta name="keywords" content="<?php echo clean_value($get_setting['key_word']); ?>">
            <meta name="description" content="<?php echo clean_value($get_setting['key_desc']); ?>">
            <meta property="og:title" content="<?= $get_setting['site_name'] ?>  |  <?php echo clean_value($get_setting['key_desc']); ?>">
            <meta itemprop="description" content="<?php echo clean_value($get_setting['key_desc']); ?>">
            <meta property="og:description" content="<?php echo clean_value($get_setting['key_desc']); ?>">
            <title><?= $get_setting['site_name'] ?>    <?= $name ?> </title>
<?php } ?>
        
        <!--:::::::::::::::::::::: Header Links Here ::::::::::::::::::::::::::::::::-->
        <?php
//      require_once 'fbConfig.php';
        ?>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
        <link href="<?=$temp_front;?>css/bootstrap_ar.css" rel="stylesheet" type="text/css">
        <link href="<?=$temp_front;?>css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link href="<?=$temp_front;?>style.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?=$temp_front;?>css/rawaj.css" rel="stylesheet" type="text/css">
        <link href="<?=$temp_front;?>css/custom.css" rel="stylesheet" type="text/css">
        <link href="<?=$temp_front;?>css/bootstrap-tagsinput.css"  rel="stylesheet" type="text/css">
        <link href="<?=$temp_front;?>css/lightslider.min.css" type="text/css"  rel="stylesheet"/>
        <link href="<?=$temp_front;?>css/jquery-ui.css"  rel="stylesheet" type="text/css">
        <link href="<?=$temp_front;?>css/owl.carousel.min.css"  rel="stylesheet" type="text/css">
        <link href="<?=$temp_front;?>css/owl.theme.default.min.css"  rel="stylesheet" type="text/css">
        <link href="<?=$temp_front;?>css/jquery-ui.structure.css" rel="stylesheet" type="text/css">
        <link href="<?=$temp_front;?>css/jquery-ui.theme.css" rel="stylesheet" type="text/css">
        <link href="<?=$temp_front;?>css/lightslider_new.css" rel="stylesheet" type="text/css">
        <link href="<?=$temp_front;?>css/simplePagination.css" rel="stylesheet" type="text/css">
        <link href="<?=$temp_front;?>css/reset.min.css" rel="stylesheet" type="text/css">

        <?php if($file=='advertise.php'){?>
            <link href="vendors/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
            <link href="vendors/bootstrap-fileinput/css/fileinput-rtl.css" media="all" rel="stylesheet" type="text/css"/>
            <link href="vendors/bootstrap-fileinput/themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>
        <?php } ?>
  </head>

<body>
<span id="favorite_message"></span>


<script>

function updateCarPrice(resetPrice)
{
    if(resetPrice)
    {
        var cashElement = $('.cashPriceVal')[0];
        $(cashElement).val('');
        return;
    }
    var model = $('.model').val();
    var shape = $('.shape').val();
    var category = $('.category').val();
    var status = 1; //new cars

    var cashElement = $('.cashPriceVal')[0];
    if(model && shape && category)
    {
        $.ajax({
            type: "GET",
            data: {model: model, shape: shape, category: category, status: status},
            url: "<?=$url;?>ajax_cars.php?action=get_price",
            success: function(msg)
            {
                if(msg)
                {
                    var priceObj = JSON.parse(msg);
                    var price = priceObj.price;
                    $(cashElement).fadeOut();
                    $(cashElement).val(price).fadeIn();
                    $(cashElement).fadeIn();

                    $(cashElement).trigger('keyup');
                    
                }
                
            }
     });
    }
    else
    {
        $(cashElement).val('');
    }
}

 $(function() {
//   $("#loading").hide();

     $('.car_brand').change(function(e) {
     var car_brand = $(e.target).val();
     var data = {"car_brand":car_brand};
     $(".model" ).show();

     updateCarPrice(true);
     $.ajax({
     type: "GET",
     data: data,
     url: "<?=$url;?>ajax_cars.php?action=get_model",
     success: function(msg)
     {
     $(".model").fadeOut();
     $(".model").html(msg).fadeIn();
     $(".model").fadeIn();
     }
     });
     });

     $('.model').change(function(e) {
     var model = $(e.target).val();
     var data = {"model":model};
     $(".shape" ).show();
     updateCarPrice(true);

     $.ajax({
     type: "GET",
     data: data,
     url: "<?=$url;?>ajax_cars.php?action=get_cars_shape",
     success: function(msg)
     {
     $(".shape").fadeOut();
     $(".shape").html(msg).fadeIn();
     $(".shape").fadeIn();

      $(".category").fadeOut();
     $(".category").html('').fadeIn();
     $(".category").fadeIn();
     }
     });
     });

     $('.shape').change(function(e) {
     var shape = $(e.target).val();
     var model = $('.model')[0].value;

     var data = {"shape":shape, "model": model};
     $(".category" ).show();
     updateCarPrice(true);

     $.ajax({
     type: "GET",
     data: data,
     url: "<?=$url;?>ajax_cars.php?action=get_cars_category",
     success: function(msg)
     {
     $(".category").fadeOut();
     $(".category").html(msg).fadeIn();
     $(".category").fadeIn();
     }
     });
     });

     $('.category').change(function(e) {
         updateCarPrice();
     
     });


 });
</script>


<script>
  $(document).ready(function() { // start jquery code
     // start login code
      $("#header_login_btn").click(function() { // start check main log in form
       var username = $("#username").val();
       var password = $("#password").val();
       var remember =$("#remember").val();
       var data = {"username":username,"password":password,"remember":remember};
      $.ajax({
        type: "POST",
        data: data,
        url: "ajax_progress.php?action=log_in_action",
        success: function(msg)
        {
          $("#log_in_msg").html(msg).fadeIn("slow");//.delay(4000).fadeOut("slow");
        }
      });
  }); // end check main login

  $("#header_register_btn").click(function() { // start check main log in form

   var file_data = $('#user_img').prop('files')[0];
   var form_data = new FormData();
   form_data.append('user_img', file_data);
   var user_img=$("#user_img").val().replace(/.*(\/|\\)/, '');  // to remove fake path from  image
   var username_reg   =$("#username_reg").val();
   var reg_confirmpassword =$("#reg_confirmpassword").val();
   var email      =$("#email").val();
   var phonenumber=$("#phonenumber").val();
   var firstname  =$("#firstname").val();
   var lastname   =$("#lastname").val();
   //var user_img   =$("#user_img").val();

   var data = {"username_reg":username_reg,"reg_confirmpassword":reg_confirmpassword,"email":email,"phonenumber":phonenumber,"firstname":firstname,"lastname":lastname,"user_img":user_img};


  $.ajax({
    type: "POST",
    data: data,
    url: "ajax_progress.php?action=register_in_action",
    success: function(msg){
      $("#register_msg").html(msg).fadeIn("slow");
  //	$("#register_msg").slideup("slow");
    }

  });
  //url: "ajax_progress.php?action=register_in_action&img=insert_user_image",
  var user_id =$("#user_id").val();


   $.ajax({
        url: "ajax_progress.php?action=register_in_action_img",
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
   });

  }); // end check main login




  //:::::::::::::::::::::::::: start forgot password code
  //:::::::::::::::::::::::::: start forgot password code


    $("#forgot_password_btn").click(function() {
     var email = $("#email1").val();
      var data = {"email":email};
        $.ajax({
          type: "POST",
          data: data,
          url: "ajax_progress.php?action=forget_password_action",
          success: function(msg)
          {
            $("#forget_msg").html(msg).fadeIn("slow").delay(4000).fadeOut("slow");
          }
        });
    });




  });// end all jquery code

  </script>

  <section class="row login-popup">
    <div class="modal fade" id="register" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body clearfix">
            <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
            <div class="login-form">

              <span id="log_in_msg"></span>

                <form onsubmit="return false" class="form-wrap form-horizontal" id="loginForm"  method="post" >
                    <p class="message text-center"></p>
                    <h2 class="text-center"><?=get_lange("log_in","backend=0")?></h2>


                    <div class="form-group">
                        <label class="control-label required-field">اسم المستخدم</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label class="control-label required-field">كلمة السر</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                     <a data-toggle="modal" data-target="#forgot_password" href="#"> هل نسيت كلمه المرور ؟</a>
                      <button type="submit" class="btn btn-primary btn-block login_reg_btn" name="login" id="header_login_btn"  >
  <!--                  <a href="forgot-password.php" > هل نسيت كلمه المرور ؟</a>-->
  <!--                  <button type="submit" class="btn btn-block login_reg_btn" name="login" id="header_login_btn0000" >-->
                      <!-- <span class="glyphicon glyphicon-off"></span> -->دخول
                    </button>
                </form>

                <span id="register_msg"></span>

                <form onsubmit="return false" class="form-wrap form-horizontal" id="reqistrationForm"  method="post" enctype="multipart/form-data">
                    <span>او</span>
                    <div class="line"></div>
                    <p class="message text-center"></p>
                    <h2 class="text-center">اشترك معنا</h2>
                    <div class="form-group">
                        <label class="control-label">الاسم الاول</label>
                        <input type="text" class="form-control" name="firstname" id="firstname">
                    </div>
                    <div class="form-group">
                        <label class="control-label">اسم العائلة</label>
                        <input type="text" class="form-control"  name="lastname" id="lastname">
                    </div>

                    <div class="form-group">
                        <label class="control-label required-field">اسم المستخدم</label>
                        <input type="text" class="form-control" name="username_reg"  id="username_reg">
                    </div>

                    <div class="form-group">
                        <label class="control-label required-field">البريد الالكتروني</label>
                        <input type="text" class="form-control" name="email"  id="email">
                    </div>

                    <div class="form-group">
                        <label class="control-label required-field">رقم المحمول</label>
                        <input type="number" class="form-control" name="phonenumber" id="phonenumber" min="0">
                    </div>
                    <div class="form-group">
                        <label class="control-label required-field">كلمة السر</label>
                        <input type="password" class="form-control" name="reg_password" id="reg_password">
                    </div>
                    <div class="form-group">
                        <label class="control-label">اعادة كلمة السر</label>
                        <input type="password" class="form-control" name="reg_confirmpassword" id="reg_confirmpassword">
                    </div>
                    <div class="form-group">
                        <!--<label class="control-label">صورة الغلاف</label>-->
                        <input name="" type="button" class="choose_image btn btn-primary btn-xs" value="   اختر صورة الحساب   " />
                        <input type="file" class="" name="user_img" id="user_img" style="display:none;">
                    </div>
                    <button type="submit" class="btn btn-block" name="register" id="header_register_btn" >اشترك الان</button>

                    <input type="hidden" name="user_id" id="user_id" value="">


                  <!--  <span class="btn-round">أو</span> <a class="facebook login-btn" href="#">
                        <div class="fa fa-facebook btn-icon fb-icon"></div> تسجيل الدخول بواسطة الفيس بوك </a>-->
                </form>
            </div>
            <!-- end login -->
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="row forgot_password">
  <div class="modal fade" id="forgot_password" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body clearfix">
        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
        <h2 class="text-center dialog_action">التسجيل</h2>

        <span id="forget_msg"></span>

        <div class="login-form dialog_action">
          <label class="uppercase new-user"> لديك حساب <a data-toggle="modal" href="#login" aria-hidden="true" data-dismiss="modal">سجل دخولك هنا</a> </label>


          <form onsubmit="return false" id="forgot_pass_form" method="post"  enctype="multipart/form-data">
            <fieldset>

            <p>*البريد الإلكتروني
              <input name="email1" id="email1" type="email" class="form-control"   placeholder="البريد الالكترونى" >
            </p>

            <p>
              <input class="btn btn-block btn-lg" type="submit" value=" التسجيل" id="forgot_password_btn">
            </p>

            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
  </section>



  <header>
    <nav class="navbar top-navbar">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"> <img src="<?= $temp_front; ?>img/logo.png"> </a>
              </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
  <?php if(isset($_SESSION['user_id_front'])){ ?>


                    <li id="user_info">
                        <div class="dropdown"> <a class="btn btn-default dropdown-toggle profile-img check-user-session" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <img src="<?= $temp_front; ?>img/person.jpg" class="img-responsive" id="user_img"> <span class="status"></span> </a>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li class="dropdown-header" id="user_fl_name"></li>
                                <li><a href="user_profile.php/"><i class="fa fa-wrench"></i> الاعدادات</a></li>
                                <li><a href="user_logout.php"><i class="fa fa-sign-out"></i>									<?=get_lange("log_out","backend=1");?></a></li>
                            </ul>
                        </div>
                    </li>


                    <li><a href="my_advertise.php"><?=get_lange("my_advertise","backend=0");?></a></li>
                    <li><a href="user_profile.php"><?=get_lange("my_account","backend=0");?></a></li>
                    <li><a href="#" >كشف حساب</a></li>
                    <li><a href="user_logout.php" ><?=get_lange("log_out","backend=1");?></a></li>
  <?php } ?>

  <?php if(!isset($_SESSION['user_id_front'])){ ?>
    <li><a data-toggle="modal" data-target="#register"  href="#" id="login_btn"> <?=get_lange("log_in","backend=0");?></a></li>
  <?php } ?>



                    <li><a href="car-favorite.php" ><?=get_lange("favorite","backend=0");?></a></li>
                    <li><a href="car-compare.php" ><?=get_lange("comparison","backend=0");?></a></li>

                    <!--    <li class="dropdown"> <a href="#" class="dropdown-toggle check-user-session" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=get_lange("language","backend=0");?> <span class="caret"></span></a>
                              <ul class="dropdown-menu lang-dropdown">
                                    <li>
                                     <a href="?lang=ar" class="special-color">
                                       <img src="<?=$url?>helper/ip_files/flags/EG.gif" height="25" width="25">  العربية</a>
                                    </li>
                                    <li>
                                   <a href="?lang=en" class="special-color">
                                     <img src="<?=$url?>helper/ip_files/flags/US.gif" height="25" width="25">  English</a>
                                  </li>

                                </ul>
                      </li>--->




                  <!--  <li class="dropdown">
                      <a href="compare.php" class="dropdown-toggle check-user-session" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">مقارنة <span class="caret"></span></a>
                        <ul class="dropdown-menu lang-dropdown">
                        </ul>
                    </li>-->


                </ul>
            </div>
        </div>
    </nav>





                <nav class="navbar btm-navbar">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                            <ul class="nav navbar-nav">

                                <li id="menu-item-1718" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-1710 current_page_item menu-item-1718 <?=($file=='index.php')?'active':''?>"><a title="<?=get_lange("home","backend=0");?>" href="index.php" class="dropdown-toggle" data-scroll data-options="easing: easeOutQuart"><?=get_lange("home","backend=0");?></a>
                                </li>

                                <li id="menu-item-1760" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1760 <?=($file=='car-search.php' && $_GET['id_cat']==1)?'active':''?>"><a title="<?=get_lange("new_cars","backend=0");?>" href="car-search.php?module=cars&id_cat=1" class="dropdown-toggle" data-scroll data-options="easing: easeOutQuart"><?=get_lange("new_cars","backend=0");?></a>
                                </li>

                                <li id="menu-item-1761" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1761 <?=($file=='car-search.php' && $_GET['id_cat']==2)?'active':''?>"><a title="<?=get_lange("used_cars","backend=0");?>" href="car-search.php?module=cars&id_cat=2" class="dropdown-toggle" data-scroll data-options="easing: easeOutQuart"><?=get_lange("used_cars","backend=0");?></a>
                                </li>

                                <li id="menu-item-1721" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1721 <?=($file=='installment.php')?'active':''?>"><a title="<?=get_lange("installment_system","backend=1");?>" href="installment.php" class="dropdown-toggle" data-scroll data-options="easing: easeOutQuart"><?=get_lange("installment_system","backend=1");?></a>
                                </li>

                                <li id="menu-item-1742" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1742 <?=($file=='insurance.php')?'active':''?>"><a title="<?=get_lange("insurance_services","backend=0");?>" href="javascript:void(0)" class="dropdown-toggle" data-scroll data-options="easing: easeOutQuart"><?=get_lange("insurance_services","backend=0");?></a></li>

                                <li id="menu-item-1741" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1741 <?=($file=='advertise.php')?'active':''?>">

                                  <a <?=(empty($_SESSION['user_id_front']))? 'data-toggle="modal" data-target="#register"' : ''?> title="<?=get_lange("advertise_your_car","backend=0");?>" href="<?=(empty($_SESSION['user_id_front']))?'#':'advertise.php'?>" class="dropdown-toggle" data-scroll data-options="easing: easeOutQuart"><?=get_lange("advertise_your_car","backend=0");?>
                                  </a>
                                </li>



                                <li id="menu-item-1724" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-1724 dropdown">
                                  <a title="<?=get_lange("services_directory","backend=0");?>" href="#" data-toggle="dropdown" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false" data-scroll data-options="easing: easeOutQuart"><?=get_lange("services_directory","backend=0");?><span class="caret"></span>
                                  </a>
                                    <ul role="menu" class="dropdown-menu">
                                        <li id="menu-item-1725" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1725"><a title="خدمات1" href="#">خدمات1</a></li>
                                        <li id="menu-item-1726" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1726"><a title="خدمات 2" href="#">خدمات 2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <a href="#" class="call-panner"><img src="<?= $temp_front; ?>img/call.png"></a>



                    </div>
                </nav>


    <!-- calculator modal -->
    <!--<div class="modal fade" tabindex="-1" role="dialog" id="calculatorForm" style="text-align:right;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title">حساب قيمة التقسيط</h2>
          </div>
          <div class="modal-body">
            <form class="form-wrap" id="quick_calculator">
              <h4 class="text-center">سعر السيارة كاش <span id="cashPriceLabel" class="red-text"></span> ج.م</h4>
              <input value="" name="cashPriceVal" type="hidden" id="cashPriceVal" class="cashPriceVal"/>
               <div class="form-group">
                <label class="control-label">برامج التقسيط</label>
                <select name="installement_programs" id="installement_programs" class="form-control installement_programs">
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">الدفعة المقدمة</label>
                <input value="" name="mindownPayment" type="text" id="mindownPayment" size="2" maxlength="2" class="mindownPayment"/>
                % أي تساوي
                <input value="0" name="mindownPaymentInMoney" type="text" id="mindownPaymentInMoney" size="10" maxlength="10" class="mindownPaymentInMoney"/>
                 ج.م </div>
              <div class="form-group">
                <label class="control-label">عدد شهور الدفع</label>
                <select name="paymentMonths" id="paymentMonths" class="form-control paymentMonths">
                  <option value="12">12</option>
                  <option value="24">24</option>
                  <option value="36">36</option>
                  <option value="48">48</option>
                  <option value="60">60</option>
                </select>
              </div>
              <h4 class="text-center">قيمة القسط <span id="installmentLabel" class="red-text"></span> ج.م</h4>
              <a class="btn btn-primary" href="<?php //echo get_site_url(); ?>/installment/" id="requestButton">طلب تقسيط</a>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>- -->
    <!-- end of calculator modal -->
  </header>
