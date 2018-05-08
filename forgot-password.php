<?php require(realpath(__DIR__ . '/header.php'));
require (realpath(__DIR__ .'/libraries/passlib.php'));

if(isset($_SESSION['first_name']) && isset($_SESSION['user_id_front']) ){
  // echo'<h2>You are already logged '.$_SESSION['first_name'].'</h2>';
      echo'<div class="message-page">
             <div class="col-sm-12">
               <div class="box">
               <div class="icon"><i class="fa fa-check-circle-o"></i></div><!-- End .icon -->
               <h1>'.$_SESSION['first_name'].' '.get_lange('logged','backend=0').'</h1>
             </div><!-- End .box -->
          </div><!-- End .col-sm-12 -->
        </div><!-- End .message-page -->';
     echo '<meta http-equiv="refresh" CONTENT="5;URL=user_about.php">';
}else{ ?>
<script>
	$.validator.methods.equal = function(value, element, param) {
		return value == param;
	};
	$(document).ready(function() {
        $("#add_form").validate({
			 ignore: [],
		rules: {
        email1: {
            email: true,
            required:true,
            remote: { url:"valid/forget/mail.php",
					type : "get",
					data : { email1 : function() { return $("#email1").val();
				 },
				  } }
        }
			},
			messages: {
        email1: {
            required: 'Enter Your E-mail!',
            email:'Enter valid E-mail!',
            remote: '<b>ERROR :</b> There is no account registered associated with that email address. '
         }
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


  <div class="container">
    <div class="section-content">
      <h3>Forgot Password page<?=get_lange("forget_submit","backend=1");?></h3>
    </div>

    <?php
    switch($_GET['action']){
    default:
    ?>

  <form id="add_form" method="post" action="?action=submit">

    <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">

      <div class="row">
      <div class="col-sm-12">
        <h1 class="white-color wow fadeIn"> Forgot Password</h1>
       </div>
      </div>

      <span class="custom-space"></span>

     <div class="form-group" id="get_error">
      <!-- <label for="">E-mail adress</label>-->
       <input required="" type="email" class="form-control" id="email1" name="email1"  placeholder="type your E-mail adress">
     </div>
      <span id="get_error1"></span>
      <input type="hidden" id="ip_get" name="ip_get" value="<?=$_SERVER['REMOTE_ADDR']?>">
      <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
      <input type="submit" name="submit" value="Send " class="custom-btn big-btn btn-box red-bg white-hover wow fadeInDown" data-wow-delay="0.3s">
      </div>
      </div>
   </div>
  </form>
<?php
break;
case (submit):
$email1   = $_POST['email1'];
$ip_get   = $_POST['ip_get'];
$get_user = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM `members` WHERE `members`.`email`='$email1'"));
$id_user  = $get_user['id'];
$to       =$email1;
//::::::::::::::::::::::::::
@update("members","`confirm`='0'","where `id`='$id_user'");
//::::::::::::::::::::::::::::

$key_save =createRandomPassword();
$key_get =  $url.'change-password.php?key='.$key_save;
// عنوان الرسالة
$subject=' Forget password [RAWAJ]';

// الرساله مرسله من
$headers = 'From:YogiSwap@'.$_SERVER[HTTP_HOST]. "\r\n" .
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

if(mail($to,$subject,$message,$headers)){
    insert("user_temp","`user_id`='$id_user',`key`='$key_save',`ip_req`='$ip_get',`time`='". time() . "'");
    echo'<div class="message-page">
           <div class="col-sm-12">
             <div class="box">
             <div class="icon"><i class="fa fa-check-circle-o"></i></div><!-- End .icon -->
             <h1> A message with a recovery link has been sent to your email </h1>
            </div><!-- End .box -->
        </div><!-- End .col-sm-12 -->
      </div><!-- End .message-page -->';
    echo '<meta http-equiv="refresh" CONTENT="5;URL=index.php">';
}else{
    echo '<p class="text-warning"> There is a problem please try again</p>';
}
unset($to,$email,$subject,$subject,$sub,$headers,$message,$name,$email,$desc,$sentmail);
break;
}
?>
    </div>

<?php } require(realpath(__DIR__ .'/footer.php')); ?>
