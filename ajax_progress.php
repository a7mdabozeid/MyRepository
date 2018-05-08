<?php

$action = $_REQUEST["action"];

//:::::::::::::::::::::::::register_in_action ::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::register_in_action ::::::::::::::::::::::::::::::::::
if ($_REQUEST['action'] == 'register_in_action') {
@session_start();
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');
//require (realpath(__DIR__ .'/libraries/passlib.php'));

$first_name  =clean_value($_POST['firstname']);
$last_name   =clean_value($_POST['lastname']);
$username    =clean_value($_POST['username_reg']);
$password    =crypt_password($_POST['reg_confirmpassword']);
$email       =clean_value($_POST['email']);
$phonenumber =$_POST['phonenumber'];
$ip          =$_SERVER['REMOTE_ADDR'];
$member_info =$_SERVER['HTTP_USER_AGENT'] ;
$key_save    =createRandomPassword();
//$key_get     =$url.'confirm_account.php?key='.$key_save;
$user_img =$_POST['user_img'];

 if(empty($username) || empty($password)) {
      	echo  get_lange('fill_conform','backend=1');
}else{
insert("members","`first_name`='$first_name',`last_name`='$last_name',`user_name`='$username',`password`='$password',`email`='$email',`phone`='$phonenumber',`time`='". time() . "',`lang`='$_SESSION[lang]',`member_info`='$member_info',`key`='$key_save',`ip`='$ip',`user_img`='$user_img',`active`=1,`confirm`=1 ");
//echo '<p style="color:red">'.get_lange('exits_error','backend=1').'</p>';
$user_id=mysqli_insert_id($db);
update("members","`user_img`='$user_img'","WHERE `id`='$user_id'");
echo '<p style="text-align: center; font-size: 18px; color:#28934F;">
<i class="fa fa-exclamation"></i>تم تسجيل بياناتك بنجاح برجاء تسجيل الدخول</p>';
?>
  <script>
      $(document).ready(function() {
      //  $("#loginForm").hide();
        $("#register").modal("show");
        $("#reqistrationForm").hide();
        $('#reqistrationForm')[0].reset();

       });
  </script>

<script>
	$(document).ready(function() {
    //$("#reqistrationForm").modal("show");
  //  $("#login-form").slideUp(2000);
    $("#register").modal("show");

    //$("#log_in_msg").removeClass('error_log_in');
    //$("#log_in_msg").addClass('suss_log_in');
});
</script>

<?php
  }
}

//:::::::::::::::::::::::::register_in_action_img ::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::register_in_action_img ::::::::::::::::::::::::::::::::::

else  if ($_REQUEST['action']=='register_in_action_img') { //register_in_action_img
  @session_start();
  require(realpath(__DIR__ . '/include/connect.php'));
  include_once realpath(__DIR__ . '/include/functions.php');
  $user_id =$_GET['user_id'];
  $user_img =$_FILES['user_img']['name'];
  move_uploaded_file($_FILES['user_img']['tmp_name'],'upload/user_img/'.$_FILES['user_img']['name']);
  //update("members","`user_img`='$user_img'","WHERE `id`='$user_id'");
}


//:::::::::::::::::::::::::::::::log_in_action :::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::::log_in_action :::::::::::::::::::::::::::::::::::::
else if ($_REQUEST['action'] =='log_in_action') { // start acion for fcheck username
@session_start();
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');
require (realpath(__DIR__ .'/libraries/passlib.php'));
  $username = clean_value($_POST['username']);
  $password = $_POST['password'];

if (empty($username) || empty($password)){
   	echo  '<p style="text-align: center; font-size: 18px; color:red;">'.get_lange('fill_conform','backend=1').'</p>';
}else{

        $get =mysqli_fetch_array(mysqli_query($db,"SELECT * FROM `members` WHERE `user_name`='$username'  "));
if($get['user_name'] ==$username && passwordverify($password,$get['password'])){   // start login user

          if($_POST['remember'] == "1"){
          setcookie('user_name',$get['user_name'], time()+7 * 24 * 60 * 60);
          setcookie('user_id_front',$get['id'], time()+7 * 24 * 60 * 60);
          setcookie('loginTime',date('H:i'), time()+7 * 24 * 60 * 60);
          }
          $_SESSION['user_name']     =$get['user_name'];
          $_SESSION['first_name']     =$get['first_name'];
          $_SESSION['user_id_front'] =$get['id'];
          echo '<p style="text-align: center; font-size: 15px; color:#28934F;"> مرحبا بك مرة اخرى '.$get['user_name'] .'</p>';
          echo '<p style="text-align: center; font-size: 15px; color:#28934F;">سوف يتم تحويلك الى الصفحه الشخصية</p>';

          ?>
        <script>
          $(document).ready(function() {
            setTimeout(function(){ window.location = "<?=$url?>user_profile.php"; }, 3000);
            $("#loginForm").hide();
            $("#reqistrationForm").hide();
         });
        </script>
<?php
}else{
?>
<script>
    $(document).ready(function() {
      $("#register").modal("show");
      $("#reqistrationForm").hide();

     });
</script>

<?php      echo  '<p style="text-align: center; font-size: 18px; color:red;">البيانات المدخلة غير صحيحه </p>';
}
} // end login suss
}// end check login

