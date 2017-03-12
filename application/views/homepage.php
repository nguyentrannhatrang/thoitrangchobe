<!-- feature-product -->
<div id="feature-product" class="feature-product">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <h2 class="wow bounceInDown" data-wow-duration="2s">Sản Phẩm Nổi Bật</h2>
                <div class="border"></div>
            </div>
        </div>
        <div class="row">
            <?php if (!empty($popular_products)) { ?>
                <?php foreach ($popular_products as $product) { ?>
                    <?php $this->load->view('partials/productHome', ['product' => $product]); ?>
                <?php } ?>
            <?php } ?>    
        </div>
    </div>
</div>
<!-- end feature-product -->