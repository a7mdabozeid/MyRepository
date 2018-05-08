<?php

function processGetModels($brandId)
{
  @session_start();
  require(realpath(__DIR__ . '/include/connect.php'));
  include_once realpath(__DIR__ . '/include/functions.php');

  if($brandId){
     $car_brand_id =$brandId;
     $select="select * from `cars_model` where `car_brand_id`='$car_brand_id' order by id ASC  ";
   

  $get_model = mysqli_query($db, " $select "); // get all active module
  //echo '<option value="0" selected disabled>Select The Model</option>';
    $total=mysqli_num_rows($get_model);
   if( $total > 0){
     echo '<option value="0">إختر نوع الموديل</option>';

        while ($row = mysqli_fetch_object($get_model)){
        //   foreach ($row as $val);
           echo '<option value="'.$row->id.'">'.$row->name_ar.'</option>';
         }
    }else{
        echo '<option value="0" disabled="" selected="" >نوع الموديل غير موجود </option>';
    } exit();
  }
}

function processGetShapes($modelId)
{
  @session_start();
  require(realpath(__DIR__ . '/include/connect.php'));
  include_once realpath(__DIR__ . '/include/functions.php');

  if($modelId){
       $car_model_id = $modelId;
        $select="select DISTINCT `car_shape_id` from `cars` where `car_model_id`='$car_model_id'  ";
  
  $vehicle_type = mysqli_query($db," $select ");
  $total=mysqli_num_rows($vehicle_type);
   if( $total > 0){

     echo '<option value="0">اختر الشكل</option>';

        while ($row = mysqli_fetch_object($vehicle_type)){
         $get_cars_shape=select("*","cars_shape","where `id`='$row->car_shape_id'");
         echo '<option value="'.$get_cars_shape['id'].'">'.$get_cars_shape['name_ar'] .'</option>';
         }
    }else{
        echo '<option value="0" disabled="" selected="" > الشكل غير موجود </option>';
    } exit();
  }
}

function processGetCategories($shapeId,$modelId=null)
{
  @session_start();
  require(realpath(__DIR__ . '/include/connect.php'));
  include_once realpath(__DIR__ . '/include/functions.php');

  if($shapeId){
         $car_shape_id =$shapeId;
        $select="select DISTINCT `car_category_id` from `cars` where `car_shape_id`='$car_shape_id' ";
  if(!empty($modelId))
    $select .= " AND car_model_id = '".$modelId."' ";

  $vehicle_type = mysqli_query($db," $select ");
    $total=mysqli_num_rows($vehicle_type);
   if( $total > 0){
    echo '<option value="0">اختر الفئة</option>';

        while ($row = mysqli_fetch_object($vehicle_type)){
         $get_cars_category=select("*","cars_category","where `id`='$row->car_category_id'");
         echo '<option value="'.$get_cars_category['id'].'">'.$get_cars_category['name_ar'] .'</option>';
         }
    }else{
        echo '<option value="0" disabled="" selected="" > الفئة غير موجوده </option>';
    } exit();
  }
}

function processGetPriceLimits($catId)
{
  @session_start();
  require(realpath(__DIR__ . '/include/connect.php'));
  include_once realpath(__DIR__ . '/include/functions.php');

  $id_cat =$catId;

  $minMaxQuery = "SELECT MIN(price) min_price, MAX(price) max_price FROM cars WHERE `active`=1 AND id_cat = ". $id_cat;
  $result = mysqli_query($db,$minMaxQuery);
  $dataObject = mysqli_fetch_object($result);

    echo json_encode($dataObject);

}

function processGetCarPrice($modelId,$shapeId,$category,$status)
{
  @session_start();
  require(realpath(__DIR__ . '/include/connect.php'));
  include_once realpath(__DIR__ . '/include/functions.php');

        $select="select price  from cars where car_model_id = $modelId and car_shape_id = $shapeId and
         `car_category_id` = $category and id_cat = $status ";

  $vehiclePrice = mysqli_query($db," $select ");
  
  if($vehiclePrice)
  {
    $priceObj = mysqli_fetch_object($vehiclePrice);
    $price;

    if(!empty($priceObj))
      echo json_encode($priceObj);
    
  }       
    
}

