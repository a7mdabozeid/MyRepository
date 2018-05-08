<?php require(realpath(__DIR__ .'/header.php')); ?>

<section class="short-image no-padding agency">
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-lg-12 short-image-title">
      <h5 class="subtitle-margin second-color"><?=get_lange("home","backend=0");?></h5>
      <h1 class="second-color"><?=get_lange("about_us","backend=0");?></h1>
      <div class="short-title-separator"></div>
    </div>
  </div>
</div>
</section>




                  	<section class="section-light section-top-shadow no-bottom-padding">
                  		<div class="container">
                  			<div class="row">
                  				<div class="col-xs-12">
                  					<div class="row">
                  						<div class="col-xs-12">
                  							<div class="details-title pull-<?=($_SESSION['lang']=='en')?'left':'right';?>">
                  								<h3 class="title-negative-margin"><?=$get_setting['site_name']?><span class="special-color">.</span></h3>
                  								<div class="details-agency-address">
                  									<i class="fa fa-map-marker"></i>
                  									<span><?=$get_setting['address']?></span>
                  								</div>
                  							</div>
                  							<div class="clearfix"></div>
                  							<div class="title-separator-primary"></div>

                  							<div class="row margin-top-60">
                  								<div class="col-xs-12 col-sm-6 col-lg-3">
                  									<img src="<?=$temp_front?>images/logos/logo-2.png" alt="Burouj" style="width: 300px;"/>
                  									<div class="details-parameters agency-details margin-top-60">

                                    	<div class="team-desc-line">
                  											<span class="agent-icon-circle">
                  												<i class="fa fa-phone"></i>
                  											</span>
                  											<span><?=$get_setting['phone']?></span>
                  										</div>

                  										<div class="team-desc-line">
                  											<span class="agent-icon-circle">
                  												<i class="fa fa-envelope fa-sm"></i>
                  											</span>
                  											<span><a href="mailto:<?=$get_setting['email'];?>"><?=$get_setting['email']?></a></span>
                  										</div>
                  										<div class="team-desc-line">
                  											<span class="agent-icon-circle">
                  												<i class="fa fa-globe"></i>
                  											</span>
                  											<span><a href="<?=$url;?>"><?=$url;?></a></span>
                  										</div>
                  										<div class="team-social-cont">
                  											<div class="team-social">
                  												<a class="agent-icon-circle" href="<?=$get_setting['facebook']?>" target="_blank">
                  													<i class="fa fa-facebook"></i>
                  												</a>
                  											</div>
                  											<div class="team-social">
                  												<a class="agent-icon-circle" href="<?=$get_setting['twitter']?>" target="_blank">
                  													<i class="fa fa-twitter"></i>
                  												</a>
                  											</div>
                  											<div class="team-social">
                  												<a class="agent-icon-circle" href="<?=$get_setting['gplus']?>" target="_blank">
                  													<i class="fa fa-google-plus"></i>
                  												</a>
                  											</div>

                  										</div>
                  									</div>
                  								</div>
                  								<div class="col-xs-12 col-sm-6 col-lg-9">
                  									<p class="negative-margin"><?=get_topic_desc(68,5500);?></p>

                  								</div>
                  							</div>


                  						</div>
                  					</div>




                  				</div>
                  			</div>
                  		</div>
                  	</section>


<?php require(realpath(__DIR__ .'/footer.php'));
