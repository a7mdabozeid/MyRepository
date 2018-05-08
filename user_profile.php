<?php require(realpath(__DIR__ . '/header.php'));
 $id   = intval($_GET['id']);////id
 
if(empty($_SESSION['user_name']) /*&& empty($_SESSION['userid'])*/ ){
//header('Location: index.php');
echo'<div class="message-page">
       <div class="col-sm-12">
         <div class="box">
         <div class="icon"><i class="fa fa-times-circle-o"></i></div><!-- End .icon -->
         <h1>'.get_lange('not_logged','backend=0').'</h1>
       </div><!-- End .box -->
    </div><!-- End .col-sm-12 -->
  </div><!-- End .message-page -->';
echo '<meta http-equiv="refresh" CONTENT="3;URL=index.php">';
//exit();
}

$use=$_SESSION['user_name'];
$row=mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM members where `user_name`='$use' AND `active`=1")) ;
$idr=$row['id'];


if (!$_SESSION['user_name']){
exit();
}

if ($row['user_name']!=$_SESSION['user_name']){
 echo'<div class="message-page">
        <div class="col-sm-12">
          <div class="box">
          <div class="icon"><i class="fa fa-times-circle-o"></i></div><!-- End .icon -->
          <h1>'.get_lange('not_logged','backend=0').'</h1>
        </div><!-- End .box -->
     </div><!-- End .col-sm-12 -->
   </div><!-- End .message-page -->';
echo '<meta http-equiv="refresh" CONTENT="3;URL=index.php">';

}else{

  $user_id=$_SESSION['user_id_front'];

if($res = mysqli_fetch_object(mysqli_query($db,"SELECT * FROM members WHERE `id`='$user_id' AND `active`=1"))){

  if (empty($res->image)){
         $src=$temp_front."/images/user.png";
         }
  else if(file_exists("upload/content/".$res->image))
         {
         $src="upload/content/".$res->image;
         }
  else    {
         $src="upload/content_thumbs/".$res->image;
         }
?>

  
  <h5 class="text-center""><?=get_lange('wel_come','backend=1')?>:</h5>
  <h1 class="text-center"><?=ucwords($res->first_name).''.ucwords($res->last_name);?></h1>
	  

<?php }else{echo'<div class="message-page">
       <div class="col-sm-12">
         <div class="box">
         <div class="icon"><i class="fa fa-times-circle-o"></i></div><!-- End .icon -->
         <h1>Sorry, User not found!</h1>
         <p></p>
       </div><!-- End .box -->
    </div><!-- End .col-sm-12 -->
  </div><!-- End .message-page -->';}  } include_once('footer.php'); ?>
