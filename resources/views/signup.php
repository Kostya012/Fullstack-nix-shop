<?php include ROOT.'/resources/views/layouts/header.php'; ?>
<?php include ROOT.'/resources/views/layouts/aside.php'; ?>
<div class="gold">New User Signup</div>
          <div class="signup-form">
            <form class="form" action="#" method="post">
              <div class="form-group">
                <label for="name">Your name</label>
                <input type="text" name="name" id="name" placeholder="Name" />
              </div>
              <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" name="email" id="email" placeholder="Email Address" />
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" />
              </div>
              <button type="submit" class="btn btn-default">Signup</button>
            </form>
          </div>
        </div>
      </main>
    </div>
    <a class="back-to-top" title="Go up" href="#top"></a>