//:::::::::::::::::::::::::::::: forget_pass ::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::: forget_pass ::::::::::::::::::::::::::::::::::::::

else if ($_REQUEST['action'] == 'forget_password_action') { // start acion for forget password
 @session_start();
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');

$email1   = $_POST['email'];
$ip_get   =  array_key_exists('ip_get',$_POST)? $_POST['ip_get'] : null;
$get_user = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM `members` WHERE `members`.`email`='$email1'"));
$id_user  = $get_user['id'];
$to       =$email1;
//::::::::::::::::::::::::::
@update("members","`confirm`='0'","where `id`='$id_user'");
//::::::::::::::::::::::::::::

$key_save =createRandomPassword();
$key_get  =$url.'change-password.php?key='.$key_save;
// عنوان الرسالة
$subject  ='Forget password [RAWAJ]';

// الرساله مرسله من
$headers = 'From:@'.$_SERVER['HTTP_HOST']. "\r\n";
$headers .= "MIME-Version: 1.0 ";
$headers .= "htm dir=rtl ";
$headers .= "X-Mailer: PHP\n";
$headers .= "Content-type: text/html;charset=utf-8 \r\n";
$headers .= "(anti-spam-content-type: text/html;) charset=utf-8\r\n";
$message  = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
// رسالتك
$message.="
<div align='center'>
	<table border='1' width='74%' dir='ltr'>
		<tr>
			<td width='116'><b><font size='4'>your link is :</font></b></td>
			<td>&nbsp;$key_get</td>
		</tr>
	</table>
</div>";

if(empty($email1)){
//  echo'<h1 class="text-center"> برجاء إدخال البريد الإلكتروني بشكل صحيح</h1>';
?>
<script>
    $(document).ready(function() {
      // $("#loginForm").hide();
      $("#forgot_password").modal("show");
  //    $(".login-form").hide();

     });
</script>
<?php
}elseif(mail($to,$subject,$message,$headers)){
    insert("user_temp","`user_id`='$id_user',`key`='$key_save',`ip_req`='$ip_get',`time`='". time() . "'");
    echo'<h1 class="text-center">مرحبا'.$get_user['first_name'].'</h1>';
    echo'<h1 class="text-center">لقد تم ارسال لينك اعادة تعيين الباسورد الى بريدك الالكتروني </h1>';
    echo'<h1 class="text-center">'.$get_user['email'].'</h1>';
    echo '<meta http-equiv="refresh" CONTENT="6;URL=index.php">';
?>
<script>
    $(document).ready(function() {
      $(".dialog_action").hide();
      // $("#loginForm").hide();
      $("#forgot_password").modal("show");
      $('#forgot_pass_form')[0].reset();

     });
</script>
<?php
}else{
  echo '<p class="text-warning"> يوجد مشكلة برجاء المحاولة مره اخرى</p>';

?>
<script>
    $(document).ready(function() {
       $("#forgot_password").modal("show");

     });
</script>

<?php
}
unset($to,$email,$subject,$subject,$sub,$headers,$message,$name,$email,$desc,$sentmail);
}


//:::::::::::::::::::::::::::::: add_favorite ::::::::::::::::::::::::::::::::::::::

