<?php require(realpath(__DIR__ . '/header.php')); //error_reporting(0);
 if(!isset($_SESSION['user_name']) ){
  echo '<h1 class="text-center">برجاء تسجيل الدخول لتتمكن من نشر سيارتك سوف يتم تحويلك الان</h1>';
  echo '<meta http-equiv="refresh" CONTENT="3;URL=index.php">';
}else{
    $user_name=$_SESSION['user_name'];
  $user_id_front=$_SESSION['user_id_front'];
  $res= mysqli_fetch_object(mysqli_query($db,"SELECT * FROM `members` WHERE `user_name`='$user_name' AND `id`='$user_id_front' AND `active`=1"));
?>
<section>
  <div class="container">
    <div class="Add-car-advs">

      <?php switch ($_GET['action']) {	default: ?>

      <form action="advertise.php?action=add_used_car" method="post" enctype="multipart/form-data" class="form-wrap form-horizontal">
        <div class="row">
          <!-- Form Title -->
          <div class="col-xs-12">
            <h4> إعلن عن سيارتك</h4>
          </div>
          <!-- Form Title -->
          <!--  -->
          <!--  -->
          <!-- Section Title -->
          <div class="col-xs-12">
            <div class="section-header">بيانات الاتصال</div>
          </div>
          <!-- Section Title -->

          <div class="col-xs-6">
            <div class="row form-row">
              <div class="col-xs-4">
                <label class="control-label colored"> الاسم </label>
              </div>
              <div class="col-xs-8">
                <input type="text" name="name" class="form-control" value="<?=$res->first_name.' '.$res->last_name?>"/>
              </div>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="row form-row">
              <div class="col-xs-4">
                <label class="control-label colored"> البريد الإلكتروني </label>
              </div>
              <div class="col-xs-8">
                <input name="email" type="text" class="form-control" value="<?=$res->email?>" />
              </div>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="row form-row">
              <div class="col-xs-4">
                <label class="control-label colored"> رقم الهاتف </label>
              </div>
              <div class="col-xs-8">
                <input name="phone"  id="loggeduser_mobile" type="number" class="form-control" value="<?=$res->phone?>"/>
              </div>
            </div>
          </div>

          <!-- Section Title -->
          <div class="col-xs-12">
            <div class="section-header">بيانات السيارة</div>
          </div>
          <!-- Section Title -->

          <div class="col-xs-6">
            <div class="row form-row">
              <div class="col-xs-4">
                <label class="control-label colored"> الماركة </label>
              </div>
              <div class="col-xs-8">
                <select class="form-control car_brand" name="car_brand" >
                  <option value="0">اختر الماركة<?=get_lange('car_brand', 'backend=1')?></option>
                  <?php
                     $query = mysqli_query($db,"select * from `cars_brand` order by id ASC");
                     while ($row = mysqli_fetch_object($query)) {
                         echo '<option value="'.$row->id.'">'.$row->name_ar.'</option><br>';
                     } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="row form-row">
              <div class="col-xs-4">
                <label class="control-label colored"> الموديل </label>
              </div>
              <div class="col-xs-8">
                <select class="form-control model" name="model">
                  <option value="">اختر الموديل</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="row form-row">
              <div class="col-xs-4">
                <label class="control-label colored"> الشكل </label>
              </div>
              <div class="col-xs-8">
                <select class="form-control shape" name="shape">
                  <option value="0">اختر الشكل</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="row form-row">
              <div class="col-xs-4">
                <label class="control-label colored"> الفئة </label>
              </div>
              <div class="col-xs-8">
                <select class="form-control category" name="category">
                  <option value="0">اختر الفئة</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="row form-row">
              <div class="col-xs-4">
                <label class="control-label colored"> السعر </label>
              </div>
              <div class="col-xs-8">
                <input type="number" class="form-control" placeholder=""  name="price">
              </div>
            </div>
          </div>


          <style>
          .ui-datepicker-calendar { display: none; }
          .ui-datepicker-month{ display: none; }
          .ui-datepicker-current{ display: none; }
          </style>
          <script>
          $(function(){
              $("#manufactor_year").datepicker({
                  dateFormat: 'yy',
                  changeMonth: true,
                  changeYear: true,
                  yearRange: "1950:2019",
                  showButtonPanel: true,
                  onClose: function(dateText, inst) {
                  //    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                      var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                      $(this).val($.datepicker.formatDate('yy', new Date(year, 1)));
                  }
              });
          });
          </script>

          <div class="col-xs-6">
            <div class="row form-row">
              <div class="col-xs-4">
                <label class="control-label colored"> سنة الصنع </label>
              </div>
              <div class="col-xs-8">
                <input id="manufactor_year" name="manufactor_year" type="text"  class="form-control datepickerselect">
              </div>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="row form-row">
              <div class="col-xs-4">
                <label class="control-label colored"> السعة اللترية </label>
              </div>
              <div class="col-xs-8">
                <input type="text" class="form-control"   id="cc" name="cc" />
              </div>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="row form-row">
              <div class="col-xs-4">
                <label class="control-label colored"> العداد / كيلو متر </label>
              </div>
              <div class="col-xs-8">
                <input type="text" class="form-control" placeholder="" id="km" name="km" />
              </div>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="row form-row">
              <div class="col-xs-2">
                <label class="control-label colored"> مكان المعاينة </label>
              </div>
              <div class="col-xs-10">
                <input type="text" class="form-control" placeholder="" id="place" name="place">
              </div>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="row form-row">
              <div class="col-xs-2">
                <label class="control-label colored"> ملاحظات </label>
              </div>
              <div class="col-xs-10">
                <textarea cols="20" rows="5" class="form-control"  name="notes"></textarea>
              </div>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="row form-row">
              <div class="col-xs-2">
                <label class="control-label colored"> الصور </label>
              </div>
              <div class="col-xs-10">
                <form enctype="multipart/form-data">
                  <div class="file-loading">
                      <input id="car-image-upload" name="advertise_image[]" type="file" multiple="multiple">
                  </div>
                  <br>

                <!--  <button type="submit" class="btn btn-primary">Submit</button>-->
                  <button type="reset" class="btn btn-default">Reset</button>
                </form>
              </div>
              <div class="col-xs-2">&nbsp;</div>
              <div class="col-xs-10 sub-form-note">
                <p>يمكنك اضافة ٨ صور بحد اقصي</p>
              </div>
            </div>
          </div>


          <div class="col-xs-12">
            <div class="row form-row">
              <div class="col-xs-2">
                <label class="control-label colored right-aligned"> المواصفات الأساسية </label>
              </div>
              <div class="col-xs-10">
                <div class="row form-row">
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox"  name="power_steering" value="1" uncheked="uncheked">
                      باور ستيرنج
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox"  name="electric_front_window" value="1" uncheked="uncheked" >
                      زجاج كهربائي
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox"  name="airbags" value="1" uncheked="uncheked" >
                      وسائد هوائية
                    </label>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="back_parking_sensor" value="1" uncheked="uncheked">
                      حساسات للركن
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="electric_join_mirror" value="1" uncheked="uncheked">
                      مرايا ضم كهرباء
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="electric_mirror" value="1" uncheked="uncheked">
                      مرايات كهرباء
                    </label>
                  </div>
                </div>


                <div class="row form-row">
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="panorama_roof" value="1" uncheked="uncheked">
                      سقف بانوراما
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="sunroof" value="1" uncheked="uncheked">
                      فتحة سقف
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="multi_function_wheel" value="1" uncheked="uncheked">
                      طارة مالتى فانكشن
                    </label>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="cruise_control" value="1" uncheked="uncheked">
                      مثبت سرعة
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="abs" value="1" uncheked="uncheked">
                      فرامل ABS
                    </label>
                  </div>
                </div>



              </div>
            </div>
          </div>

          <div class="col-xs-12">
            <div class="row form-row">
              <div class="col-xs-2">
                <label class="control-label colored right-aligned"> الإضافات </label>
              </div>
              <div class="col-xs-10">

                <div class="row form-row">
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="xenon_lamps" value="1" uncheked="uncheked">
                      فوانيس زينون
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="back_camera" value="1" uncheked="uncheked">
                      كاميرا رؤية خلفية
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="leather_dressing" value="1" uncheked="uncheked">
                      فرش جلد
                    </label>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="front_led_lamps" value="1" uncheked="uncheked">
                      إضاءة ال اي دي
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="front_parking_sensor" value="1" uncheked="uncheked">
                      حساسات للركن
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="back_spoiler" value="1" uncheked="uncheked">
                      سبويلر خلفي
                    </label>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="nawakel" value="1" uncheked="uncheked">
                      نواكل
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="sport_rims" value="1" uncheked="uncheked">
                      جنوط رياضية
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="radio_cd" value="1" uncheked="uncheked">
                      دي في دي
                    </label>
                  </div>
                </div>
                <div class="row form-row">
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="new_tires" value="1" uncheked="uncheked">
                      كاوتش جديد
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="center_lock" value="1" uncheked="uncheked">
                      سنترلوك
                    </label>
                  </div>
                </div>



              </div>
            </div>
          </div>


          <div class="col-xs-12">
            <div class="row form-row">
              <div class="col-xs-2">
                <label class="control-label colored right-aligned"> الحالة </label>
              </div>
              <div class="col-xs-10">

                <div class="row form-row">
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="" value="1" uncheked="uncheked">
                      بحالة الزيرو
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="" value="1" uncheked="uncheked">
                      فابريكة بالكامل
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="" value="1" uncheked="uncheked">
                      فابريكة دواخل
                    </label>
                  </div>
                </div>

                <div class="row form-row">
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="" value="1" uncheked="uncheked">
                      رشة نضافة
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="" value="1" uncheked="uncheked">
                      رشة حزام
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="first_hand" value="1" uncheked="uncheked">
                      اول ايد
                    </label>
                  </div>
                </div>
                <div class="row form-row">
                  <div class="col-xs-4">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="" value="1" uncheked="uncheked">
                      صيانة بالتوكيل
                    </label>
                  </div>
                </div>


              </div>
            </div>
          </div>






          <script>
          $(document).ready(function(){

          /********************* license-on **************************/

          $("#license-on").attr("val","0");
          $(".hidden-license-on").hide();

          $("#press-1").click(function(){

          var val =$("#license-on").attr("val");
          //alert(val);
          if(val==0){
            $("#license-on").attr("val","1");
            $(".hidden-license-on").fadeIn();
            $("#traffic").attr("disabled","true");

          }else{
            $("#license-on").attr("val","0");
            $(".hidden-license-on").slideUp();
            $("#traffic").removeAttr("disabled");
          }

          });

          /********************* license-off **************************/
          $("#license-off").attr("val","0");
          //$(".hidden-license-off").hide();

          $("#press-2").click(function(){

          var val =$("#license-off").attr("val");
          //alert(val);
          if(val==0){
          $("#license-off").attr("val","1");
          $("#license-dateto").attr("disabled","true");
          $("#license-datefrom").attr("disabled","true");
          }else{
          $("#license-off").attr("val","0");
          $("#license-dateto").removeAttr("disabled");
          $("#license-datefrom").removeAttr("disabled");
          }

          });

          /********************* insurance **************************/

          $("#insurance-on").attr("val","0");
          $(".hidden-insurance-on").hide();

          $("#press-insurance").click(function(){

          var val =$("#insurance-on").attr("val");
          //alert(val);
          if(val==0){
            $("#insurance-on").attr("val","1");
            $(".hidden-insurance-on").fadeIn();
          }else{
            $("#insurance-on").attr("val","0");
            $(".hidden-insurance-on").slideUp();
          }

          });

          });

          </script>


          <script>
            $( function() {


              $("#license-datefrom").datepicker({
                 dateFormat: 'yy',
                 changeMonth: true,
                 changeYear: true,
                 yearRange: "1950:2019",
                 showButtonPanel: true,
                 onClose: function(dateText, inst) {
                 //    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                     var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                     $(this).val($.datepicker.formatDate('yy', new Date(year, 1)));
                 }
             });




             $("#license-dateto").datepicker({
                dateFormat: 'yy',
                changeMonth: true,
                changeYear: true,
                yearRange: "1950:2019",
                showButtonPanel: true,
                onClose: function(dateText, inst) {
                //    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).val($.datepicker.formatDate('yy', new Date(year, 1)));
                }
            });



          /**********************************************/



               $("#insurance-datefrom").datepicker({
                  dateFormat: 'yy',
                  changeMonth: true,
                  changeYear: true,
                  yearRange: "1950:2019",
                  showButtonPanel: true,
                  onClose: function(dateText, inst) {
                  //    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                      var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                      $(this).val($.datepicker.formatDate('yy', new Date(year, 1)));
                  }
              });



               $("#insurance-dateto").datepicker({
                  dateFormat: 'yy',
                  changeMonth: true,
                  changeYear: true,
                  yearRange: "1950:2019",
                  showButtonPanel: true,
                  onClose: function(dateText, inst) {
                  //    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                      var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                      $(this).val($.datepicker.formatDate('yy', new Date(year, 1)));
                  }
              });



            });

          </script>





          <div class="col-xs-12">
            <div class="row form-row">
              <div class="col-xs-2">
                <label class="control-label colored right-aligned"> الرخصة </label>
              </div>
              <div class="col-xs-10">

                <!-- Hidden Values/ -->
                <input name="user_id_front" type="hidden" value="<?=$_SESSION['user_id_front']?>" />
                <input name="id_cat" id="id_cat" type="hidden" value="2" />
                <!-- Hidden Values/ -->


                <div class="row form-row">
                  <div class="col-xs-4">
                    <label class="radio-inline">
                      <input type="radio" name="license" class="license-on" value="vadid-license" uncheked="uncheked">
                      سارية
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="radio-inline">
                      <input name="licence_finished" type="radio" class="license-on" value="vadid-license" uncheked="uncheked">
                      منتهية
                    </label>
                  </div>
                </div>
                <div class="row form-row desc vadid-license">
                  <div class="col-xs-6">
                    <div class="row">
                      <div class="col-xs-4">
                        <label class="control-label colored"> من </label>
                      </div>
                      <div class="col-xs-8">
                        <input type="text" class="form-control datepicker"  name="license_datefrom" id="license-datefrom">
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="row">
                      <div class="col-xs-4">
                        <label class="control-label colored"> إلي </label>
                      </div>
                      <div class="col-xs-8">
                        <input type="text" class="form-control datepicker"  name="license_dateto" id="license-dateto">
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="col-xs-12">
            <div class="row form-row">
              <div class="col-xs-2">
                <label class="control-label colored right-aligned"> التأمين </label>
              </div>
              <div class="col-xs-10">

                <div class="row form-row">
                  <div class="col-xs-4">
                    <label class="radio-inline">
                      <input type="radio" name="insurance" class="insurance-on" value="vadid-insurance" uncheked="uncheked">
                      سارية
                    </label>
                  </div>
                  <div class="col-xs-4">
                    <label class="radio-inline">
                      <input type="radio"  name="insurance_finished" class="insurance-on" value="vadid-insurance" uncheked="uncheked">
                      منتهية
                    </label>
                  </div>
                </div>
                <div class="row form-row desc2 vadid-insurance">
                  <div class="col-xs-6">
                    <div class="row">
                      <div class="col-xs-4">
                        <label class="control-label colored"> من </label>
                      </div>
                      <div class="col-xs-8">
                        <input type="text" class="form-control datepicker" name="insurance_datefrom" id="insurance-datefrom">
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="row">
                      <div class="col-xs-4">
                        <label class="control-label colored"> إلي </label>
                      </div>
                      <div class="col-xs-8">
                        <input type="text" class="form-control datepicker" name="insurance_dateto" id="insurance-dateto">
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>


          <div class="col-xs-6">
            <div class="row form-row">
              <div class="col-xs-4">
                <label class="control-label colored"> مرور </label>
              </div>
              <div class="col-xs-8">
                <input type="text" name="traffic" class="form-control" >
              </div>
            </div>
          </div>

          <div class="col-xs-12">
            <div class="row">
              <div class="col-xs-2 col-md-4">
                <button type="button" class=" btn btn-default btn-block" id="pendding">شاهد قبل النشر</button>
              </div>
              <div class="col-xs-2 col-md-4">
                <button type="button" class=" btn btn-primary btn-block" id="update">تعديل قبل النشر</button>
              </div>
              <div class="col-xs-2 col-md-4">
                <button type="submit" name="submit" class=" btn btn-success btn-block" id="confirm">انشر الاعلان الآن</button>
              </div>
            </div>
          </div>

          <!-- End Row -->
        </div>
        <!-- End form -->
      </form>

<?php  break;
case("add_used_car"):
//:::::::::::::::::::::::::::::::::::::::::::
(isset($_POST['name']))?  $username=$_POST['name']:'';
(isset($_POST['email']))? $email=$_POST['email'] :'' ;
(isset($_POST['phone']))? $phone=$_POST['phone'] :'' ;
(isset($_POST['id_cat']))?$id_cat=$_POST['id_cat'] :'';
$date  =time();
(isset($_POST['car_brand']))?$car_brand=$_POST['car_brand']:'';
(isset($_POST['model']))?$model=$_POST['model']:'';
(isset($_POST['shape']))?$shape=$_POST['shape']:'';
(isset($_POST['manufactor_year']))?$manufactor_year     =$_POST['manufactor_year']:'';
(isset($_POST['cc']))?$cc=$_POST['cc']:'';
(isset($_POST['category']))?$category=$_POST['category']:'';
(isset($_POST['price']))?$price=$_POST['price']:'';
(isset($_POST['power_steering']))?$power_steering=$_POST['power_steering']:'';
(isset($_POST['electric_front_window']))?$electric_front_window=$_POST['electric_front_window']:'';
(isset($_POST['airbags']))?$airbags=$_POST['airbags']:'';
(isset($_POST['back_parking_sensor']))?$back_parking_sensor=$_POST['back_parking_sensor']:'';
(isset($_POST['electric_join_mirror']))?$electric_join_mirror=$_POST['electric_join_mirror']:'';
(isset($_POST['electric_mirror']))?$electric_mirror=$_POST['electric_mirror']:'';
(isset($_POST['sunroof']))?$sunroof=$_POST['sunroof']:'';
(isset($_POST['panorama_roof']))?$panorama_roof=$_POST['panorama_roof']:'';
(isset($_POST['multi_function_wheel']))?$multi_function_wheel=$_POST['multi_function_wheel']:'';
(isset($_POST['cruise_control']))?$cruise_control=$_POST['cruise_control']:'';
(isset($_POST['abs']))?$abs   =$_POST['abs']:'';
(isset($_POST['xenon_lamps']))?$xenon_lamps=$_POST['xenon_lamps']:'';
(isset($_POST['back_camera']))?$back_camera=$_POST['back_camera']:'';
(isset($_POST['leather_dressing']))?$leather_dressing=$_POST['leather_dressing']:'';
(isset($_POST['front_led_lamps']))?$front_led_lamps=$_POST['front_led_lamps']:'';
(isset($_POST['front_parking_sensor']))?$front_parking_sensor=$_POST['front_parking_sensor']:'';
(isset($_POST['back_spoiler']))?$back_spoiler=$_POST['back_spoiler']:'';
(isset($_POST['nawakel']))?$nawakel=$_POST['nawakel']:'';
(isset($_POST['sport_rims']))?$sport_rims=$_POST['sport_rims']:'';
(isset($_POST['radio_cd']))?$radio_cd=$_POST['radio_cd']:'';
(isset($_POST['center_lock']))?$center_lock=$_POST['center_lock']:'';
//:::::::::::::::::::::: data in table cars used
(isset($_POST['km']))?$km=$_POST['km'] : '';
(isset($_POST['place']))?$place=$_POST['place']: '';
(isset($_POST['notes']))?$notes=$_POST['notes'] :'';
(isset($_POST['new_tires']))? $new_tires=$_POST['new_tires']: '';
(isset ($_POST['first_hand']))?$first_hand=$_POST['first_hand'] :'' ;
(isset ($_POST['licence_finished']))?$licence_finished=$_POST['licence_finished']: '';
(isset ($_POST['license_dateto']))?$license_dateto=$_POST['license_dateto']: '';
(isset ($_POST['license_datefrom']))?$license_datefrom=$_POST['license_datefrom'] : '';
(isset ($_POST['traffic']))?$traffic=$_POST['traffic']: '';
(isset ($_POST['insurance_finished']))?$insurance_finished=$_POST['insurance_finished'] : '' ;
(isset ($_POST['insurance_dateto']))?$insurance_dateto=$_POST['insurance_dateto']: '';
(isset ($_POST['insurance_datefrom']))?$insurance_datefrom=$_POST['insurance_datefrom'] : '';
//:::::::::::::::::::::::::::::::::: upload muliple image
              foreach ($_FILES['advertise_image']['name'] as $key => $r) {
                 $rand = rand(1, 1000);
                     if (multi_upload2('advertise_image',$rand)) {
                        $array[]= $rand . $r;
                 }
               }
               $multi_img = implode(',', $array);

      if(empty($_POST['name']) || empty($_POST['email']) ){
        echo '<h1 class="text-center">برجاء تسجيل البيانات بشكل صحيح!</h1>';
         // insert value in to table
      }elseif(insert("cars","`multi_img`='$multi_img',`id_cat`='$id_cat',`active`='0',`lang`='$_SESSION[language]',`pubtime`='$date',`car_brand_id`='$car_brand',`car_model_id`='$model',`car_shape_id`='$shape',`car_category_id`='$category',`manufactor_year`='$manufactor_year',`cc`='$cc',`sunroof`='$sunroof',`center_lock`='$center_lock',`panorama_roof`='$panorama_roof',`front_led_lamps`='$front_led_lamps',`xenon_lamps`='$xenon_lamps',`electric_mirror`='$electric_mirror',`electric_join_mirror`='$electric_join_mirror',`sport_rims`='$sport_rims',`power_steering`='$power_steering',`multi_function_wheel`='$multi_function_wheel',`electric_front_window`='$electric_front_window',`nawakel`='$nawakel',`cruise_control`='$cruise_control',`leather_dressing`='$leather_dressing',`back_spoiler`='$back_spoiler',`front_parking_sensor`='$front_parking_sensor',`back_parking_sensor`='$back_parking_sensor',`back_camera`='$back_camera',`abs`='$abs',`airbags`='$airbags',`radio_cd`='$radio_cd',`price`='$price'")){


       $cars_id =mysqli_insert_id($db);
       // inser data in used_cars
      insert("`cars_used`","`user_id`='$_SESSION[user_id_front]',`cars_id`='$cars_id',`km`='$km',`notes`='$notes',`new_tires`='$new_tires',`first_hand`='$first_hand',`licence_finished`='$licence_finished',`licence_from`='$license_datefrom',`licence_to`='$license_dateto',`traffic`='$traffic',`insurance_finished`='$insurance_finished',`insurance_from`='$insurance_datefrom',`insurance_to`='$insurance_dateto'");
      // :::::::::: to update title and name
      foreach(getdata('cars',"where `id`='$cars_id'",'ORDER BY `id` DESC',1) AS $row){
          $car_brand_id   =$row->car_brand_id;
          $car_model_id   =$row->car_model_id;
          $car_shape_id   =$row->car_shape_id;
          $car_categor_id =$row->car_category_id;
          //::::: to get car Brand
          $get_car_brand=select("*","cars_brand","where `id`='$car_brand_id'");
          //::::: to get car Model
          $get_car_model=select("*","cars_model","where `id`='$car_model_id'");
          //::::: to get car shape
          $get_car_shape=select("*","cars_shape","where `id`='$car_shape_id'");
          //::::: to get car category
          $get_car_category=select("*","cars_category","where `id`='$car_categor_id'");
          $name= $get_car_brand['name_ar'].' '.$get_car_model['name_ar'].' '.$get_car_shape['name_ar'].' '.$get_car_category['name_ar'];
          update("cars","`name`='$name',`name_ar`='$name',`title`='$name',`title_ar`='$name'","where `id`='$row->id' ");
      }
      echo '<h1 class="text-center"> لقد تم تسجيل السيارة بنجاح وسوف يتم نشرها من قبل الادارة!</h1>';
      }else {
        echo '<h1 class="text-center">نعتزر عن الحطأ ، من فضلك اعد نشر السيارة من جديد</h1>';
      }
      break;
    }
  ?>
    </div>
  </div>
</section>
<?php }
require(realpath(__DIR__ . '/footer.php')); ?>
