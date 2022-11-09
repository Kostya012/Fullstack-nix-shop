<?php include ROOT.'/resources/views/layouts/header.php'; ?>
<?php include ROOT.'/resources/views/layouts/aside.php'; ?>
<div class="gold">Product details</div>
          <div class="prod50">
            <div class="wrapper-product">
            <?php if ($data['new']): ?>
              <div class="new"></div>
            <?php else: ?>
              <?php if ($data['sale']): ?>
                <div class="sale"></div>
              <?php endif; ?>
            <?php endif; ?>
              <img
                class="img-logo-details"
                src="/resources/img/products/<?= $data['img'];?>"
                alt="<?= $data['name'];?>"
              />
            </div>
          </div>
          <div class="prod50">
              <div class="wrapper-product">
            <p class="title-product-details"><?= $data['name'];?></p>
            <p>Product code: <?= $data['id'];?></p>
            <?php if ($data['quantity']): ?>
              <h2 class="price">$ <?= $data['price'];?></h2>
              <label for="quantity">Quantity:</label>
              <input type="text" name="quantity" id="quantity" min="1" max="<?= $data['quantity'];?>" value="1" size="4" />
            <?php else: ?>
              <h2>The product is out of stock</h2>
            <?php endif; ?>
            <div class="condition">
            <?php if ($data['quantity']): ?>
              <p class="condition-p">
                <b class="bold">Availability:</b> In stock
              </p>
            <?php else: ?>
              <p class="condition-p">
                <b class="bold">Availability:</b> Out of stock
              </p>
            <?php endif; ?>
              <p class="condition-p"><b class="bold">Condition:</b> <?= $data['condition'];?></p>
              <p class="condition-p"><b class="bold">Manufacturer:</b> <?= $data['manufacturer'];?></p>
            </div>
            <?php if ($data['quantity']): ?>
              <div class="add-to-cart">
                <a href="#">
                  <img class="cart" src="/resources/img/cart.png" alt="" />
                  Add to cart
                </a>
              </div>
            <?php endif; ?>
              </div>
          </div>
          <div class="prod100">
            <div class="condition">
              <p class="condition-p">
                <b class="bold">Product description:</b>
              </p>
              <p class="condition-p"><?= $data['describe'];?></p>
            </div>
          </div>
        </div>
      </main>
    </div>
    <a class="back-to-top" title="Go up" href="#top"></a>