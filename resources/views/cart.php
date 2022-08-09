<div class="gold">Shopping Cart</div>
          <div class="prod100">
            <table>
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($data as $item): ?>
                <tr>
                  <td>
                    <div class="inline-div">
                      <div class="wrapper-product">
                        <img
                          class="img-logo-150"
                          src="resources/img/home/<?= $item['img'];?>"
                          alt="<?= $item['name'];?>"
                        />
                      </div>
                    </div>
                    <div class="inline-div">
                      <p class="title-product"><?= $item['name'];?></p>
                      <p>Product code: <?= $item['id'];?></p>
                    </div>
                  </td>
                  <td>
                    $ <?= $item['price'];?>
                  </td>
                  <td>
                    <input type="text" name="quantity" min="1" max="<?= $item['quantity'];?>" value="1" size="2" />
                  </td>
                  <td>
                    <h2 class="price">US $ <?= $item['price'];?></h2>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <div class="total">
              <span>Total</span>
              <span>$ <?= $total;?></span>
            </div>
            <button type="submit">Pay</button>
          </div>
        </div>
      </main>
    </div>
    <a class="back-to-top" title="Go up" href="#top"></a>