<?php  require (realpath(__DIR__ .'/header.php'));
 require (realpath(__DIR__ .'/libraries/passlib.php'));
 $get_keys = $_GET['key'];
//echo $_SERVER['REMOTE_ADDR'];
///////////////////////////////////////////////////////////////////////////////
$user_temp_info= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM `user_temp` WHERE `key`='$get_keys' AND `geted`=0"));
$user_temp_info['key'];
$temp_id =$user_temp_info['user_id'];
$temp_ip =$user_temp_info['ip_req'];

////////////////
$get_confirm_value= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM `members` WHERE `members`.`id`='$temp_id'"));
$confirm   =$get_confirm_value['confirm'];
$member_ip =$get_confirm_value['ip'];

///////////////////////////////////////////////////////////////////////////////

if(isset($_SESSION['first_name']) && isset($_SESSION['user_id_front']) ){
   echo'<div class="message-page">
          <div class="col-sm-12">
            <div class="box">
            <div class="icon"><i class="fa fa-check-circle-o"></i></div><!-- End .icon -->
            <h1>'.$_SESSION['first_name'].' '.get_lange('logged','backend=0').'</h1>
          </div><!-- End .box -->
       </div><!-- End .col-sm-12 -->
     </div><!-- End .message-page -->';
  echo '<meta http-equiv="refresh" CONTENT="5;URL=user-profile.php">';


}elseif($confirm==1){

  echo' <div class="message-page">
         <div class="col-sm-12">
           <div class="box">
             <div class="icon"><i class="fa fa-times-circle-o"></i></div><!-- End .icon -->
                 <h1>Ops, The link has expired. <br>Please click  forgot password again if you still need to recover your password</h1>
                  </div><!-- End .box -->
              </div><!-- End .col-sm-12 -->
            </div><!-- End .message-page -->';
  echo '<meta http-equiv="refresh" CONTENT="5;URL=forgot-password.php">';

}else{

?>

<script>
	$.validator.methods.equal = function(value, element, param) {
		return value == param;
	};

	$(document).ready(function() {
  $("#confirm_password").validate({
			 ignore: [],
		rules: {
      password1: {
      required: true,
      minlength: 6,
      maxlength: 25
    },
      co_password: {
      required: true,
      minlength: 6,
      maxlength: 25,
      equalTo: "#password1"
    },

	},

	messages: {
              password1: {
              required: 'Enter your password',
              minlength:'your password must longer than 6 letters',
              maxlength:'your password must less 25 letters'
            },
              co_password: {
              required: 'Enter your confirm password',
              minlength:'your password must longer than 6 letters',
              maxlength:'your password must less 25 letters',
              equalTo:'password did not match'
              },
			},
			 	highlight: function(label) {
						$(label).addClass('error');
						$(label).fadeIn("slow");
					},
			success: function(label) {
           label.removeClass("error");
      	   label.addClass("success");
			},
		});
	});
</script>

<span class="custom-space-small"><!--important--></span>

<section class="other-pages-section c-cover h-auto section-block responsive-padding">
<div class="container">
<span class="custom-space"></span>

<div class="row">
<div class=" col-md-12">

               <?php
               switch($_GET['action']){
               default:
               ?>


               <form id="confirm_password" method="post" action="?action=submit">
                 <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">


                   <div class="row">
                   <div class="col-sm-12">
                     <h1 class="white-color wow fadeIn"> Reset Password</h1>
                    </div>
                   </div>

                  <span class="custom-space"></span>
                  <div class="form-group">
                    <input name="password1" id="password1" type="password" class="form-control"  placeholder="Password ">
                  </div>
                  <div class="form-group">
                    <input name="co_password" id="co_password" type="password" class="form-control" placeholder="Re-enter Password">
                  </div>

                  <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                      <input type="submit" name="submit" value="Save " class="custom-btn big-btn btn-box red-bg white-hover wow fadeInDown" data-wow-delay="0.3s">
                    </div>
                  </div>
                    <input type="hidden" id="ip_get" name="ip_get" value="<?=$_SERVER['REMOTE_ADDR']?>">
                    <input type="hidden" id="get_key" name="get_key" value="<?=$get_keys;?>">
                  </div>

            </form>
        <?php
           break;
           case (submit):

           $passwoord   =$_POST['password1'];
           $co_password =crypt_password($_POST['co_password']);
           $ip_get      =$_POST['ip_get'];
           $get_key     =$_POST['get_key'];

           $get_info= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM `user_temp` WHERE `user_temp`.`key`='$get_key' AND `user_temp`.`geted`=0"));
            $idre =$get_info['user_id'];

           $get_user= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM `members` WHERE `members`.`id`='$idre'"));

            $id_user = $get_user['id'];

           if(empty($passwoord) || empty($co_password)){

             echo'<div class="message-page">
                    <div class="col-sm-12">
                      <div class="box">
                      <div class="icon"><i class="fa fa-times-circle-o"></i></div><!-- End .icon -->
                      <h1>'.get_lange('type_password','backend=0').'!</h1>
                    </div><!-- End .box -->
                 </div><!-- End .col-sm-12 -->
               </div><!-- End .message-page -->';

           echo'<meta http-equiv="refresh" content="5; url=forgot-password.php"/>';


        }elseif($get_info['key'] != $get_key){

        echo'<div class="message-page">
               <div class="col-sm-12">
                 <div class="box">
                 <div class="icon"><i class="fa fa-times-circle-o"></i></div><!-- End .icon -->
                 <h1>'.get_lange('invaild_key','backend=0').'!</h1>
                </div><!-- End .box -->
            </div><!-- End .col-sm-12 -->
          </div><!-- End .message-page -->';
        echo'<meta http-equiv="refresh" content="5; url=forgot-password.php"/>';

      }elseif($get_info['ip_req'] !=$ip_get ){

          echo'<div class="message-page">
                 <div class="col-sm-12">
                   <div class="box">
                   <div class="icon"><i class="fa fa-times-circle-o"></i></div><!-- End .icon -->
                   <h1>'.get_lange('invaild_ip','backend=0').'!</h1>
                 </div><!-- End .box -->
              </div><!-- End .col-sm-12 -->
            </div><!-- End .message-page -->';
         echo'<meta http-equiv="refresh" content="5; url=forgot-password.php"/>';


        }elseif ($get_user['id'] != $get_info['user_id']) {

             echo '<p class="text-warning"><i class="fa fa-exclamation"></i>  There is a problem please try again</p>';
        }else{

             @update("members","`password`='$co_password'","where `id`='$id_user'");
    //    echo $get_key;
             @update("user_temp","`geted`=1","where `key`='$get_key'");

          echo' <div class="message-page">
              <div class="col-sm-12">
                <div class="box">
                  <div class="icon"><i class="fa fa-check-circle-o"></i></div><!-- End .icon -->
                      <h1>Your password has been changed successfully </h1>
                      </div><!-- End .box -->
                   </div><!-- End .col-sm-12 -->
                 </div><!-- End .message-page -->';
          echo '<meta http-equiv="refresh" CONTENT="5;URL=index.php">';

         }unset($to,$email,$subject,$subject,$sub,$headers,$message,$name,$passwoord,$co_password,$sentmail);
         break;
        }
       ?>
        </div>
      </div>
    </div>
  </section>
<?php }

@update("members","`confirm`='1'","where `id`='$temp_id'");

require(realpath(__DIR__ .'/footer.php')); ?>
