<section id="form">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2>Login</h2>
                    <form action="<?php echo site_url('user/login'); ?>" method="post">
                        <input type="email" name="email" placeholder="Email" />
                        <input type="password" name="password" placeholder="Password" />
							<span>
								<input type="checkbox" name="remember" value="1" class="checkbox">
								Remember me activated
							</span>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-1">
                <h2 class="or">Ori</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <h2>Create user!</h2>
                    <form action="<?php echo site_url('user/register'); ?>" method="post">
                        <input type="text" name="name" placeholder="Name"/>
                        <input type="email" name="email" placeholder="Email"/>
                        <input type="text" name="telephone" placeholder="Telephone"/>
                        <input type="text" name="address" placeholder="Address"/>
                        <input type="password" name="password" placeholder="Password"/>
                        <button type="submit" class="btn btn-default">Registry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>