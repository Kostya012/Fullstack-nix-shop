<div class="gold">Categories</div>
<?php foreach ($data as $item): ?>
    <div class="prod20">
        <a class="categories" href="/products/<?= $item['name']; ?>">
            <div class="wrapper-product">
                <img
                        class="img-logo"
                        src="resources/img/aside/<?= $item['name']; ?>.svg"
                        alt="<?= $item['name']; ?>"
                />
            </div>
            <h2 class="price"><?= ucfirst($item['name']); ?></h2>
        </a>
    </div>
<?php endforeach; ?>
</div>
</main>
</div>
<a class="back-to-top" title="Go up" href="#top"></a>