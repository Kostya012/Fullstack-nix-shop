<?php include ROOT . '/resources/views/layouts/header.php'; ?>
<?php include ROOT . '/resources/views/layouts/aside.php'; ?>
<div class="gold">Account editing</div>

<?php if ($result): ?>
    <div class="signup-form">
        <p class="title-product-details">Congratulations, new data saved!</p>
    </div>
<?php else: ?>

    <?php if (isset($errors) && is_array($errors)): ?>
        <div class="signup-form">
            <ul class="error">
                <?php foreach ($errors as $error): ?>
                    <li class="menu-item"> - <?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="signup-form">
        <form class="form" action="" method="post">
            <div class="form-group">
                <label for="name">Your name</label>
                <input type="text" name="name" id="name" placeholder="Name" value="<?= $name; ?>"/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" value="<?= $password; ?>"/>
            </div>
            <button type="submit" name="submit" class="btn btn-default">Save</button>
        </form>
    </div>
<?php endif; ?>
</div>
</main>
</div>
<a class="back-to-top" title="Go up" href="#top"></a>