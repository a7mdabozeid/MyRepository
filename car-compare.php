<?php require(realpath(__DIR__ . '/header.php'));
//require (realpath(__DIR__ .'/libraries/passlib.php'));
if(!isset($_SESSION['first_name']) ){

  echo'<div class="message-page"  >
   <div class="col-sm-12">
      <div class="box">
        <div class="icon"><i class="fa fa-times-circle-o"></i></div><!-- End .icon -->
          <h1>'.get_lange('not_logged','backend=0').'</h1>
        </div><!-- End .box -->
     </div><!-- End .col-sm-12 -->
   </div><!-- End .message-page -->';
  echo '<meta http-equiv="refresh" CONTENT="3;URL=index.php">';
} else {
  $first_name=$_SESSION['first_name'];
  $user_id_front=$_SESSION['user_id_front'];
  $res = mysqli_fetch_object(mysqli_query($holol,"SELECT * FROM `members` WHERE `id`='$user_id_front' "));
?>

<script>
/*
    $(document).ready(function() { // start jquery code
      $(".favourite").click(function() {
        var id_content = $(this).attr("id_content");
        var module     = $(this).attr("module");
        var ip_adress  = $(this).attr("ip_adress");
        var rate_value = $(this).attr("rate_value");
        var user_id    = $(this).attr("user_id");
        var up         = $(this).attr("up");
        alert(id_content);

      if(up ==1){ var masg = ".rate_masg1"; }else { var masg = ".rate_masg";}

       var data = {"rate_value":rate_value,"id_content":id_content,"module":module,"ip_adress":ip_adress,"user_id":user_id};
      $.ajax({
      type:"post",
      url:"ajax_progress.php?action=update_rate",
      data:data,
      success: function(msg) {
      //  $(masg).html(msg).delay(4000).fadeOut();
        $(masg).fadeOut();
        $(masg).html(msg).fadeIn("slow");
      	$(masg).fadeIn().delay(2000).fadeOut();
        }
        });
      });
    });// end all jquery code
    */
 </script>


 <script> // to delete wishlist items ....
     $(function () {
         $('.favourite').on('click', function () {
           var name    = $(this).attr('name')
           var user_id = $(this).attr('user_id')
           var id_content = $(this).attr('id_content')

          //   alert(id_content);

           if(confirm("Do you want to delete "+name+"?")) {
             var data = {"name":name,"user_id":user_id,"id_content":id_content};
             $.ajax({
                   type:'GET',
                   data: data,
                   url:'ajax_progress.php?action=delete_favourite',
                   success: function (msg) {
                     $("#delete_msg").fadeOut();
                     $("#delete_msg").html(msg).fadeIn("slow");
                     $("#delete_msg").fadeIn();
                   }
               }); // end ajax call
           }
         });
     });
 </script>

<!-- start main valid of form -->

<span class="custom-space-small"><!--important--></span>

<section class="dashboard-section  section-block">
  <div class="container">
      <div class="row"><div class="col-sm-12"><h1 class="dashboard-title"><?//=$first_name;?> <b>Dashboard</b></h1></div></div>
          <div class="row">
            <div class="col-md-12">
              <a class="custom-btn open-dash-btn btn-box red-bg white-hover visible-xs" data-toggle="offcanvas">Open Dashboard Menu</a>
            </div>
          </div><!--end row-->
      <div class="row row-offcanvas row-offcanvas-left">
        <!--:::::::::::::::::::::::: side_bar Dash board::::::::::::::::::::::::::::-->
                 <?php include ('side_bar.php'); ?>
        <!--:::::::::::::::::::::::: side_bar Dash board::::::::::::::::::::::::::::-->

    <div class="col-xs-12 col-sm-8">
    <aside class="dashboard-Form-side">

      <ul class="section-root-menu br-hide">
        <li><a href="user_favourite.php" class="activ-bold">Favourite</a></li>
       </ul><!--end section-root-menu-->

       <span class="custom-space-small"></span>

        <form id="user_info" method="post" action="user_wishlist.php?do=edit_info" enctype="multipart/form-data">

        <div class="row">
          <div class="col-md-12">

              <?php
                  //::: favourite fans
                  require(realpath(__DIR__ .'/helper/page/pager.class.php'));
                  $perpage   =6;
                      	// عدد النتائج في كل صفحة
                  @$total = mysqli_num_rows(mysqli_query($holol,"SELECT * FROM `rate` where `user_id` ='$res->id' AND `module`='favourite' "));

                  $get_favourite=mysqli_query($holol, "SELECT * FROM `rate` WHERE `user_id` ='$res->id' AND `module`='favourite' order by `id` DESC LIMIT ".($pager->page-1)* $perpage.",".$perpage);//select topics

                  while($row_favourite=mysqli_fetch_object($get_favourite)){

                  $users = mysqli_fetch_object(mysqli_query($holol,"SELECT * FROM `members` where `id`='$row_favourite->id_content' AND `active`=1  ORDER BY `id` DESC "));

                    if(empty($users->image)){
                      $src=$temp_front."/images/user.jpg";
                    }elseif(!file_exists("upload/content_thumbs/".$users->image)){
                      $src=$temp_front."/images/user.jpg";
                    }elseif(file_exists("upload/content_thumbs/".$users->image)){
                      $src="upload/content_thumbs/".$users->image;
                    }else {
                      $src="upload/content/".$users->image;
                    }
               ?>

            <figure class="edit-blog-figure">
            <span><img src="<?=$temp_front;?>images/techer-pic.png" alt=""></span>
              <figcaption>
                <h1 class="nowrap-text"><?=ucwords(strtolower($users->first_name)).' '.ucwords(strtolower($users->last_name));?> </h1>
                <p> Date : <span class="blue-color"><?=date('d - F - Y',$row_favourite->time); ?> </span></p>

                <input type="button" value="UnFollow" class="option red-bg favourite " rate_value="0" module="favourite" id_content="<?=$row_favourite->id_content;?>" name="<?=ucwords(strtolower($users->first_name)).' '.ucwords(strtolower($users->last_name));?>" user_id="<?=$user_id_front;?>" style=" width:100px;">

                <a href="user_profile.php?user_id=<?=$row_favourite->id_content;?>">
                  <input type="button" value="User Profile" class="option blue-bg" style=" width:100px;">
                </a>
              </figcaption>
            </figure>

            <?php } ?>


            <div class="col-sm-6 col-sm-offset-3">
              <span id="delete_msg"></span>
            </div>

          </div> <!--end item-->

        </div>

          <div class="row">
            <div class="page-pager">
              <dl>
                <?php   $pager= new full_pager($get,$page,$perpage,$total,$next,$prev,$end,$start,'ax='.$total); // get pag?>
              </dl>
            </div>
          </div>

        </form>

    </aside>


    </div> <!--end dashboard-Form-side-->
       </div><!--end Main row-->
  </div>
</section><!--End dashboard-section-->


<?php } require(realpath(__DIR__ . '/footer.php'));
