<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <span class="h4">comments</span>
            </header>
            <table class="table m-b-none text-sm">
                <thead>
                <tr>
                    <th>Products</th>
                    <th>Total</th>
                    <th>Contact</th>
                    <th>Message</th>
                    <th>Contact</th>
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