<?php require(realpath(__DIR__ . '/header.php'));

 error_reporting(0);
$module 	 =clean_value ($_GET['module']);//// get module
$id 	     =intval($_GET['id']);//// get id_cat
$id_cat 	 =intval($_GET['id_cat']);//// get id_cat
@$get_data = mysqli_fetch_array(mysqli_query($db,"select * from $tab where `active`=1 and `id`='$id'"));
if(!empty($_GET['id_cat'])):
@$get_cats = mysqli_fetch_object(mysqli_query($db,"SELECT `name`,`id`,`lang`,`active` FROM $tab_cat where `id`='$id_cat' AND `active`=1"));
endif;
if(isset($_GET['module']) ){ ///check variable

  require(realpath(__DIR__ .'/helper/page/pager.class.php'));
   $get       ='module='.$module.'&id_cat='.$id_cat.'&car_shape='.$_GET['car_shape'].'&'; //for paging
   $perpage		=12;
  if(!empty($id_cat)&& !empty($_GET['car_shape'])){
   $where="id_cat='".$id_cat."' AND `car_shape_id`='".$_GET['car_shape']."' AND";
 }elseif(!empty($id_cat)){
 $where="id_cat='".$id_cat."'AND";
  }else{
    $where="";
  }

  // @$total = mysqli_num_rows(mysqli_query($db,"SELECT `id` FROM $module where $where `active` = 1 and id_cat = ".$id_cat." ORDER BY id DESC "));
  // if($total > 0){ ///check num
  //$select =mysqli_query($db,"SELECT * FROM $module WHERE $where `active`=1 and id_cat = ".$id_cat. " ORDER BY id DESC LIMIT ".($pager->page-1)* $perpage.",".$perpage);
?>

<script>

function isManualTransSelected()
{
  var manualTransParent = document.getElementById("trans-manual").parentElement;
          if(manualTransParent.classList.value.indexOf("selected") >= 0)
            return true;
}

function isAutoTransSelected()
{
  var autoTransParent = document.getElementById("trans-automatic").parentElement;
          if(autoTransParent.classList.value.indexOf("selected") >= 0)
            return true;
}

function applyFilters()
{
    var selectedCarShape = null, selectedModels = [];

  //check selected car shape
    var existingSelection = $("#carstructurelist").find(".selected");

    if(existingSelection && existingSelection.length > 0)//we have a selected car shape
        {
          selectedCarShape = existingSelection[0].attributes["shape_id"].value;
        }

    //check selected models
    var selectedCarModels = $("#cars_model_results").find(".selected");

    if(selectedCarModels && selectedCarModels.length > 0)//we have at least one car makes selected
    {
      for(var i = 0; i < selectedCarModels.length; i++)
      {
        selectedModels.push(selectedCarModels[i].attributes["car_model_id"].value);

      }
    }

    //check selected transmissions
    var isManualSelected = isManualTransSelected();
    var isAutoSelected = isAutoTransSelected();

    var ajaxParams = {id_cat: 1};

    if(selectedCarShape)
      ajaxParams.selectedCarShape = selectedCarShape;

    if(selectedModels && selectedModels.length > 0)
      ajaxParams.selectedModels = selectedModels;


    if(isManualSelected || isAutoSelected)
    {
      ajaxParams.transmission = isAutoSelected? "A/T" : "M/T";
    }

    var hMinPrice = document.getElementById("h-min-price");
    var hMaxPrice = document.getElementById("h-max-price");

    var minPrice = hMinPrice.value;
    var maxPrice = hMaxPrice.value;

    if(minPrice != "" && maxPrice != "")
    {
      ajaxParams.minPrice = minPrice;
      ajaxParams.maxPrice = maxPrice;
    }

    $.ajax({
        type: "POST",
        data: ajaxParams,
      //  dataType: 'json',

        url: "ajax_cars.php?action=search_cars",

        success: function(msg){
          $("#shape_results").html(msg).fadeIn("slow");//.delay(4000).fadeOut("slow");

        }

      });

}

   $(document).ready(function() { // start jquery code

      applyFilters();//first loading

      $.ajax({
        type: "POST",
        data: {id_cat: 1},
        url: "ajax_cars.php?action=get_price_limits",

        success: function(response){
        var objLimits = JSON.parse(response);
        var min_price = objLimits.min_price < 2000? 2000 : objLimits.min_price;
        var max_price = objLimits.max_price;

      $("#minPriceVal").text(min_price + "EGP");
      $("#maxPriceVal").text(max_price + "EGP");

      var hMinPrice = document.getElementById("h-min-price");
      hMinPrice.value = min_price;

      var hMaxPrice = document.getElementById("h-max-price");
      hMaxPrice.value = max_price;

      $( "#price-slider").slider({
            range: true,
            min: min_price == max_price ? 0 : min_price ,
            max: max_price,
            step : 2000 ,
            values: [ min_price == max_price ? 0 : min_price, max_price ],

            stop: function( event, ui ) {

              if(ui.handleIndex == 0)
              {
                var hMinPrice = document.getElementById("h-min-price");
                hMinPrice.value = ui.value;
                applyFilters();

              }
              else if(ui.handleIndex == 1)
              {
                var hMaxPrice = document.getElementById("h-max-price");
                hMaxPrice.value = ui.value;
                applyFilters();

              }

            },

            slide: function( event, ui ) {
                $("#minPriceVal").text(ui.values[ 0 ]+ "EGP");
                $("#maxPriceVal").text(ui.values[ 1 ]+ "EGP");
            },

            start: function( event, ui ){
              //$("#minPriceVal").text(min_price + "EGP");
              //$("#maxPriceVal").text(max_price + "EGP");

                //removeCritariaFromSearchObj("minPrice");
                //removeCritariaFromSearchObj("maxPrice");
                //removeTag("price" , "l.e "+ui.values[ 0 ]+" - l.e "+ ui.values[ 1 ] ,"l.e "+ui.values[ 0 ]+" - l.e "+ ui.values[ 1 ] );
            }
        });

        },
        failure: function(response)
        {
          console.error("Error getting cars price limits: ");
          console.error(JSON.stringify(response));
        }

      });

       $(".search_car_shape").click(function() {

        var existingSelection = $("#carstructurelist").find(".selected");

        if(existingSelection && existingSelection.length > 0)
        {
          $(existingSelection[0]).removeClass("selected");

          if(existingSelection[0] != this)
            $(this).addClass("selected");
        }
        else
          $(this).addClass("selected");

        $('search-criteria').tagsinput('add', {id: '1', value: 'hello'});

        applyFilters();

    }); // end check main login

//::::::::::::::::::::: start get model cars :::::::::::::::::::::::::::::::::::
//::::::::::::::::::::: start get model cars :::::::::::::::::::::::::::::::::::
    $(".car_brand").click(function() {
     var car_brand_id = $(this).attr("car_brand_id");
     var id_cat = $(this).attr("id_cat");

     $(this).addClass("selected");

    var data = {"car_brand_id":car_brand_id,"id_cat":id_cat};
   $.ajax({
     type: "POST",
     data: data,
     url: "ajax_cars.php?action=search_car_model",

     success: function(msg){
       $("#cars_model_results").html(msg).fadeIn("slow");//.delay(4000).fadeOut("slow");

        //car model click
      $(".car-model").click(function(e) {
          //console.log("Car model: " + JSON.stringify(e.target));
          if(e.currentTarget)
          {
            var li = e.currentTarget;

            if(li.classList.value.indexOf("selected") >= 0)
            {
              $(li).removeClass("selected");
              $(li).removeClass("active");
            }
            else
            {
              $(li).addClass("selected");
              $(li).addClass("active");
            }
          }

          applyFilters();
      });
     }

   });//end of ajax call

 }); // end of car_brand click

     /*Handle manual/automatic transmission clicks*/

    $("#trans-automatic").click(function(e)
    {
        try
        {
            var parent = this.parentElement;

            if(parent.classList.value.indexOf("selected") >= 0)
              parent.classList.remove("selected");
            else
              parent.classList.add("selected");

          var manualTransParent = document.getElementById("trans-manual").parentElement;
          if(manualTransParent.classList.value.indexOf("selected") >= 0)
            manualTransParent.classList.remove("selected");


              applyFilters();
        }
        catch(e)
        {
          console.error("An error occured while handling automatic transmission button click: " + e.message);
        }
    });

    $("#trans-manual").click(function(e)
    {
        try
        {
            var parent = this.parentElement;

            if(parent.classList.value.indexOf("selected") >= 0)
              parent.classList.remove("selected");
            else
              parent.classList.add("selected");

            var autoTransParent = document.getElementById("trans-automatic").parentElement;
          if(autoTransParent.classList.value.indexOf("selected") >= 0)
            autoTransParent.classList.remove("selected");

          applyFilters();
        }
        catch(e)
        {
          console.error("An error occured while handling manual transmission button click: " + e.message);
        }
    });

  }); // end of document ready callback


  </script>

  <section class="taqseet-calc">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="adv img-responsive">
            <?php // echo adrotate_ad(3); ?>
          </div>
          <!-- <div class="container"> <img src="<?=$temp_front?>img/ads/ad_banner.png" class="img-responsive"> </div> -->
        </div>
      </div>
    </div>
  </section>
<!-- taqseet calc section -->
<section class="models-cont">
  <div class="container" >
    <div class="row" data-sticky-sidebar-container>
      <div class="col-lg-3 col-md-4 col-xs-12 side-right" class="sidebar" id="sidebar" data-sticky-sidebar>

        <!-- Side blocks -->
        <!-- Side block - Car Shapes -->
        <div class="side-block">
          <h3>هيكل السيارة</h3>
          <ul class="Car-shapes side-block-content" id="carstructurelist">

            <?php foreach(getdata('cars_shape','where `active`=1','ORDER BY `id` ASC',25) AS $row){ ?>

            <li class="car-shape search_car_shape" shape_id="<?=$row->id;?>" id_cat="<?=$_GET['id_cat']?>">
              <a href="javascript:void(0)">
                <i class="icon-suv"></i>
                <span><?=$row->name_ar;?></span>
              </a>
            </li>

            <?php } ?>
          </ul>
        </div>
        <!-- End Side block - Car Shapes -->



        <!-- Side block - Make and Modal -->
        <div class="side-block" >
          <h3 class="makeModel">
              الماركة والموديل
            <i class="fa fa-chevron-left"></i>
          </h3>
        </div>
        <!-- End Side block - Make and Modal -->

        <!-- Car Makes list -->
        <div class="car-makes-list" id="car-makes" style="display:none;">
          <ul>

            <?php foreach(getdata('cars_brand','where `active`=1','ORDER BY `name_ar` ASC',250) AS $row){ ?>

              <li class="car_brand" car_brand_id="<?=$row->id;?>" id_cat="<?=$_GET['id_cat']?>">
                <span class="car-make-img"
                style="background-image:url('template/frontend/img/car_makers/<?php echo $row->image ?>');"></span>
                <span class="car-make-name"><?=$row->name_ar;?></span>
              </li>

            <?php } ?>

          </ul>
        </div>






        <div class="car-makes-list car-modals-list"  id="car-modals" style="display:none;">
          <ul>

              <div id="cars_model_results"></div>

          </ul>
        </div>

        <!-- Side block - Transmission -->
        <div class="side-block">
          <h3>ناقل الحركة</h3>
          <div class="tags">
            <ul id="gearboxlist">
              <li><a href="javascript:void(0)" id="trans-automatic" title="اتوماتيك">اتوماتيك</a></li>
              <li><a href="javascript:void(0)" id="trans-manual" title="مانيوال">مانيوال</a></li>
            </ul>
          </div>
        </div>
        <!-- End Side block - Transmission -->

        <!-- Side block - Price Range -->
        <div class="side-block">
          <div>
            <h3>مقياس السعر </h3>
            <div id="price-slider" style="width: 95%;display: block;margin: auto;margin-top:20px;"></div>
            <span id="minPriceVal" style="display:block;float:left; margin-top: 10px;" ></span> <span id="maxPriceVal" style="display:block; margin-top: 10px;" ></span>
            <input type="hidden" id="h-min-price" />
            <input type="hidden" id="h-max-price" />
          </div>
        </div>
        <!-- End Side block - Price Range -->

  <?php if (isset($_GET['id_cat'])  && $_GET['id_cat'] ==2){ ?>
         <div class="side-block">
          <div class="form-group">
            <h3><i class="fa fa-tags"></i> مقياس الكيلو مترات </h3>
            <div id="kilomslider" style="width: 95%;display: block;margin: auto;"></div>
            <span id="minKMVal" style="display:block;float:left; margin-top: 5px;" ></span> <span id="maxKMVal"  style="display:block; margin-top: 5px;" ></span>
            <input type="hidden" id="initMinKMVal" />
            <input type="hidden" id="initMaxKMVal" />
          </div>
        </div>
        <!--  -->
        <!--  -->
        <div class="side-block">
          <div class="form-group">
            <h3><i class="fa fa-tags"></i> سنوات الصنع </h3>
            <div id="manufyearslider" style="width: 95%;display: block;margin: auto;"></div>
            <span id="minYearVal" style="display:block;float:left; margin-top: 5px;"></span> <span id="maxYearVal"  style="display:block; margin-top: 5px;" ></span>
            <input type="hidden" id="initMinYearVal" />
            <input type="hidden" id="initMaxYearVal" />
          </div>
        </div>


          <div class="side-block" id="locationsDiv">
          <h3>موقع السيارة</h3>
          <div class="tags">
            <ul id="carlocationlist">
              <li><a href="#">القاهرة</a></li>
              <li><a href="#">الجيزة</a></li>
              <li><a href="#">الاسكندرية</a></li>
              <li><a href="#">السويس</a></li>
              <li><a href="#">الشرقية</a></li>
              <li><a href="#">الدقهلية</a></li>
              <li><a href="#">القاهرة</a></li>
              <li><a href="#">الجيزة</a></li>
              <li><a href="#">الاسكندرية</a></li>
              <li><a href="#">السويس</a></li>
              <li><a href="#">الشرقية</a></li>
              <li><a href="#">الدقهلية</a></li>
            </ul>
          </div>
          <a class="loadMoreCars_owners" href="#">مشاهدة جميع المناطق</a> <a class="loadLessCars_owners" href="#">تقليل المناطق</a> </div>
        <!--  -->
        <?php } ?>
      </div>
      <div class="col-lg-9 col-md-8 col-xs-12">
        <div class="row">
          <!--
          <div class="side-block side-list" id="makesDiv" style="right:0;"> <a href="#" class="close-window"><i class="fa fa-close"></i> </a>
            <h3>الماركة</h3>
            <div class="makes">
              <ul id="carmakeslist">
              </ul>
            </div>
          </div>
          <div class="side-block side-list" id="modelsDiv" style="right: 210px;"> <a href="#" class="close-window"><i class="fa fa-close"></i> </a>
            <h3>الموديل</h3>
            <div class="makes">
              <ul id="carmodelslist">
              </ul>
            </div>
          </div>
          -->

        <!--  <div class="col-xs-12">
            <div style="width:85%;  float:right;">
              <form class="form-inline multi-search" action="" method="post" onSubmit="return false">
                <div class="bs-example">
                  <select id="selectedcritria" multiple>
                  </select>
                </div>
              </form>
            </div>
            <div  id="clear-search" style="width:15%;  float:left; color:#FFFFFF; background-color:#2b729a;">مسح قيم البحث</div>
          </div>-->
          <div id="tab-container" class="tab-container">

            <div class="row gridlist" style="margin-right:20px">
              <!-- Asmaa -->
              <div class="col-xs-3">
                <ul class="etabs">
                  <li class="active"><a href="#grid" data-toggle="tab" class="gridView"><i class="fa fa-th"></i></a> </li>
                  <li><a href="#list" data-toggle="tab" class="listView"><i class="fa fa-list" aria-hidden="true"></i></a> </li>
                  <!--<li><span id="clear-search" style="cursor:pointer; color: #2a6496;">مسح قيم البحث</span></li>-->
                </ul>
                <div class="form-group">
                  <!-- <select class="form-control" aria-labelledby="d1" id="sort-criteria" style=" border: 1px solid #6c6c6c;height: 50px; width:40px;">
                    <option value="make" selected="selected" id="ASC"> </option>
                    <option value="price" id="DESC" > ترتيب حسب : أعلي سعر </option>
                    <option value="price" id="ASC"> ترتيب حسب : أقل سعر </option>
                                      </select> -->
                  <i class="fa fa-2x fa-filter" style="color:#2b729a"></i> </div>
              </div>

              <div class="col-xs-9">
                <div style="width:85%;float:right">
                  <form class="form-inline multi-search" action="" method="post" onsubmit="return false">
                    <div class="bs-example">
                      <div class="bootstrap-tagsinput">
                        <input type="text" placeholder="" ></div>
                        <div class="bs-example">
                      <select id="search-criteria" multiple data-role="tagsinput" 
                      style="display: none;">
                          </select>
  </div>
                    </div>
                  </form>
                </div>
                <div id="clear-search" style="width:15%;  float:left; color:#FFFFFF; background-color:#2b729a; text-align:center;">مسح</div>
              </div>
              <!--  <div class="side_block" id="clear-search" style="cursor:pointer; color: #2a6496;">مسح قيم البحث</div> -->
              <!-- End Asmaa -->
            </div>
          <!--  <div class="gridlist col-xs-12">
               <ul class="etabs">
                <li class="active"><a href="#grid" data-toggle="tab" class="gridView"><i class="fa fa-th"></i></a> </li>
                <li><a href="#list" data-toggle="tab" class="listView"><i class="fa fa-list" aria-hidden="true"></i></a> </li>
               </ul>
               <div class="form-group">
                <select class="form-control" aria-labelledby="d1" id="sort-criteria" style=" border: 1px solid #6c6c6c;height: 50px;">
                  <option value="make" selected="selected" id="ASC">ترتيب حسب : الماركة </option>
                  <option value="price" id="DESC" > ترتيب حسب : أعلي سعر </option>
                  <option value="price" id="ASC"> ترتيب حسب : أقل سعر </option>
                  <?php if (isset($_GET['carType'])  && $_GET['carType'] == "used"){?>
                  <option value="km" id="DESC"> ترتيب حسب : كيلو متر أعلي </option>
                  <option value="km" id="ASC"> ترتيب حسب : أقل كيلو متر </option>
                  <option value="popularity" id="ASC"> ترتيب حسب : الاشهر </option>
                  <option value="location" id="ASC"> ترتيب حسب : المكان </option>
                  <?php }?>
                </select>
              </div>
            </div>-->
            <div class="clearfix"></div>
            <div class="col-xs-12">
              <hr/>
            </div>


            <div id="results_counts" style="clear:both; text-align:center; background:#eaeaea;border-radius:10px;padding:10px;margin:10px">
              <span >عدد نتائج البحث <?=$total?> </span>
            </div>


            <div id="myTabCondtent" class="tab-content">

              <div id="loading0000000"></div>

              <div id="listeddcars" class="tab-pane fade active in">
                <ul class="listCars">


                  <div id="shape_results"></div>

                </ul>
              </div>

          </div>






            <div style="clear:both; margin-right:30%;">

                <ul id="search-pagination" style="display:block; margin:auto;" class="light-theme simple-pagination">
                  <li class="active">
                     <span class="current">
                     <?php $pager= new full_pager($get,$page,$perpage,$total,$next,$prev,$end,$start,'ax='.$total); ?>
                     </span>
                  </li>
                </ul>

            </div>





          <!--  <div class="results-overlay"></div>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?=$temp_front;?>js/bootstrap-tagsinput.js" type="text/javascript"></script>

<?php }else{echo '<div class="heading-suc">'.get_lange('no_available_data','backend=0').' </div>';}
require(realpath(__DIR__ . '/footer.php')); ?>

