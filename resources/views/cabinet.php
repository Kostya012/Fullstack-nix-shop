<?php include ROOT . '/resources/views/layouts/header.php'; ?>
<?php include ROOT . '/resources/views/layouts/aside.php'; ?>
<div class="gold">User account</div>
<div class="prod100">
    <p class="title-product-details">Hello, <?= $user['name']; ?>!</p>
</div>
<div class="prod50">
    <ul>
        <li class="menu-item">
            <a href="/cabinet/edit">Edit data</a>
        </li>
        <li class="menu-item">
            <a href="/cabinet/history">Shopping list</a>
        </li>

    </ul>
</div>

<div class="login-form">

</div>
</div>
</main>
</div>
<a class="back-to-top" title="Go up" href="#top"></a>