else if($_REQUEST['action'] =='add_favorite'){
@session_start();
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');
//////////////////////////////////////////////////
$user_id    = intval($_POST['user_id']);
$module     = $_POST['module'];
$id_content = intval($_POST['id_content']);
$ip_adress  = $_POST['ip_adress'];
$rate_value = intval($_POST['rate_value']);
$userinfo   = $_SERVER['HTTP_USER_AGENT'];
$name   = $_POST['name'];
$time       = time();
if($module=="favorite"){
  $msg="المفضلة";
}else {
  $msg="المقارنة";

}
$get_rate   = mysqli_num_rows(mysqli_query($db,"SELECT * FROM `rate` WHERE `module`='$module' AND `user_id`='$user_id' AND `id_content`='$id_content' AND `ip`='$ip_adress'"));
if($get_rate != 0):
  echo '<div class="alert alert-danger text-center" role="alert">
  تم إضافة
'.$name.'
الى قائمة '.$msg.' من قبل!

  </div>';
else:
 @insert("rate","`user_id`='$user_id',`module`='$module',`id_content`='$id_content',`ip`='$ip_adress',`rate`='$rate_value',`time`='$time',`information`='$userinfo'");
 echo '<div class="alert alert-success text-center">
 تم إضافة
        '.$name.'
   الى قائمة '. $msg.' بنجاح!

       </div>';
 //  echo get_lange('rate_suss','backend=0');
  endif;
}
//:::::::::::::::::::::::::::::::::::
/*
if($_REQUEST['action'] =='delete_favorite'){
@session_start();
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');

$name        =$_GET['name'];
$id_content  =$_GET['id_content'];
$user_id     =intval($_GET['user_id']);

$get_query =mysqli_query($db,"SELECT * FROM `rate` WHERE `id_content`='$id_content' AND `user_id`='$user_id'  ");
$get_blog =mysqli_fetch_object($get_query);
$user_id_content=$get_blog->id_content;

if(!empty($name)){

  if(delete("rate"," `id_content`='$user_id_content'")){
      echo '<p style="color:green">'.$name . ' UnFollow </p>';
  ?>
    <script>
      $(document).ready(function() {
        setTimeout(function(){ window.location = "<?=$url?>car-favorite.php"; },1000);
      });
    </script>
    <?php  }else {
          echo '<p style="color:red">'.get_lange('exits_error','backend=1').'</p>';
       }
    }else{ echo "there ara a problem!"; }
}

*/

//::::::::::::::::::::::::::::::: Get City :::::::::::::::::::::::::::::::::::::
//::::::::::::::::::::::::::::::: Get City :::::::::::::::::::::::::::::::::::::
else if ($_REQUEST['action'] == 'get_city') { // start acion for get_city
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');

if(isset($_GET['tribe_city']) && $_GET['tribe_city']==1){
  $where=" ";
}else{
  $where=" AND `active`=1";

}

$city =$_REQUEST['countries'];
$city = mysqli_query($db, "SELECT * FROM `eara` where `countries`='$city' AND `city`=0  $where ORDER BY `id` desc "); // get all active module
echo '<option value="0" disabled >Select City / State</option>';

$total=mysqli_num_rows($city);
if( $total > 0){
while ($row = mysqli_fetch_assoc($city)){
echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
}

}else{
  echo '<option value="0" disabled="" selected="" >Not Found City </option>';
 } exit();
}

//:::::::::::::::::::::::::::::: Get_Eara ::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::: Get_Eara ::::::::::::::::::::::::::::::::::::::

else if ($_REQUEST['action'] == 'get_eara') { // start acion for get_eara
 require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');
$eara =$_REQUEST['city'];
$city = mysqli_query($db, "SELECT * FROM `eara` where `city`='$eara' ORDER BY `id` desc"); // get all active module
   while ($row = mysqli_fetch_assoc($city)){
   echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
 } exit();
}

//:::::::::::::::::::::::::::::: forget_pass ::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::: forget_pass ::::::::::::::::::::::::::::::::::::::

