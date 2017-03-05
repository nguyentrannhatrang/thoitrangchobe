<!-- feature-product -->
<style>
    @media screen and (max-width:767px){
        #frm-book .product-action-block {
            position: fixed;
            bottom: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
            width: 100%;
            background: #fff;
        }
        #frm-book .product-action-block .choice-specify {
            display: none;
        }
        #frm-book .add-cart-button {
            position: relative;
            right: 0px;
            top: 12px;
        }
        .info i {
            display: block;
        }
        .info .like {
            height: 100%;
            vertical-align: middle;
        }
        .total{
            cursor: pointer;
        }
        .show{
            display: block !important;
        }
    }

</style>
<div id="detail-page-product" class="feature-product">
    <div class="container">
        <div class="row" style="margin-top: 10px;">
        </div>
        <div class="row">
            <!--image -->
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div id="product-detail-image">
                    <a>
                        <span class="hidden icon-83"></span>
                        <span class="babi-icon babi-icon-2"></span>
                        <img class="ty-pict" id="thumb-img"
                             src=""
                             width="600" height="" alt="<?php echo $product->name; ?>" title="<?php echo $product->name; ?>">
                    </a>
                </div>
                <div class="list-images">
                    <div class="slick-image" data-flickity='{ "groupCells": true }'>
                    <?php foreach ($product_images as $image) {?>

                        <img class="" src="<?php echo site_url('img.php?src='.PATH_IMAGE_PRODUCT.$image->value.'&h=600') ?>" width="50" height="60" alt="<?php echo $product->name; ?>" title="<?php echo $product->name; ?>">                       
                    <?php }?>
                    </div>
                </div>
            </div>
            <!-- product detail-->
            <form id="frm-book">
            <div id="product-detail-content" class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                <h1 class="ty-product-block-title"><?php echo $product->name; ?></h1>
                <div class="short_description">
                    <div class="product_excerpt">
                        <?php echo $product->short_description; ?>
                    </div>
                </div>
                <div class="color-size">
                    <input type="hidden" id="product-color" name="product-color" value="" />
                    <input type="hidden" id="product-size" name="product-size" value="" />
                    <input type="hidden" id="product-id" name="product-id" value="<?php echo $product->id; ?>" />
                    <div class="product-action-block">
                        <div class="choice-specify">
                            <div class="">
                                <label >Chọn màu<span class=""><a data-toggle="tooltip" title="<p>Chọn ngay màu sắc phù hợp cho bé.</p>"><i class="fa fa-question-circle"></i>
                                    </a>
                                </span>: <span id="selected_color" class="highlight"></span></label>
                                <div class="list-color">

                                </div>
                            </div>
                            <br class="clearfix"/>

                            <div>
                                <label >Kích cỡ <span class="ty-tooltip-block"><a data-toggle="tooltip" title="<p>Chọn kích cỡ quan ao cho bé</p>">
                                        <i class="fa fa-question-circle"></i></a></span>: <span id="selected_size" class="highlight"></span></label>
                                <div class="list-size">

                                </div>
                            </div>
                            <br class="clearfix"/> <!-- add cart-->
                            <div id="block-cart">
                                <div class="">
                                    <div class="ty-qty clearfix">
                                        <label class="ty-control-group__label" for="qty_count_395879">Số lượng:</label>
                                        <select name="quantity" id="cb_quantity">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="total">
                            <div class="info">
                                <div class="like left">
                                    <i class="fa fa-thumbs-up"></i>
                                </div>
                                <div class="left">
                                    <!-- <span>So luong:</span> 1
                                    <br/>
                                    <span>Mau</span> Do
                                    <br/>
                                    <span>Size</span> X -->
                                    <div class="format-price">
                                    <input type="hidden" name="" value="<?php echo $product->price; ?>" />
                                      <strong class="price"></strong>  
                                    </div>
                                    
                                </div>

                            </div>
                            <div class="add-cart-button">
                                <div class="ty-product-block__button">
                                    <div class="cm-reload-395872 " id="add_to_cart_update_395872">
                                        <button id="add-to-cart" class="ty-btn__primary ty-btn__big ty-btn__add-to-cart cm-form-dialog-closer ty-btn" type="submit" name="dispatch[checkout.add..395872]">
                                            <i class="fa fa-shopping-cart"></i> <span>Thêm vào Giỏ</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="row multi-tabs">
    <div>
        <div class="row" style="text-align: center">

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1611276859129198";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <div class="fb-comments" data-href="http://thoitrangchobe.com.vn/Qun-o-b-gi-85" data-width="500" data-numposts="5"></div>
</div>
<div class="fb-like" data-href="http://thoitrangchobe.com.vn/Qun-o-b-gi-85" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
    </div>
</div>
<div class="row relative-product">
<div class="col-lg-1"></div>
    <div class="col-lg-10">
       <div id="owl-demo" class="owl-carousel owl-theme">
 
 <?php foreach ($product_relation as $key => $product) {
     # code...
 } ?>
          <div class="item">
           <div class="container-overlay">
                <a href="#" title="" class="img-product">
                    <img src="mg src="<?php echo site_url('img.php?src='.PATH_IMAGE_PRODUCT.$product->image.'&h=200'); ?>" alt="<?php echo $product->name; ?>">            
                </a>
                <div class="price-box ">
                    <a href="<?php echo site_url(url_title($product->name).'-'.$product->id); ?>">
                        <h3><?php echo $product->name; ?></h3>
                    </a>
                    <p>
                                    </p>
                    <ul class="list-unstyled list-inline wow lightSpeedIn" >                        
                        <li>
                            <p><strong><?php echo $product->price; ?></strong></p>
                        </li>
                    </ul>
                </div>
            </div>
          </div>
     
    </div>
    </div>
    <div class="col-lg-1"></div>
</div>
<br class="clearfix" />
<script>
    var size_by_color = '<?php echo json_encode($size_by_color);?>';
    var color_image = '<?php echo json_encode($color_image);?>';
    var size_name = '<?php echo json_encode($size_name);?>';
</script>
<!-- end feature-product -->

<div id="add-success" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pink-color">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Da them vao gio hang</h4>
            </div>
            <div class="modal-body">                
                
            </div>
            <div class="modal-footer">
                <div class="col-xs-6 col-lg-6 col-sm-6 left align-left payment">
                <a class="pink-color" href="/cart">Thanh toan</a></div>
                <div class="col-xs-6 col-lg-6 col-sm-6 right"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
</div>

<div id="frm-invalid" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Error</h4>
            </div>
            <div class="modal-body">
                <p></p>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                
            </div>
        </div>
    </div>
</div>
