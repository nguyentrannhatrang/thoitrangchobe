<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <span class="h4">Booking</span>
            </header>
            <div class="row">
                <form action="" method="post">
                    <div class="col-lg-3">
                        <select name="filter-date">
                            <option value="1" <?php echo $search_date == 1?'selected':'';?>>
                                Today
                            </option>
                            <option value="2" <?php echo $search_date == 2?'selected':'';?>>
                                Yesterday
                            </option>
                            <option value="3" <?php echo $search_date == 3?'selected':'';?>>
                                This week
                            </option>
                        </select>
                    </div>
                    <div>
                        <button value="" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table m-b-none text-sm">
                        <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="20%">Traveller</th>
                            <th width="15%">Date</th>
                            <th width="10%">Total</th>
                            <th width="10%">Quantity</th>
                            <th width="20%">Status</th>
                            <th width="15%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php global $ARRAY_STATUS_BK;
                        if (!empty($bookings)) { ?>
                            <?php foreach ($bookings as $arr) {
                                /** @var Booking_model $booking */
                                $booking = $arr['booking'];
                                /** @var Traveller_model $traveller */
                                $traveller = $arr['traveller'];
                                ?>
                                <tr class="alert-success">
                                    <td>
                                        <?php echo $booking->id; ?>
                                    </td>
                                    <td><?php echo $traveller->name; ?></td>
                                    <td>
                                        <?php echo date('d M Y', $booking->created); ?>
                                    </td>
                                    <td><?php echo $booking->total; ?></td>
                                    <td><?php echo $booking->quantity; ?></td>
                                    <td><?php echo isset($ARRAY_STATUS_BK[$booking->status])?$ARRAY_STATUS_BK[$booking->status]:''; ?></td>
                                    <td>
                                        <a href="/admin/order?refno=<?php echo $booking->id; ?>">Edit</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
</div>