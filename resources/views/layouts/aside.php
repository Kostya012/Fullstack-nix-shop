<div class="wrapper">
    <main>
        <div class="aside">
            <div class="gold">Categories</div>
            <ul class="menu">
                <?php foreach ($categories as $item): ?>
                    <li class="menu-item">
                        <a href="/products/<?= $item['name']; ?>/"
                            <?php if (isset($category)) {
                                if ($category == $item['name']) {
                                    echo ' class="active"';
                                }
                            }?>
                        ><?= ucfirst($item['name']); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="content">