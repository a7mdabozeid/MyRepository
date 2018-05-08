<?php require(realpath(__DIR__ . '/header.php')); ?>

<script>
  /*$(document).ready(function(){
  // Show the Modal on load
  $("#myModal").modal("show");
  // Hide the Modal
  $("#myBtn").click(function(){
  $("#myModal").modal("hide");
  });
});*/
  </script>
    <!--    <div class="modal fade" id="myModal" role="dialog">
     <?php
        /*         echo'<div class="message-page">
                       <div class="col-sm-12">
                         <div class="box">
                         <div class="icon"><i class="fa fa-times-circle-o"></i></div><!-- End .icon -->
                         <h1>'.$email_valid.'</h1>
                         <p>'.get_lange('refresh','backend=0').'</p>
                       </div><!-- End .box -->
                    </div><!-- End .col-sm-12 -->
                  </div><!-- End .message-page -->';
            //    echo '<meta http-equiv="refresh" CONTENT="3;URL=signup.php">';
            */
              ?>
          </div>--->



<!-- taqseet calc section -->
<section class="taqseet-calc">
  <br>
  <br>
  <br>
  <div class="container">
    <img src="template/frontend/img/ads/banner_installement.png" alt="" class="img-responsive">
  </div>
</section>




<!-- start main valid of form -->
<section class="taqseet-calc">


<div id="exTab3" class="container">
    <ul  class="nav nav-pills">
		  <?php foreach(getdata('installment_system','where `active`=1','ORDER BY `id` ASC',10) AS $index=>$row){
        $installment_ids[]=$row->id;
      ?>
    	<li class="<?=($index==0)? 'active':'' ?> installment-<?=$row->id;?> ">
        <a  href="#installment-<?=$row->id;?>" data-toggle="tab"><?=($_SESSION['lang']=='en')? $row->name :$row->name_ar ?></a>
      </li>
      <?php } ?>
    </ul>

			<div class="tab-content clearfix">
        <?php foreach ($installment_ids as $value):
          $get_installment=select("*","installment_system","where `id`='$value' AND `active`=1 ");
          $name=$get_installment["name"];
          $name_ar=$get_installment["name_ar"];
        ?>
    	  <div class="tab-pane <?=($value==1)? 'active':'' ?>" id="installment-<?=$value;?>">

                  <script>
                      $(document).ready(function(){

                        $(".installment-1").trigger("click");

                          $(".installment-<?=$value?>").click(function(){
                              //alert("<?=$name_ar?>");
                         document.getElementById("installment_system_name").innerHTML="<?=($_SESSION['lang']=='en')? $get_installment['name'] : $get_installment['name_ar'] ?>";

                         document.getElementById("installment_system_desc").innerHTML="<?=($_SESSION['lang']=='en')? $get_installment['desc'] : $get_installment['desc_ar'] ?>";

                         $(".downPayment").val("<?=$get_installment['value']?>");

                         $(".cashPriceVal").trigger("keyup");


                          });
                      });
                </script>
        </div>

        <?php  endforeach; ?>

        <h2 id="installment_system_name"> </h2>

        <h3 id="installment_system_desc"> </h3>

          <form method="post" class="form-wrap form-horizontal" action="request.php">


            <div style="background:#fff;width:100%;padding:20px;float:left">
              <div class="form-group mrgn-15">
                <div class="col-sm-12 col-xs-12 no-padding">

                  <div class="col-md-2 col-xs-12">
                    <label class="control-label required-field">الماركة</label>
                    <select class="form-control car_brand" name="car_brand" >
                      <option value="0">اختر الماركة<?=get_lange('car_brand', 'backend=1')?></option>
                      <?php
                         $query = mysqli_query($db,"select * from `cars_brand` order by id ASC");
                         while ($row = mysqli_fetch_object($query)) {
                             echo '<option value="'.$row->id.'">'.$row->name_ar.'</option><br>';
                         } ?>
                    </select>
                 </div>

                  <div class="col-md-2 col-xs-12">
                    <label class="control-label required-field">الموديل</label>
                    <select class="form-control model" name="model"  >
                      <option value="0">اختر الموديل</option>
                    </select>
                  </div>

                  <div class="col-md-2 col-xs-12">
                    <label class="control-label required-field">الهيكل</label>
                    <select class="form-control shape" name="shape" >
                      <option value="0">اختر الهيكل</option>

                    </select>
                  </div>

                  <div class="col-md-2 col-xs-12">
                    <label class="control-label required-field">الفئة</label>
                    <select class="form-control category" name="category" >
                      <option value="0">اختر الفئة</option>
                    </select>
                  </div>


                </div>
              </div>


              <div class="form-group mrgn-15">
                <div class="col-sm-12 col-xs-12 no-padding">
                  <div class="col-md-2 col-xs-12">
                    <label class="control-label">السعر</label>
                    <input name="cashPriceVal" type="text" class="form-control cashPriceVal" placeholder="اجمالى الشراء" readonly>
                  </div>
                  <div class="col-md-2 col-xs-12">
                    <label class="control-label required-field">% الدفعة المقدمة</label>
                    <input value="40" name="downPayment" type="text" size="2" maxlength="2" class="form-control downPayment">
                  </div>
                  <div class="col-md-2 col-xs-12">
                    <label class="control-label"> أي تساوي ج.م</label>
                    <input name="mindownPaymentInMoney" type="text" class="form-control mindownPaymentInMoney" disabled="true">
                  </div>
                  <div class="col-md-2 col-xs-12">
                    <label class="control-label required-field">عدد شهور الدفع</label>
                    <select name="months_count" class="form-control months_count" >
                      <option value="12">12</option>
                      <option value="24">24</option>
                      <option value="36">36</option>
                      <option value="48">48</option>
                      <option value="60">60</option>
                    </select>
                  </div>
                  <div class="col-md-2 col-xs-12">
                    <label class="control-label"> قيمة القسط</label>
                    <input name="installment_monthly" type="text" class="form-control text-center red-text price" readonly="readonly">
                  </div>
                  <div class="col-md-2 col-xs-12">
                    <label class="control-label" style="color:#FFFFFF;"> الان</label>
                    <input class="btn btn-primary btn-lg center-block" type="submit" value="قسط الآن" name="submitCarForInstallment" id="submitCarForInstallment">
                    <input name="selectedCarId" id="selectedCarId" type="hidden" value="">
                  </div>
                </div>
              </div>
            </div>
          </form>



			</div>
  </div>
</section>
<?php require(realpath(__DIR__ . '/footer.php')); ?>
