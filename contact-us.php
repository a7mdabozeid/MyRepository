<?php require(realpath(__DIR__ . '/header.php')); ?>
<style>
/*Contact sectiom*/
.section-content {
	text-align: center;
	border-bottom:1px solid #eee;
	margin-bottom:20px;
	padding:20px 0px;
	color:#00749b;
	font-weight:bold;
	font-size:30px
}
.section-content h3 {
	color:#00749b;
	font-weight:bold;
	font-size:30px
}
.contact-section .col-md-6 {
	width: 50%;
}
.form-line {
	border-left: 1px solid #eee;
}
.form-group {
	margin-top: 10px;
}
label {
	font-size: 1.3em;
	line-height: 1em;
	font-weight: normal;
}
.form-control {
	font-size: 15px;
	color: #080808;
}
textarea.form-control {
	height: 135px;/* margin-top: px;*/
}
.submit {
	font-size: 1.1em;
	float: right;
	width: auto;
	font-weight:bold;
	color: #fff;
}
.unl {
	border-bottom:1px solid #eee;
	padding:10px 0px!important; color:#00749b !important;
}
label{padding:10px 0px!important; color:#00749b !important; }
</style>
<link href="https://fonts.googleapis.com/css?family=Oleo+Script:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Teko:400,700" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
  <div class="section-content">
    <h3><?=get_lange("contact_us","backend=0");?></h3>
  </div>

	<form action="contact-us.php?action=contact" method="post" name="contact-from" id="contact-form">
    <div class="col-md-6 form-line">
      <h4 class="unl"><?=get_lange("address","backend=0");?> :</h4>
      <p> <?=$get_setting['address'];?></p>
        <p>Tel : 16546 </p>
      <h4 class="unl"><?=get_lange("our_location","backend=0");?>  :</h4>
        <?php $get_map=select("*","topic","where `id`=70");
		      echo $get_map['desc'];
		?> 
	  </div>

	<?php switch ($_GET['action']) {	default: ?>

    <div class="col-md-6 ">
      <div class="form-group">
        <label for="exampleInputUsername"><?=get_lange("name","backend=1");?></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="<?=get_lange("name","backend=1");?>*">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail"><?=get_lange("email","backend=1");?></label>
        <input type="email" class="form-control" id="email" name="email" placeholder="<?=get_lange("email","backend=1");?>*">
      </div>
      <div class="form-group">
        <label for="telephone"><?=get_lange("phone","backend=1");?></label>
        <input type="tel" class="form-control" id="phone" name="phone" placeholder="<?=get_lange("phone","backend=1");?>">
      </div>
      <div class="form-group">
        <label for ="description"> <?=get_lange("desc","backend=1");?></label>
        <textarea  class="form-control" name="message" id="message" placeholder="<?=get_lange("desc","backend=1");?>"></textarea>
      </div>
      <div>
        <button type="submit" name="submit" class="btn btn-primary submit">
					<i class="fa fa-paper-plane" aria-hidden="true"></i>
					<?=get_lange('send_message','backend=0');?>
				</button>
      </div>
    </div>
		<!--:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
		<!--:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->

	<?php   break;
	case(contact):
	$name   =$_POST['name'];
	$msg    =$_POST['message'];
	$email  =$_POST['email'];
	$mobile =$_POST['phone'];
	$pubtime=time();
	//::::::::::::::::::::::::::
	if(empty($name) || empty($email) || empty($msg) ){

	echo '<p style="text-align: center; font-size: 23px; color:#ea4335;"><i class="fa fa-exclamation"></i>'.get_lange('fill_conform','backend=1').'</p>';
	echo '<meta http-equiv="refresh" CONTENT="3;URL=contact-us.php">';

	}elseif(insert("contact","`body`='$msg',`name`='$name',`email`='$email',`mobile`='$mobile',`timeline`='$pubtime'" )){
	echo '<p style="text-align: center; font-size: 23px; color:#b8a330;">  تم تسجيل بياناتك بنجاح  </p>';
	}else{
	echo "some issues";
	}
	break;
	}
	?>

  </form>
</div>
<?php  include("footer.php"); ?>
