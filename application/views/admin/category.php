<div class="row">
    <div class="col-lg-12">
        <form method="post" action="<?php echo site_url('admin/categories/save'); ?>">
            <input type="hidden" name="id" value="<?php echo !empty($category) ? $category->id : ''; ?>">
            <section class="panel">
                <header class="panel-heading"><span class="h4"><?php echo !empty($category) ? $category->name : 'New Category'; ?></span></header>
                <div class="panel-body"><p class="text-muted"></p>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo !empty($category) ? $category->name : ''; ?>" placeholder="ex: Detergenti, Cadouri">
                    </div>
                </div>
                <footer class="panel-footer text-right bg-light lter">
                    <a href="<?php echo site_url('admin/categories'); ?>" class="btn btn-s-xs">Cancel</a>
                    <?php if (!empty($category)) { ?>
                        <a href="<?php echo site_url('admin/categories/delete/'.$category->id); ?>" class="confirm btn btn-danger btn-s-xs">Delete</a>
                    <?php } ?>
                    <button type="submit" class="btn btn-success btn-s-xs">Save</button>
                </footer>
            </section>
        </form>
    </div>
</div>