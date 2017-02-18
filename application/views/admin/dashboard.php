<div class="row">
    <div class="col-lg-2">
        <section class="panel no-borders hbox">
            <aside class="bg-primary r-l text-center v-middle">
                <a href="<?php echo site_url('admin/categories/create'); ?>">
                    <div class="wrapper"><i class="fa fa-plus fa-2x"></i></div>
                </a>
            </aside>
            <aside>
                <div class="wrapper text-center">
                    <p class="h1"><?php echo $categories_total; ?></p>
                    <span>Categories</span>
                </div>
            </aside>
        </section>
    </div>
    <div class="col-lg-2">
        <section class="panel no-borders hbox">
            <aside class="bg-success r-l text-center v-middle">
                <a href="<?php echo site_url('admin/products/create'); ?>">
                    <div class="wrapper"><i class="fa fa-plus fa-2x"></i></div>
                </a>
            </aside>
            <aside>
                <div class="wrapper text-center">
                    <p class="h1"><?php echo $products_total; ?></p>
                    <span>Products</span>
                </div>
            </aside>
        </section>
    </div>
    <div class="col-lg-4">
        <section class="panel no-borders hbox">
            <aside>
                <div class="wrapper text-center">
                    <p class="h1"><?php echo $orders_today_total; ?></p>
                    <span>Order today</span>
                </div>
            </aside>
        </section>
    </div>
    <div class="col-lg-4">
        <section class="panel no-borders hbox">
            <aside>
                <div class="wrapper text-center">
                    <p class="h1"><?php echo $orders_total; ?></p>
                    <span>Comments total</span>
                </div>
            </aside>
        </section>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <span class="label bg-danger pull-right"><!--4 neprocesate--></span>
                <span class="h4">Lastest 20 comments</span>
            </header>
            <table class="table m-b-none text-sm">
                <thead>
                    <tr>
                        <th>Products</th>
                        <th>Total</th>
                        <th>Contact</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th width="70"></th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($orders)) { ?>
                    <?php foreach ($orders as $order) { ?>
                        <tr class="alert-<?php echo $order->processed == Order_model::PROCESSED_NEW ? 'warning' : 'success'; ?>">
                            <td>
                                <?php foreach ($order->order_array['products'] as $product) { ?>
                                    <?php echo $product['name'] . ' x' . $product['quantity'] . ' = ' . $product['total'] . ' Lei'; ?>
                                    <br>
                                <?php } ?>
                            </td>
                            <td><?php echo $order->order_array['total']; ?> <?php if (!empty($general->currency)) echo $general->currency ?></td>
                            <td>
                                <?php echo !empty($order->order_array['name']) ? 'Name: ' . $order->order_array['name'] . '<br>' : ''; ?>
                                <?php echo !empty($order->order_array['email']) ? 'Email: ' . $order->order_array['email'] . '<br>' : ''; ?>
                                <?php echo !empty($order->order_array['telephone']) ? 'Telephone: ' . $order->order_array['telephone'] . '<br>' : ''; ?>
                                <?php echo !empty($order->order_array['address']) ? 'Address: ' . $order->order_array['address'] . '<br>' : ''; ?>
                            </td>
                            <td><?php echo $order->order_array['message']; ?></td>
                            <td><?php echo date('H:i, d M Y', strtotime($order->date)); ?></td>
                            <td>
                                <button type="submit" name="processed" class="btn btn-success"
                                        value="<?php echo Order_model::PROCESSED_COMPLETED; ?>">Finish
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </section>
    </div>
</div>