else if ($_REQUEST['action'] == 'forget_password') { // start acion for forget password
@session_start();
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');

 $email1   =$_POST['email1'];
 $key_save =createRandomPassword();
 $key_get  =$url.'/get_pass.php?key='.$key_save;
 // عنوان الرسالة
 $subject='Forget password YogiSwap';

// الرساله مرسله من
$headers = "From:YogiSwap@no-replay \r\n" .
$headers .= "MIME-Version: 1.0 ";
$headers .= "htm dir=rtl ";
$headers .= "X-Mailer: PHP\n";
$headers .= "Content-type: text/html;charset=utf-8 \r\n";
$headers .= "(anti-spam-content-type: text/html;) charset=utf-8\r\n";
$message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";

$message.= '<div style="overflow:hidden;background:#f4f4f4">
            <div style="width:80%;margin:0 auto">';
$message.=" <div style='clear:both;background:#f1f1f1;padding:30px;text-align:center;-webkit-box-shadow:inset 0px 5px 5px #ccc;box-shadow:inset 0px 5px 5px #ccc;min-height:350px;overflow:hidden'>
 <h2 style='margin-top:0;color:#3389AE'>YogiSwap resete password ‏</h2> <div class='btn'>
<a href='$key_get' class='btn'>Click Here</a> </div> </div> </div></div> ";

$get_f_query =mysqli_query($db,"SELECT * FROM `members` WHERE `email`='$email1' AND `active`=1");
$get_f_user  =mysqli_fetch_object($get_f_query);
$id_user     =$get_f_user->id;
$to=$email1;
$time = time();

if(empty($email1)) {
  //echo get_lange('fill_conform','backend=1').'</p>';
}elseif(valid_email($email1) === false){
 //echo  get_lange('email_not_valid','backend=0').'</p>';
}elseif(mysqli_num_rows($get_f_query) == 0 ){
 //echo '<p class="text-center" style="color:red;">E-mail address not found</p>';
}elseif(mail($to,$subject,$message,$headers)){

insert("user_temp","`user_id`='$get_f_user->id',`key`='$key_save',`ip_req`='$_SERVER[REMOTE_ADDR]',`time`='$time',`geted`=0");
@update("members","`confirm`='0'","where `id`='$id_user'");
echo '<p style="color:#ff608b; text-align:center;"> WE sent you a message to your E-mail address </p>';
//echo '<meta http-equiv="refresh" CONTENT="4;URL='.$url.'">';
?>

  <script>
    $(document).ready(function() {
      $("#sl_up").hide(4000);
      $('#forget_password')[0].reset();
      //$(".action").prop('disabled', false).removeClass('disabled').attr("value", "Send" );
      setTimeout(function(){ window.location = "<?=$url?>"; }, 3000);
    });
  </script>

<?php }else{
   echo  get_lange('exit_error_forget','backend=0').'</p>';
   }
 }

//:::::::::::::::::::::::::::::: user wishlist ::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::: user wishlist ::::::::::::::::::::::::::::::::::::::

 else if ($_REQUEST['action'] == 'user_wishlist') {
 @session_start();
 require(realpath(__DIR__ . '/include/connect.php'));
 include_once realpath(__DIR__ . '/include/functions.php');

 $wishlist_country =array($_POST['wishlist_country']);
 $wishlist_city    =intval($_POST['city']);
 $user_id          =intval($_POST['user_id']);

 $get_query =mysqli_query($db,"SELECT * FROM `members` WHERE `id`='$user_id' AND `active`=1");
 $get_user  =mysqli_fetch_array($get_query);
 $user_id   =$get_user['id'];
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
   $wishlist_country=$get_user['wishlist_country'].','.$_POST['wishlist_country'];

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::



if(empty($wishlist_country)  ){
 echo '<p style="color:red">'.get_lange('fill_conform','backend=1').'</p>';
}else{
 $insert = mysqli_query($db,"update `members` set `wishlist_country`='$wishlist_country',`wishlist_city`='$wishlist_city' where `id`='$user_id'");
 if($insert){

 	echo '<br><p style="color:green">'.get_lange('updated_successfully','backend=0').'</p>';
?>

<script>
    $(document).ready(function() {
    setTimeout(function(){ window.location = "<?=$url?>user_wishlist.php"; },1000);
    });
</script>

<?php
 }else{
 	echo '<p style="color:red">'.get_lange('exits_error','backend=1').'</p>';
 }
}
 //exit();
}


