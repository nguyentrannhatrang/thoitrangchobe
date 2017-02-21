<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <span class="h4">Pages</span>
                <a class="btn btn-xs btn-success pull-right"
                   href="<?php echo site_url('admin/pages/create'); ?>">New</a>
            </header>

            <div class="panel-body">
                <?php if (!empty($pages)) { ?>
                    <table class="table table-responsive m-b-none text-sm">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th width="599">Description</th>
                            <th width="120">Date</th>
                            <th width="100"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($pages as $page) { ?>
                            <tr>
                                <td><?php echo !empty($page->image) ? '<img height="25" src="' . site_url('img.php?src='.PATH_IMAGE_PRODUCT . $page->image) . '">' : ''; ?></td>
                                <td><?php echo $page->title; ?></td>
                                <td><?php echo character_limiter($page->content, 300); ?></td>
                                <td><?php echo date('d M Y', strtotime($page->date)); ?></td>
                                <td><a href="<?php echo site_url('admin/pages/edit/' . $page->id); ?>"
                                       class="btn btn-xs btn-info">Edit</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="alert alert-warning">
                        <p>La moment nu sunt pagini.</p>
                    </div>
                <?php } ?>
            </div>
        </section>
    </div>
</div>