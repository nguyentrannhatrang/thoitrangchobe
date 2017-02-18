<div class="row m-n">
    <div class="col-md-4 col-md-offset-4 m-t-lg">
        <section class="panel">
            <header class="panel-heading text-center"><span class="h4">Login</span></header>
            <form action="<?php echo site_url('admin/users/login'); ?>" method="post" class="panel-body">
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input type="email" name="email" placeholder="test@example.com" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Password</label>
                    <input type="password" name="password" placeholder="*******" class="form-control" required>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox"> Remeber. </label>
                </div>
                <button type="submit" class="btn btn-info">Login</button>
        </section>
    </div>
</div>