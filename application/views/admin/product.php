<div class="row">
    <div class="col-lg-12">
        <form method="post" action="<?php echo site_url('admin/products/save'); ?>" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo !empty($product) ? $product->id : ''; ?>">
            <section class="panel">
                <header class="panel-heading">
                    <?php if (!empty($product) && !empty($product->image)) { ?>
                        <img src="<?php echo site_url('img.php?src=uploads/product/'.$product->image); ?>" height="50" class="m-r-lg">
                    <?php } ?>
                    <span class="h4"><?php echo !empty($product) ? $product->name : 'Nou produs'; ?></span>
                </header>
                <div class="panel-body"><p class="text-muted"></p>
                    <div class="form-group">
                        <label>Name *</label>
                        <input type="text" name="name" required class="form-control" value="<?php echo !empty($product) ? $product->name : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control"><?php echo !empty($product) ? $product->description : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Category *</label>
                        <select name="category" required class="form-control">
                            <option value="">All categories</option>
                            <?php if (!empty($categories)) { ?>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category->id; ?>" <?php echo !empty($product) && $product->category == $category->id ? 'selected' : ''; ?> ><?php echo $category->name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price *</label>
                        <input type="text" name="price" required class="form-control" value="<?php echo !empty($product) ? $product->price : ''; ?>">
                    </div>
                    <div class="form-group" id="list-images">
                        <label>Image</label>
                        <br class="clear"/>
                        <?php for($i = 0;$i<10;$i++){?>
                            <div class="row">
                                <div class="col-md-20 col-xs-4 left" style="height: 50px">
                                    <input type="file" name="image[]" class="form-control">
                                </div>
                                <div class="col-md-1 col-xs-1 left">
                                    <input type="checkbox"  style="height: 50px" name="delete_image[<?php echo $i; ?>]">
                                </div>
                                <div class="col-md-15 col-xs-3 left">
                                    <?php if(isset($images[$i])){ ?>
                                        <img height="50" class="m-r-lg" src="<?php echo $images[$i];?>">
                                    <?php }?>
                                </div>
                                <br class="clear"/>
                            </div>
                        <?php }?>
                    </div>
                    <div class="form-group" id="list-detail">
                        <table width="100%" border="1">
                            <tr>
                                <?php $countSize = count($array_size) + 1; ?>
                                <th style="text-align: center" width="<?php echo intval(100/$countSize); ?>">Color/Size</th>
                                <?php foreach ($array_size as $code_size=>$value_size) {?>
                                    <th style="text-align: center" width="<?php echo intval(100/$countSize); ?>"><?php echo $value_size; ?></th>
                                <?php }?>
                            </tr>
                            <?php foreach ($array_color as $code_color=>$value_color) {?>
                                <tr>
                                    <td style="text-align: center"><?php echo $value_color; ?></td>
                                    <?php foreach ($array_size as $code_size=>$value_size) {?>
                                        <td style="text-align: center" width="<?php echo intval(100/$countSize); ?>">
                                            <input type="number" name="product_detail[<?php echo $code_color; ?>][<?php echo $code_size; ?>]"/>
                                        </td>
                                    <?php }?>
                                </tr>
                            <?php }?>
                        </table>
                    </div>
                    <div class="form-group form-checkbox">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="active" value="1" <?php echo ((!empty($product) && $product->active == 1) || empty($product)) ? 'checked' : ''; ?>>
                                In stoc
                            </label>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer text-right bg-light lter">
                    <a href="<?php echo site_url('admin/products'); ?>" class="btn btn-s-xs">Cancel</a>
                    <?php if (!empty($product)) { ?>
                        <a href="<?php echo site_url('admin/products/delete/'.$product->id); ?>" class="confirm btn btn-danger btn-s-xs">Delete</a>
                    <?php } ?>
                    <button type="submit" class="btn btn-success btn-s-xs">Save</button>
                </footer>
            </section>
        </form>
    </div>
</div>