//:::::::::::::::::::::::::::::: delete_wishlist ::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::: delete_wishlist ::::::::::::::::::::::::::::::::::::::

else if($_REQUEST['action'] =='delete_wishlist'){
@session_start();
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');

 $name     =$_GET['name'];
 $user_id  =intval($_GET['user_id']);

$get_query =mysqli_query($db,"SELECT * FROM `members` WHERE `id`='$user_id' AND `active`=1");
$get_user  =mysqli_fetch_object($get_query);
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::



     $deleted=$_REQUEST['del'];
    $sel=mysqli_fetch_array(mysqli_query($db,"SELECT wishlist_country FROM members WHERE id =".$user_id));
    @extract($sel);

    $muli=explode(',', $wishlist_country);
    if(($key = array_search($deleted, $muli)) !== false) {
        unset($muli[$key]);
    }
       $wishlist_country_new = implode(',', $muli);
      $update = mysqli_query($db,"update members set `wishlist_country`='$wishlist_country_new' where id=".$user_id);

      if($update){
           echo '<p style="color:green">Deleted successfuly</p>';
      ?>
      <script>
        $(document).ready(function() {
          setTimeout(function(){ window.location = "<?=$url?>user_wishlist.php"; },3000);
        });
      </script>
      <?php  }else {
          echo '<p style="color:red">'.get_lange('exits_error','backend=1').'</p>';
        }





 /*
if(!empty($name)){
  $update =mysqli_query($db,"update `members` SET `wishlist_country` ='0',`wishlist_city` ='0' WHERE `id`='$user_id' ");
      if($update){
           echo '<p style="color:green">Country and city was deleted successfuly</p>';
      ?>
      <script>
        $(document).ready(function() {
          setTimeout(function(){ window.location = "<?=$url?>user_wishlist.php"; },1000);
        });
      </script>
      <?php  }else {
          echo '<p style="color:red">'.get_lange('exits_error','backend=1').'</p>';
        }


  }else{echo "there ara a problem!";}
  */
}


//:::::::::::::::::::::::::::::: delete_gallery ::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::: delete_gallery ::::::::::::::::::::::::::::::::::::::

else if($_REQUEST['action'] =='delete_gallery'){
@session_start();
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');

$name     =$_GET['name'];
$image_id =$_GET['image_id'];
$user_id  =intval($_GET['user_id']);

$get_query =mysqli_query($db,"SELECT * FROM `gallery` WHERE `id`='$image_id' AND `user_id`='$user_id' AND`active`=1");
$get_image =mysqli_fetch_object($get_query);
$img_id=$get_image->id;

if(!empty($name)){

  @$files = select("`image`", "gallery", "WHERE `id`='$img_id'");
  @unlink(realpath(__DIR__ . "/upload/content/$files"));
  @unlink(realpath(__DIR__ . "/upload/content_thumbs/$files"));


  if(delete("gallery"," `id`='$img_id'")){
        echo '<p style="color:green">Image was deleted successfuly</p>';
  ?>
    <script>
      $(document).ready(function() {
        setTimeout(function(){ window.location = "<?=$url?>user_gallery.php"; },1000);
      });
    </script>
    <?php  }else {
          echo '<p style="color:red">'.get_lange('exits_error','backend=1').'</p>';
       }
    }else{echo "there ara a problem!";}
}

//:::::::::::::::::::::::::::::: delete_blog ::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::: delete_blog ::::::::::::::::::::::::::::::::::::::

else if($_REQUEST['action'] =='delete_blog'){
@session_start();
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');

$name     =$_GET['name'];
$blog_id  =$_GET['blog_id'];
$user_id  =intval($_GET['user_id']);

$get_query =mysqli_query($db,"SELECT * FROM `blog` WHERE `id`='$blog_id' AND `user_id`='$user_id' AND`active`=1");
$get_blog =mysqli_fetch_object($get_query);
$blog_id=$get_blog->id;

if(!empty($name)){
  @$files = select("`image`","blog", "WHERE `id`='$blog_id'");
  @unlink(realpath(__DIR__ . "/upload/content/$files"));
  @unlink(realpath(__DIR__ . "/upload/content_thumbs/$files"));

  if(delete("blog"," `id`='$blog_id'")){
      echo '<p style="color:green">blog was deleted successfuly</p>';
  ?>
    <script>
      $(document).ready(function() {
        setTimeout(function(){ window.location = "<?=$url?>user_blogs.php"; },1000);
      });
    </script>
    <?php  }else {
          echo '<p style="color:red">'.get_lange('exits_error','backend=1').'</p>';
       }
    }else{ echo "there ara a problem!"; }
}

