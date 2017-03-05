<div id="checkout-page">
    <form method="post" action="<?php echo site_url('products/checkout'); ?>">
        <div class="container">
            <div class="row">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('/'); ?>">Home</a></li>
                        <li class="active">Your cart</li>
                    </ol>
                </div>
            </div>
            <?php foreach ($items as $$product => $dataColor) {
                foreach ($dataColor as $color => $dataSize) {
                    foreach ($dataSize as $size => $data) {
                        # code...
                    }
                    # code...
                }
                # code...
            } ?>


            <div class="row row-chan">
                <div class="col-lg-3 col-xs-12 col-sm-12">
                    <img src="http://shop.local/img.php?src=uploads/product/810-pink-shirt-thumb.jpg&h=120" width="80px" height="120px"/>
                </div>
                <div class="col-lg-6 col-xs-12 col-sm-12">
                    <strong> ten sp</strong>
                    <p> Color</p>
                    <p> Size</p>
                    <p> So luong</p>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-12 price">
                    <strong> 100.000</strong>
                </div>
            </div>
            <div class="row row-le">
                <div class="col-lg-3 col-xs-12 col-sm-12">
                    <img src="http://shop.local/img.php?src=uploads/product/810-pink-shirt-thumb.jpg&h=120" width="80px" height="120px"/>
                </div>
                <div class="col-lg-6 col-xs-12 col-sm-12">
                    <strong> ten sp</strong>
                    <p> Color</p>
                    <p> Size</p>
                    <p> So luong</p>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-12 price">
                    <strong> 100.000</strong>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-6 col-xs-12 col-sm-12 align-right visible-xs visible-sm">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12 total-info">
                            Tổng tiền
                        </div>
                        <div class="col-lg-12 col-xs-12 col-sm-12 total-info">
                            2000000
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12 col-sm-12 user-info">
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-sm-12">
                            Ten khach hang  <a data-toggle="tooltip" title='Tên khách hàng để liên hệ'><span class="fnt-16 red">*</span></a>
                        </div>
                        <div class="col-lg-8 col-xs-12 col-sm-12">
                            <input type="text" name="name" required class="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-sm-12">
                            Email  <a data-toggle="tooltip" title='Email để liên hệ'><span class="fnt-16 red">*</span></a>
                        </div>
                        <div class="col-lg-8 col-xs-12 col-sm-12">
                            <input type="email" name="email" required class="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-sm-12">
                            So dien thoai  <a data-toggle="tooltip" title='Số điện thoại để liên hệ'><span class="fnt-16 red">*</span></a>
                        </div>
                        <div class="col-lg-8 col-xs-12 col-sm-12">
                            <input type="text" name="telephone" required class="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-sm-12">
                            Địa chỉ <a data-toggle="tooltip" title='Địa chỉ để giao hàng'><span class="fnt-16 red">*</span></a>
                        </div>
                        <div class="col-lg-8 col-xs-12 col-sm-12">
                            <input type="text" name="address" required class="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-sm-12">
                            Lời nhắn
                        </div>
                        <div class="col-lg-8 col-xs-12 col-sm-12">
                            <textarea name="message" style="width: 100%" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12 col-sm-12 align-right hidden-xs hidden-sm">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12 total-info">
                            Tổng tiền
                        </div>
                        <div class="col-lg-12 col-xs-12 col-sm-12 total-info">
                            2000000
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12 align-right" >
                    <button type="submit" class="btn btn-default check_out">Trimite comanda</button>
                </div>
            </div>

        </div>
    </form>
</div>
