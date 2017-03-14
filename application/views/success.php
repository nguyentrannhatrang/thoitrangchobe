<section>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <h2 class="wow bounceInDown" data-wow-duration="2s">Thank you</h2>
                <div class="border"></div>
            </div>
        </div>
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="<?php echo site_url('/'); ?>">Home</a></li>
                    <li class="active">Cảm ơn</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <p>
                    Lời cảm ơn ......
                </p>
            </div>

        </div>
        <div class="row traveller-info">
            <div class="col-lg-3 col-sm-12 col-xs-12">
                <label>Tên khách hàng:</label>
            </div>
            <div class="col-lg-9 col-sm-12 col-xs-12">
                <p><?php echo $traveller->name; ?></p>
            </div>
            <div class="col-lg-3 col-sm-12 col-xs-12">
                <label>Số điện thoại:</label>
            </div>
            <div class="col-lg-9 col-sm-12 col-xs-12">
                <p><?php echo $traveller->phone; ?></p>
            </div>
            <div class="col-lg-3 col-sm-12 col-xs-12">
                <label>Email:</label>
            </div>
            <div class="col-lg-9 col-sm-12 col-xs-12">
                <p><?php echo $traveller->email; ?></p>
            </div>
            <div class="col-lg-3 col-sm-12 col-xs-12">
                <label>Địa chỉ:</label>
            </div>
            <div class="col-lg-9 col-sm-12 col-xs-12">
                <p><?php echo $traveller->address; ?></p>
            </div>
        </div>
        <?php $row = 0;?>
        <?php foreach ($list_item as $size => $data) {?>
        <div class="row-item row <?php echo ($row%2==0?'row-chan':'row-le');$row++; ?>" >
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
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-12 price">
                <div class="format-price">
                    <input type="hidden" value="<?php echo $data['price']*$data['quantity']; ?>"/>
                    <strong class="price"> </strong>
                </div>
            </div>
        </div>
<?php }?>
        <div class="row-total row">
            <div class="col-lg-12 col-xs-12 col-sm-12 right">
                <div class="col-lg-12 col-xs-12 col-sm-12 price">
                    <strong>Total</strong>
                </div>
                <div class="col-lg-12 col-xs-12 col-sm-12 price">
                    <div class="format-price">
                        <input type="hidden" value="<?php echo $total; ?>"/>
                        <strong class="price"></strong>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>