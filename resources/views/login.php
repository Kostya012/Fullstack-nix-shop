<?php include ROOT . '/resources/views/layouts/header.php'; ?>
<?php include ROOT . '/resources/views/layouts/aside.php'; ?>
<div class="gold">Login to your account</div>
<?php if (isset($errors) && is_array($errors)): ?>
    <div class="signup-form">
        <ul class="error">
            <?php foreach ($errors as $error): ?>
                <li class="menu-item"> - <?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<div class="login-form">
    <!--login form-->
    <form class="form" action="" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email Address"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password"/>
        </div>
        <div class="form-group">
                <span>
                  <input type="checkbox" name="keepMe" class="checkbox"/>
                    <label for="keepMe">Keep me signed in</label>
                </span>
        </div>
        <button type="submit" name="submit" class="btn btn-default">Login</button>
    </form>
</div>
</div>
</main>
</div>
<a class="back-to-top" title="Go up" href="#top"></a>