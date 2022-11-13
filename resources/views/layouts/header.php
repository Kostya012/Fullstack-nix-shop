<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Kostiantyn Shevtsov" />
    <link rel="shortcut icon" href="/resources/img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/resources/css/reset.css" />
    <link rel="stylesheet" href="/resources/css/header.css" />
    <link rel="stylesheet" href="/resources/css/main.css" />
    <title>02 Nix-shop 2022</title>
  </head>

  <body>
    <header>
      <div class="logo-nix">
        <a href="https://www.nixsolutions.com/ua/" target="_blank">
          <img src="/resources/img/shop.png" alt="Nix-shop" />
          <img src="/resources/img/nix-logo-new.svg" alt="Nix" />
        </a>
      </div>
      <div class="nav" id="slow_nav">
        <ul class="navbar">
          <li class="blog-nav">
            <a class="blog-nav-item<?= $hiconIndex ?>" href="/home">
              <div class="hicon-index"></div>
              Home page
            </a>
            <a class="blog-nav-item<?= $hiconProducts ?>" href="/products">
              <div class="hicon-products"></div>
                Categories
            </a>
            <a class="blog-nav-item<?= $hiconCart ?>" href="/cart">
              <div class="hicon-cart"></div>
              Shopping Cart
            </a>
          </li>
          <li class="blog-nav" id="reg">
              <?php if(User::isGuest()): ?>
            <a class="blog-nav-item<?= $hiconSignIn ?>" id="signIn" href="/login">
              <div class="sign-in">
                <div>Sign in</div>
              </div>
            </a>
            <a class="blog-nav-item<?= $hiconSignUp ?>" id="signUp" href="/signup">
              <div class="sign-up">
                <div class="border-sign-up">Sign up</div>
              </div>
            </a>
              <?php else: ?>
              <a class="blog-nav-item<?= $hiconUser ?>" id="user" href="/cabinet">
                  <div class="hicon-user"></div>
                  User account
              </a>
              <a class="blog-nav-item" id="logout" href="/logout">
                  <div class="sign-in">
                      <div>Logout</div>
                  </div>
              </a>
              <?php endif; ?>
          </li>
        </ul>
        <div class="article">
          <h1 id="article"><?= $article ?></h1>
        </div>
      </div>
    </header>