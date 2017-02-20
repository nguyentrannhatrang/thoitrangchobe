<div class="row">
    <div class="col-lg-12">
        <form method="post" action="<?php echo site_url('admin/products/save'); ?>" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo !empty($product) ? $product->id : ''; ?>">
            <section class="panel">
                <header class="panel-heading">
                    <?php if (!empty($product) && !empty($product->image)) { ?>
                        <img src="<?php echo site_url('img.php?src=uploads/'.$product->image); ?>" height="50" class="m-r-lg">
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
                        <input type="file" name="image[]" class="form-control"><input type="checkbox" name="delete_image[0]">
                        <input type="file" name="image[]" class="form-control"><input type="checkbox" name="delete_image[1]">
                        <input type="file" name="image[]" class="form-control"><input type="checkbox" name="delete_image[2]">
                        <input type="file" name="image[]" class="form-control"><input type="checkbox" name="delete_image[3]">
                        <input type="file" name="image[]" class="form-control"><input type="checkbox" name="delete_image[4]">
                        <input type="file" name="image[]" class="form-control"><input type="checkbox" name="delete_image[5]">
                        <input type="file" name="image[]" class="form-control"><input type="checkbox" name="delete_image[6]">
                        <input type="file" name="image[]" class="form-control"><input type="checkbox" name="delete_image[7]">
                        <input type="file" name="image[]" class="form-control"><input type="checkbox" name="delete_image[]">
                        <input type="file" name="image[]" class="form-control"><input type="checkbox" name="delete_image[]">
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