<?php

$action = $_REQUEST["action"];

if(empty($action))
{
  echo '<h3>Error: Cannot process request. Action is not specified';
  die();
}

include_once('car_functions.php');

switch($action)
{
  case 'get_model':
    $brandId = $_REQUEST['car_brand'];
    processGetModels($brandId);
    break;

  case 'get_cars_shape':
    $modelId = $_REQUEST['model'];
    processGetShapes($modelId);
  break;

  case 'get_cars_category':
    $shapeId = $_REQUEST['shape'];
    $modelId = array_key_exists('model', $_REQUEST)? $_REQUEST['model'] : null;
    processGetCategories($shapeId,$modelId);
    break;

  case 'get_price_limits':
    $catId = $_REQUEST['id_cat'];
    processGetPriceLimits($catId);
  break;

  case 'search_cars':
    $catId = intval($_REQUEST['id_cat']);
    processSearchCars($catId);
  break;

  case 'search_car_model':
    $brandId = $_REQUEST['car_brand_id'];
    processSearchModels($brandId);
    break;

  case 'get_price':
    $modelId = $_REQUEST['model'];
    $shapeId = $_REQUEST['shape'];
    $category = $_REQUEST['category'];
    $status = $_REQUEST['status'];
    processGetCarPrice($modelId, $shapeId, $category, $status);
    break;

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
