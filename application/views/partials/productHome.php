<!--item-start-->
<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 item-product">
    <div class="container-overlay">
        <a href="#" title="" class="img-product">
            <img src="<?php echo site_url('img.php?src='.PATH_IMAGE_PRODUCT.$product->image.'&h=340'); ?>" alt="<?php echo $product->name.' | '.$general->logo_text; ?>" class="img-responsive image wow zoomIn" data-wow-duration="2s">
            <span class="sale-off wow flash" data-wow-duration="1s" data-wow-iteration="10">
                SALE!
            </span>
        </a>
        <div class="overlay ">
            <div class="content ">
                <div class="cart "> <a href="# " title=" "><i class="fa fa-shopping-cart "></i>  Add to Cart</a> </div>
                <div class="detail ">
                    <a href="<?php echo site_url(url_title($product->name).'-'.$product->id); ?>" title=" ">
                        <i class="fa fa-file-text-o "></i>
                        Show detail
                    </a>
                </div>
            </div>
        </div>
        <div class="price-box ">
            <a href="<?php echo site_url(url_title($product->name).'-'.$product->id); ?>">
                <h3><?php echo $product->name;?></h3>
            </a>
            <!--<span class="glyphicon glyphicon-star "></span>
            <span class="glyphicon glyphicon-star "></span> 
            <span class="glyphicon glyphicon-star "></span> 
            <span class="glyphicon glyphicon-star "></span> 
            <span class="glyphicon glyphicon-star "></span>-->
            <p>
                <?php echo $product->short_description; ?>
            </p>
            <ul class="list-unstyled list-inline wow lightSpeedIn " data-wow-duration="2s ">
                <li>
                    <p>
                        <del>$20.00</del>
                    </p>
                </li>
                <li>
                    <p><strong><?php echo $product->price; ?> <?php if (!empty($general->currency)) echo $general->currency ?></strong></p>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--item-end-->