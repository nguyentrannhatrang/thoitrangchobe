<div id="checkout-page">
    <form method="post" id="frm-checkout" action="<?php echo site_url('checkout/submit'); ?>">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <h2 class="wow bounceInDown" data-wow-duration="2s">Checkout</h2>
                    <div class="border"></div>
                </div>
            </div>
            <div class="row">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('/'); ?>">Home</a></li>
                        <li class="active">Your cart</li>
                    </ol>
                </div>
            </div>
            <?php $row = 0; $totalPrice = 0; ?>
            <?php foreach ($items as $product => $dataColor) {
                foreach ($dataColor as $color => $dataSize) {
                    foreach ($dataSize as $size => $data) {?>
                        <div class="row-item row <?php echo ($row%2==0?'row-chan':'row-le');$row++; ?>" id="<?php echo $product.'-'.$color.'-'.$size; ?>">
                            <div class="col-lg-3 col-xs-12 col-sm-12">
                                <img src="<?php echo $data['url']?>" width="80px" height="120px"/>
                            </div>
                            <div class="col-lg-6 col-xs-12 col-sm-12">
                                <p class="product-name">
                                <strong ><?php echo $data['name']; ?></strong>
                                </p>
                                <p>Màu sắc: <?php echo $data['color']; ?></p>
                                <p>Cỡ size: <?php echo $data['size']; ?></p>
                                <p>Số lượng: <?php echo $data['quantity']; ?></p>
                                <!--<p>
                                    <select name="quantity[<?php /*echo $product.'-'.$color.'-'.$size; */?>]">
                                        <?php /*for ($i=1; $i<=$data['quantity'] ; $i++) { */?>
                                        <option value="<?php /*echo $i;*/?>" <?php /*$i ==$data['quantity']?'selected':'';*/?>> <?php /*echo $i;*/?></option>
                                        <?php /*} */?>
                                    </select>
                                </p>-->
                            </div>
                            <div class="col-lg-3 col-xs-12 col-sm-12 price">
                            <div class="icon-delete hide" id="delete-<?php echo $product.'-'.$color.'-'.$size; ?>">
                                <span class="id-delete hide"><?php echo $product.'-'.$color.'-'.$size; ?></span>
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </div>
                                <div class="format-price">
                                    <input type="hidden" value="<?php echo $data['price']*$data['quantity']; ?>">
                                    <?php $totalPrice += (float)($data['price']*$data['quantity']); ?>
                                <strong class="price"> </strong>
                                </div>
                            </div>
                        </div>
                   <?php }
                    # code...
                }
                # code...
            } ?>            
            <br/>
            <div class="row">
                <div class="col-lg-6 col-xs-12 col-sm-12 align-right visible-xs visible-sm">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12 total-info">
                            Tổng tiền
                        </div>
                        <div class="col-lg-12 col-xs-12 col-sm-12 total-info format-price">
                            <input type="hidden" value="<?php echo $totalPrice; ?>">
                            <strong class="price"> </strong>
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
                        <div class="col-lg-12 col-xs-12 col-sm-12 total-info format-price">
                            <input type="hidden" value="<?php echo $totalPrice; ?>">
                            <strong class="price"> </strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12 align-right" >
                    <button type="submit" class="btn btn-default " id="check_out">Đặt hàng</button>
                </div>
            </div>

        </div>
    </form>
</div>
<div id="popup-delete-confirm" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Xác nhận</h4>
            </div>
            <div class="modal-body">
                <p>
                    Bạn có chắc muốn xóa?
                </p>
                <input type="hidden" id="confirm-id-delete" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="button" class="btnbtn-primary" id="btn-delete" data-dismiss="modal">Đồng ý</button>
            </div>
        </div>
    </div>
</div>
<div id="popup-error" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Lỗi</h4>
            </div>
            <div class="modal-body">
                <p>
                    
                </p>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>
    <?php
        if($this->session->flashdata('error') != '') {?>
    var error_text = "<?php echo $this->session->flashdata('error') ; ?>";
    <?php }
    ?>
</script>
