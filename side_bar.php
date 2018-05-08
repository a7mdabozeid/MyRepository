<div class="col-md-<?=($file=='details.php')?'4 floattoleft':'3';?>">
    <div class="section-sidebar">
        <div class="project-part">
          <h4><?=get_lange("supplies_crporates","backend=0");?></h4>

            <ul>
              <?php foreach(getdata('products_cat','WHERE `active`=1','ORDER BY `id` ASC',10) AS $row){ ?>
                <li><a href="cat.php?module=products&id_cat=<?=$row->id;?>"><?php if($_SESSION['lang']=="en"):echo $row->name; else: echo $row->name_ar;endif;?> <i class="fa fa-angle-<?=($_SESSION['lang']=="en")?'right':'left';?>" aria-hidden="true"></i>
                </a></li>
              <?php } ?>
            </ul>
        </div> <!-- project-part -->

        <div class="contact-part">
            <h4><?=get_lange("contact_us","backend=0");?></h4>
            <ul class="location">
                <li>
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span class="text"><?=$get_setting['address']?></span>
                </li>
                <li>
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <span class="text"><?=$get_setting['phone']?></span>
                </li>
                 <li>
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span class="text"><?=$get_setting['email']?></span>
                </li>
            </ul>
        </div> <!-- contact-part -->
    </div> <!-- section-sidebar -->
</div> <!-- col-md-3 -->
