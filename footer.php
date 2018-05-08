<!-- contact section -->
<!--<section class="contact">
    <div class="container">
        <div class="contact-form row">
            <h4>ابقى على تواصل معنا او ارسل لنا مرحبا</h4>
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="الاسم">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="الايميل">
                </div>
                <div class="form-group">
                    <textarea rows="5" class="form-control" placeholder="الرساله"></textarea>
                </div>
                <button type="submit" class="btn btn-block">ارسال</button>
            </div>
            <div class="col-xs-12 col-md-6 det">
                <h5>الفرع الرئيسى</h5>
                <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز </p>
                <h5>اتصل بنا</h5>
                <p>0123456789</p>
                <h5>الايميل</h5>
                <p>contact@rawaj.com</p>
            </div>
        </div>
    </div>
</section>-->

<!-- footer  -->







<footer>


<!--	<a href="#" class="call-pattern">
        <img src="<?=$temp_front;?>img/call2.png">
    </a>-->

    <div class="container">
    <!--    <div class="foot-det">
            <a href="#">
                <img src="<?=$temp_front;?>img/file-icon.png">
                <span><?=get_lange("your_online_form","backend=0");?></span>
            </a>
            <a href="#">
                <img src="<?=$temp_front;?>img/calc-icon.png">
                <span>   <?=get_lange("calculate_your_installment","backend=0");?></span>
            </a>
            <a href="#">
                <img src="<?=$temp_front;?>img/person-icon.png">
                <span><?=get_lange("Subscribe_with_us","backend=0");?></span>
            </a>
            <h4>اعلن عن سيارتك</h4>
        </div>-->




        <div class="row foot-map">
					<div class="col-xs-12 col-md-3">

								 </div>
            <div class="col-xs-12 col-md-4">
                <h3><p><?=get_topic_name(76,200);?></p></h3>
								<p><?=get_topic_desc(76,350);?></p>
            </div>
            <div class="col-xs-12 col-md-2">
                <!--<h3>الدعم</h3>-->
                <a href="#">نبذة عن رواج</a>
								<a href="contact-us.php">اتصل بنا</a>
								<a href="#">لماذا نحن؟</a>
							<a href="index.php">الصفحة الرئيسية </a>
            </div>
            <div class="col-xs-12 col-md-3">
                    <a href="<?=$get_setting['facebook'];?>" target="_blank"><img src="<?=$temp_front;?>img/facebook.png"></a>
                    <!--<li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>-->
            </div>
        </div>

<div class="Copyright">

<p >
 <?php $get_copyright=mysqli_fetch_object(mysqli_query($db,"SELECT * FROM `topic` where `id`=80 "));
     if($_SESSION['lang']=="en"){echo $get_copyright->desc;}else{echo $get_copyright->desc_ar;}
 ?>
</p>

		</div>
    </div>
    <img src="<?=$temp_front;?>img/foot-car.png" class="foot-car">
    <img src="<?=$temp_front;?>img/foot-logo.png" class="foot-logo">
</footer>

<!--<script src="<?=$temp_front;?>js/jquery-1.12.4.js"></script>-->
<!--<script src="<?=$temp_front;?>js/jquery-3.3.1.js"></script>-->
<script src="<?=$temp_front;?>js/bootstrap.min.js"></script>
<script src="<?=$temp_front;?>js/jquery.validate.min_1_16_0.js"></script>
<script src="<?=$temp_front;?>js/jquery-ui.js"></script>
<script src="<?=$temp_front;?>js/main.js"></script>

<?php if($file=='index.php'){?>
    <script src="<?=$temp_front;?>js/owl.carousel.min.js"></script>
    <script src="<?=$temp_front;?>js/home.js"></script>
<?php } ?>

<?php if($file=='car-search.php'){?>
    <script src="<?=$temp_front;?>js/jquery.sticky-sidebar.min.js"></script>
    <script src="<?=$temp_front;?>js/car-search.js"></script>
<?php } ?>

<?php if($file=='car-details.php'){?>
    <script src="<?=$temp_front;?>js/owl.carousel.min.js"></script>
    <script src="<?=$temp_front;?>js/owl.carousel2.thumbs.min.js"></script>
    <script src="<?=$temp_front;?>js/car-details.js"></script>
<?php } ?>


<?php if($file=='installment.php'){?>
    <script src="<?=$temp_front;?>js/installment.js"></script>
<?php } ?>

<?php if($file=='advertise.php'){?>

    <script src="vendors/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
    <script src="vendors/bootstrap-fileinput/themes/explorer-fa/theme.js" type="text/javascript"></script>
    <script src="vendors/bootstrap-fileinput/themes/fa/theme.js" type="text/javascript"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script> -->
    <script src="<?=$temp_front;?>js/advertise.js"></script>
<?php } ?>

<!-- Load this script only if Home page -->

<!-- <script src="<?=$temp_front;?>js/lightslider.js" type="text/javascript"></script>
<script src="<?=$temp_front;?>js/common.js" type="text/javascript"></script>
<script src="<?=$temp_front;?>js/calculator.js" type="text/javascript"></script>
<script src="<?=$temp_front;?>js/main.js" type="text/javascript"></script>
<script src="<?=$temp_front;?>js/bootstrap-tagsinput.js" type="text/javascript"></script> -->



<!-- <script src="<?=$temp_front;?>js/lightslider_new.js" type="text/javascript"></script> -->

</body>
</html>
