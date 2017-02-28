<div class="row">
    <div class="col-lg-12">
        <form method="post" action="<?php echo site_url('admin/products/saveDescription'); ?>" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo !empty($product) ? $product->id : ''; ?>">
            <section class="panel">
                <header class="panel-heading">
                    <?php if (!empty($product) && !empty($product->image)) { ?>
                        <img src="<?php echo site_url('img.php?src='.PATH_IMAGE_PRODUCT.$product->image); ?>" height="50" class="m-r-lg">
                    <?php } ?>
                    <span class="h4"><?php echo !empty($product) ? $product->name : 'Nou produs'; ?></span>
                </header>
                <div class="panel-body"><p class="text-muted"></p>
                    <div class="form-group">
                        <label>Name</label>
                        <h3><?php echo !empty($product) ? $product->name : ''; ?></h3>
                    </div>                   
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control tinymce-editor"><?php echo !empty($product) ? $product->description : ''; ?></textarea>
                    </div> 
                </div>
                <footer class="panel-footer text-right bg-light lter">
                    <a href="<?php echo site_url('admin/products'); ?>" class="btn btn-s-xs">Cancel</a>
                    <button type="submit" class="btn btn-success btn-s-xs">Save</button>
                </footer>
            </section>
        </form>
    </div>
</div>