//:::::::::::::::::::::::::::::: update_rate ::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::: update_rate ::::::::::::::::::::::::::::::::::::::

else if ($_REQUEST['action'] == 'update_rate') { // start acion for rate update
    @session_start();
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');
  //////////////////////////////////////////////////
$user_id    = intval($_POST['user_id']);
$module     = $_POST['module'];
$id_content = intval($_POST['id_content']);
$ip_adress  = $_POST['ip_adress'];
$rate_value = intval($_POST['rate_value']);
$userinfo   = $_SERVER['HTTP_USER_AGENT'] ;
$time       = time();
$get_rate   = mysqli_num_rows(mysqli_query($db,"SELECT * FROM `rate` WHERE `user_id`='$user_id' AND `id_content`='$id_content' AND `ip`='$ip_adress'"));
//echo $user_id.$module.$id_content.$rate_value;
if($get_rate != 0):
  echo get_lange('rate_agian','backend=0');
else:
  @insert("rate","`user_id`='$user_id',`module`='$module',`id_content`='$id_content',`ip`='$ip_adress',`rate`='$rate_value',`time`='$time',`information`='$userinfo'");
  //@insert("notifications","`user_id`='$user_id',`sender_id`='$user_id',`module`='member profile',`massage`='follow you',`time_send`='$time'");
  //$get_n_set= mysqli_fetch_array(mysqli_query($db,"select * from `notifications_setting` where `lang`='ar'"));
  echo get_lange('rate_suss','backend=0');
  endif;
  exit();
}// end rate update

//:::::::::::::::::::::::::::::: comments ::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::: comments ::::::::::::::::::::::::::::::::::::::

else if ($_REQUEST['action'] == 'comments') { // start acion for rate update
@session_start();
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    $name       =clean_value($_GET['name_comment']);
    $email      =$_GET['email_comment'];
    $message    =$_GET['comment_area'];
    $id_content =intval($_GET['id_content']);
    $ip_adress  =clean_value($_GET['ip_adress']);
    $module     =clean_value($_GET['module']);
    $id_comment =$_GET['id_comment'];
    $user_id    =intval($_GET['user_id']);
    $userinfo   =$_SERVER['HTTP_USER_AGENT'] ;

    if (empty($_GET['comment_area'])){ // start main check
        echo get_lange('name_fill','backend=1').'';
    }elseif(valid_email($email) === false){ // check email
        echo '<i class="fa fa-exclamation"></i> Email is valid ';
    }else{ // start check if this is replay

    if(insert("comments","`user_id`='$user_id',`name`='$name',`email`='$email',`body`='$message',`ip`='$ip_adress',`user_info`='$userinfo',`id_content`='$id_content',`module`='$module',`pubtime`='". time() . "',`lang`='$_SESSION[lang]',`active`='1'")){
    echo 'comment was inserted';
?>
<script>
$(function() {
//  $("#comment_area").attr("textarea", "");
  $('.comment')[0].reset();
  $('.comment_message').hide(3000);
});
   $(document).ready(function() {
  //  setTimeout(function(){ window.location = "<?=$url?>gallery.php"; },2000);
  });
</script>
<?php
      }else{
          echo 'please try again ';
        }
 }

 exit();
}// end rate update


//:::::::::::::::::::::::::::::: delete_favourite ::::::::::::::::::::::::::::::::::::::
//:::::::::::::::::::::::::::::: delete_favourite ::::::::::::::::::::::::::::::::::::::