function processSearchCars($catId)
{
  @session_start();
  require(realpath(__DIR__ . '/include/connect.php'));
  include_once realpath(__DIR__ . '/include/functions.php');

  $module      ="cars";

  $car_shap_id = array_key_exists("selectedCarShape", $_POST)? intval($_POST['selectedCarShape']) : null;
  $car_models = array_key_exists("selectedModels", $_POST)? $_POST['selectedModels'] : null;
  $transmission = array_key_exists("transmission", $_POST) ? $_POST["transmission"] : null;
  $minPrice = array_key_exists("minPrice",$_POST) ? $_POST["minPrice"] : null;
  $maxPrice = array_key_exists("maxPrice", $_POST)? $_POST["maxPrice"] : null;

  $id_cat =$catId;

  ?>
  <script>
    $(document).ready(function() {
    //  $("#loading").show();

      $(".shape_results").remove();
      $("#search-pagination").remove();
      $("#results_counts").remove();

      //$('#forget_password')[0].reset();
      //$(".action").prop('disabled', false).removeClass('disabled').attr("value", "Send" );
      //setTimeout(function(){ window.location = "<?=$url?>"; }, 3000);
    });
  </script>
  <?php

  require(realpath(__DIR__ .'/helper/page/pager.class.php'));
   $get       ='module='.$module.'&id_cat='.$id_cat.'&car_shape='.$car_shap_id.'&'; //for paging
   $perpage		=12;

  /*$get_query=mysqli_query($db,"SELECT * FROM `cars` WHERE `car_shape_id`='$car_shap_id' AND `id_cat`='$id_cat' AND `active`=1 ORDER BY id DESC LIMIT ".($pager->page-1)* $perpage.",".$perpage);*/

  $strSelect = "SELECT * FROM `cars` ";

  $strWhere = " WHERE `active`=1 and id_cat = ". $id_cat;

  if($car_shap_id)
    $strWhere .= " AND `car_shape_id`='$car_shap_id' ";

  if($car_models)
    $strWhere .= " AND car_model_id in (" . implode($car_models,',') . ") ";

  if($transmission)
    $strWhere .= " AND gearbox = '". $transmission ."'";

  if($minPrice != null && $maxPrice != null)
  {
    $strWhere .= " AND (price between " . $minPrice . " AND ". $maxPrice . " or price = 0)";
  }
  //echo $strWhere;
  //get the total number of rows without page limiting factor
  $strNumRowsQuery = $strSelect . $strWhere;

  $strWhere .= "  ORDER BY id DESC LIMIT " . ($pager->page-1) * $perpage . "," . $perpage ;
  $strSelect .= $strWhere;

  $get_query=mysqli_query($db,$strSelect);

  @$total = mysqli_num_rows(mysqli_query($db,$strNumRowsQuery));

  //echo $total=mysqli_num_rows($get_query);

  ?>
  <div style="clear:both; text-align:center; background:#eaeaea;border-radius:10px;padding:10px;margin:10px">
    <span id="results_counts00">عدد نتائج البحث <?=$total?> </span>
  </div>

  <?php
  if( $total > 0){
       while ($row = mysqli_fetch_object($get_query)){

         if (empty($row->image)){ $src=$temp_front."img/slider/banner1.jpg";
         }else if(!file_exists("upload/content/".$row->image)){ $src=$temp_front."img/slider/banner1.jpg";
         }else if(file_exists("upload/content/".$row->image)){ $src="upload/content/".$row->image;
         }else { $src="upload/content_thumbs/".$row->image;}
         ?>




                                 <li class="listCars_item  col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                     <div class="item inproduct">
                                                       <a class="card-link" href="car-details.php?module=cars&id=<?=$row->id;?>" title="اضغط لتعرف المزيد">
                                                       </a>
                                                       <div class="item-inner">
                                                         <img src="<?=$src?>" class="img-responsive fixed-size rawaj-car-image" alt="Car Image">
                                                         <span class="left-align priceValueForCar"><?=number_format($row->price);?>   L.E</span>
                                                         <ul>
                                 <?php if($_GET['id_cat']==1){?>
                                                           <li>
                                                             <a href="#" title="احسب قسطك" class="calculator" onclick="whenClickCalculate(this,46)" data-toggle="modal" data-target="#calculatorForm"><i class="fa fa-calculator"></i>
                                                               <input class="clickedCarPrice" name="clickedCarPrice" type="hidden" value="2200000">
                                                             </a>
                                                             </li>
                                 <?php } ?>

                                                               <li>
                                                                 <a href="#" title="شارك">
                                                                 <i class="fa fa-share-alt"></i>
                                                               </a>
                                                               </li>
                                                                 <li>
                                                                   <a href="#" title="قارن" >
                                                                   <i class="fa fa-plus add_favorite" rate_value="0" module="compare" id_content="<?=$row->id;?>" user_id="<?=$user_id_front;?>" ip_adress="<?=$_SERVER[REMOTE_ADDR]?>" name="<?=($_SESSION[lang]=='en')? $row->name : $row->name_ar;?>">
                                                                   </i>
                                                                 </a>
                                                                 </li>
                                                                 <li>
                                                                   <a href="#" title="اضف للمفضلة" >
                                                                     <i class="fa fa-heart-o add_favorite" rate_value="0" module="favorite" id_content="<?=$row->id;?>" user_id="<?=$user_id_front;?>" ip_adress="<?=$_SERVER[REMOTE_ADDR]?>" name="<?=($_SESSION[lang]=='en')? $row->name : $row->name_ar;?>"></i>
                                                                   </a>
                                                                 </li>
                                                                 <li>
                                                                   <b></b>
                                                                 </li>
                                                                 </ul>
                                                       </div>
                                                       <div class="btm-bar">
                                                         <label class="center-block">
                                                           <span class="center-align car-name">
                                                           <?php if($_SESSION['lang']=='en'){echo news(strip_tags($row->name),50);}else{echo news(strip_tags($row->name_ar),50);}?>
                                                         </span>
                                                         </label>
                                                         <label class="flex-block">
                                                           <span class="flex-inner-block"><?=($row->gearbox=="A/T")?'اوتوماتيك':'مانيوال'?></span>
                                                           <span class="flex-inner-block"></span>
                                                           <span class="flex-inner-block intallementValueForCar"><?=$row->manufactor_year ?> </span>
                                                         </label>
                                                       </div>
                                                     </div>
                                                   </li>


     <?php } ?>


    <script>
      $(function() {
        //     $("#loading").hide();
        });
    </script>
     <div style="clear:both; margin-right:30%;">

         <ul id="search-pagination0" style="display:block; margin:auto;" class="light-theme simple-pagination">
           <li class="active">
              <span class="current">
              <?php $pager= new full_pager($get,$page,$perpage,$total,$next,$prev,$end,$start,'ax='.$total); ?>
              </span>
           </li>
         </ul>

     </div>


  <?php   }else{ echo '<div class="text-center">'.get_lange("no_data_available","backend=1").'</div>'; }

}

function processSearchModels($brandId)
{
  @session_start();
  require(realpath(__DIR__ . '/include/connect.php'));
  include_once realpath(__DIR__ . '/include/functions.php');
  
  if($brandId){
     $car_brand_id =$brandId;
       $select="select * from `cars_model` where `car_brand_id`='$car_brand_id' order by name_ar ASC  ";
   }

$get_model = mysqli_query($db, " $select "); // get all active module
    $total=mysqli_num_rows($get_model);
   if( $total > 0){
      while ($row = mysqli_fetch_object($get_model)){
     echo '<li class="car-model"  car_model_id='.$row->id.'>
          <span class="car-make-img"></span>
          <span class="car-make-name">'.$row->name_ar.'</span>
        </li>';
         }
    }else{
        echo '<option value="0" disabled="" selected="" >نوع الموديل غير موجود </option>';
    } exit();
}
 ?>
