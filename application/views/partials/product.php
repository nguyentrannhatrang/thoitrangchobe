<div class="col-sm-6 col-xs-6 col-md-4 col-lg-4 col-height" >
    <div class="productinfo text-center">
        <a href="<?php echo site_url(url_title($product->name).'-'.$product->id); ?>">
            <img src="<?php echo site_url('img.php?src='.PATH_IMAGE_PRODUCT.$product->image.'&h=130'); ?>" alt="<?php echo $product->name.' | '.$general->logo_text; ?>" />
        </a>
        <h2><?php echo $product->price; ?> <?php if (!empty($general->currency)) echo $general->currency ?></h2>
        <a href="<?php echo site_url(url_title($product->name).'-'.$product->id); ?>"><p><?php echo $product->name; ?></p></a>
        <p><?php echo $product->description; ?></p>
        <a data-id="<?php echo $product->id; ?>" class="btn btn-default add-to-cart"><i
                class="fa fa-shopping-cart"></i>Add to cart</a>
    </div>
</div>