else if($_REQUEST['action'] =='delete_favourite'){
@session_start();
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');

$name        =$_GET['name'];
$id_content  =$_GET['id_content'];
$user_id     =intval($_GET['user_id']);

$get_query =mysqli_query($db,"SELECT * FROM `rate` WHERE `id_content`='$id_content' AND `user_id`='$user_id'  ");
$get_blog =mysqli_fetch_object($get_query);
$user_id_content=$get_blog->id_content;

if(!empty($name)){

  if(delete("rate"," `id_content`='$user_id_content'")){
      echo '<p style="color:green">'.$name . ' UnFollow </p>';
  ?>
    <script>
      $(document).ready(function() {
        setTimeout(function(){ window.location = "<?=$url?>user_favourite.php"; },1000);
      });
    </script>
    <?php  }else {
          echo '<p style="color:red">'.get_lange('exits_error','backend=1').'</p>';
       }
    }else{ echo "there ara a problem!"; }
}





















































if ($_REQUEST['action'] == 'add_maillist') {
@session_start();
require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');
$get_setting = mysqli_fetch_object(mysqli_query($db,"SELECT * FROM `maillist_setting` WHERE lang='$_SESSION[lang]'"));

$email1      =clean_value($_REQUEST['email1']);
$countries   =$_REQUEST['countries'];
$eara_level  =$_REQUEST['eara_level'];
$city        =$_REQUEST['city'];
$module      = array();
$module      =$_REQUEST['module'];
$module      =  implode(',',$_REQUEST['module']);
$tab         ='maillist';
if(empty($email1)){
    echo '<p style="color:red">'.get_lange('fill_conform','backend=1').'</p>';
}elseif(valid_email($email1) === false){
    echo '<p style="color:red">'.get_lange('email_valid','backend=1').'</p>';
}elseif(mysqli_fetch_array(mysqli_query($db," select `email` from `maillist` where `email`='$email1'"))){
    echo '<p style="color:red">'.get_lange('email_exites','backend=0').'</p>';
}elseif(empty($countries)){
	echo '<p style="color:red">'.get_lange('sel_countrie','backend=0').'</p>';
}else{
	$allcity= $countries.','.$eara_level.','.$city;
$insert = mysqli_query($db,"insert `maillist` set `name`='$email1',`email`='$email1',`name`='$email1',`city`='$allcity',`interest`='$module',`id_cat`='$get_setting->defult_group'");
if($insert){
	echo '<p style="color:green">'.get_lange('add_mail_sus','backend=0').'</p>';
	?>
      <meta http-equiv="refresh" CONTENT="4;URL=<?=$url?>">
	<?php
}else{
	echo '<p style="color:red"> '.get_lange('exits_error','backend=1').'</p>';
}
}

exit();
}

if ($_REQUEST['action'] == 'add_maillist_sing') {
  @session_start();
 require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');
$get_setting = mysqli_fetch_object(mysqli_query($db,"SELECT * FROM `maillist_setting` WHERE lang='$_SESSION[lang]'"));

 $email1 =clean_value($_POST['email12']);
$tab ='maillist';
if(empty($email1)){
echo '<p style="color:red">'.get_lange('fill_conform','backend=1').'</p>';
}elseif(valid_email($email1) === false){
echo '<p style="color:red">'.get_lange('email_valid','backend=1').'</p>';
}elseif(mysqli_fetch_array(mysqli_query($db," select `email` from `maillist` where `email`='$email1'"))){
echo '<p style="color:red">'.get_lange('email_exites','backend=0').'</p>';
}else{
$insert = mysqli_query($db,"insert `maillist` set `name`='$email1',`email`='$email1',`id_cat`='$get_setting->defult_group'");
if($insert){
	echo '<p style="color:green">'.get_lange('add_mail_sus','backend=0').'</p>';
	?>
  <script>
$(function() {
$('#add_maillist')[0].reset();
$('#form_maillist1').hide(3000);
});
</script>
	<?php
}else{
	echo '<p style="color:red"> '.get_lange('exits_error','backend=1').'</p>';
}
}

exit();
}



