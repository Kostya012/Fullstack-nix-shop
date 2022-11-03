<div class="gold"><?= ucfirst($data['article']);?></div>
<?php foreach ($data['lists'] as $item): ?>
          <div class="prod30">
              <a href="/products/<?= $item['category']; ?>/<?= $item['id']; ?>">
            <div class="wrapper-product">
            <?php if ($item['new']): ?>
              <div class="new"></div>
            <?php else: ?>
              <?php if ($item['sale']): ?>
                <div class="sale"></div>
              <?php endif; ?>
            <?php endif; ?>
              <img
                class="img-logo"
                src="/resources/img/products/<?= $item['img'];?>"
                alt="<?= $item['name'];?>"
              />
            </div>
            <?php if ($item['quantity']): ?>
              <h2 class="price">$ <?= $item['price'];?></h2>
            <?php else: ?>
              <h2>The product is out of stock</h2>
            <?php endif; ?>
            <p class="title-product"><?= $item['name'];?></p>
            <?php if ($item['quantity']): ?>
              </a>
              <div class="add-to-cart">
                <a href="#">
                  <img class="cart" src="/resources/img/cart.png" alt="" />
                  Add to cart
                </a>
              </div>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
          <div class="pagination">
            <ul class="pagination-ul">
              <li class="pagination-active"><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">»</a></li>
            </ul>
          </div>
        </div>
      </main>
    </div>
    <a class="back-to-top" title="Go up" href="#top"></a>