if ($_REQUEST['action'] == 'update_poll') { // start acion for update poll
 require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');
include_once realpath(__DIR__ . '/include/change_lang.php');
	//////////////////////////////////////////////////
$option_poll   = intval($_POST['option_poll']);
$id_poller     = intval($_POST['id_poller']);

@update("poller_option","`poller_rank`=poller_rank + 1","WHERE ID = $option_poll");

@$sel_total = mysqli_fetch_array(mysqli_query($db,"SELECT sum(poller_rank) as `total` FROM `poller_option` WHERE `pollerID`= $id_poller "));
$total = $sel_total['total'];

?>

	<div id="poller">
	<h3><?=$sel['pollerTitle']?></h3>
	<?php

	@$sel_option = mysqli_query($db,"select * from poller_option where pollerID='$id_poller' order by ID") ;	//
	while($poll_options = mysqli_fetch_array($sel_option)){
	@$pollerOrder   = round ($poll_options['poller_rank'] / $total * 100);
	@$pollerOrder_w = round ($poll_options['poller_rank'] / $total * 100)/2;
	?>

		<h4><?=$poll_options['optionText']?></h4>

		<div class="option_r_m" style="background-color: red ! important;height: 15px;width: <?=$pollerOrder_w?>px;"></div>


	<?php }

   echo get_lange('total','backend=0').':'.$total;
	exit();
}






if ($_REQUEST['action'] == 'check_user_name') { // start acion for fcheck username
	  @session_start();
 require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');

	//////////////////////////////////////////////////
$user_name   = clean_value($_POST['user_name']);
if(empty($user_name)){
    ?>
<script>
$(document).ready(function() {
$("#name_check").addClass('has-error');
$("#user_error1").html('<i class="fa fa-exclamation"></i>User Name is requerd');

});
</script>

<?php


}elseif(mysqli_fetch_array(mysqli_query($db,"SELECT * FROM members where user_name = '$user_name'")) == FALSE){
    ?>
<script>
$(document).ready(function() {
$("#name_check").addClass('has-error');
$("#user_error1").html('<i class="fa fa-exclamation"></i>User Name is incorrect');

});
</script>

<?php

}else{
    ?>
<script>
$(document).ready(function() {
$("#name_check").removeClass('has-error');
$("#name_check").addClass('has-success');
//$("#user_error1").html('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true" style="right:3%;top:32%;"></span><span id="inputSuccess3Status" class="sr-only">(success)</span>Ok');

});
</script>

<?php }
exit();
}// end check username






if ($_REQUEST['action'] == 'show_video') { // start acion for   show_video
    @session_start();
 require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');

$id_content=$_REQUEST['id'];
$get = mysqli_fetch_object(mysqli_query($db,"select * from `media` where `id`='$id_content'"));


//echo $get->name;
if(!empty($get->image)):
$imagesrc='./upload/content/'.$get->image;
else:
$imagesrc='template/frontend/images/video-player.jpg';
endif;

$src= './upload/media/'.$get->upload;

?>
    <script src="<?= $temp_front;?>js/swfobject.js"></script>
    <div id="flashcontent">
                  <strong>You need to upgrade your Flash Player to version 9 or newer.</strong>
                       </div>
            <script type="text/javascript">

              var so = new SWFObject("flvPlayer.swf?imagePath=<?=$imagesrc?>&videoPath=<?=$src?>&autoStart=false&autoHide=false&autoHideTime=5&hideLogo=true&volAudio=60&newWidth=591&newHeight=267&disableMiddleButton=false&playSounds=true&soundBarColor=0x0066FF&barColor=0x0066FF&barShadowColor=0x91BBFB&subbarColor=0xffffff", "sotester", "100%", "95%", "9", "#efefef");
              so.addParam("allowFullScreen", "true");
              so.write("flashcontent");

          </script>
<?php
exit();
}// end check show_video show_video

if ($_REQUEST['action'] == 'download_files') { // start acion for   dwonload files
    @session_start();
 require(realpath(__DIR__ . '/include/connect.php'));
include_once realpath(__DIR__ . '/include/functions.php');

$id_content=$_REQUEST['id'];
$get = mysqli_fetch_object(mysqli_query($db,"select * from `files` where `id`='$id_content'"));

if(!empty($get->upload)):
@header('location:upload/files/' . $get->upload);
 else:
echo 'الملف غير موجود';
  endif;
exit();
}// end check   dwonload files




if ($_REQUEST['action'] == 'update_banner') { // start acion for  update_banner
    @session_start();
 require(realpath(__DIR__ . '/include/connect.php'));
  //////////////////////////////////////////////////
$id_banner     = intval($_REQUEST['id_banner']);
echo $id_banner;
@mysqli_query($db,"update `banners` SET `clicks` =clicks + 1 WHERE `id` ='$id_banner'");
exit();
}// end update_banner update
