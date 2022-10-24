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
        <a href="https://www.nixsolutions.com/ru/" target="_blank">
          <img src="/resources/img/shop.png" alt="Nix-shop" />
          <img src="/resources/img/nix-logo-new.svg" alt="Nix" />
        </a>
      </div>
      <div class="nav" id="slow_nav">
        <ul class="navbar">
          <li class="blog-nav">
            <a class="blog-nav-item<?= $hiconIndex ?>" href="/index.php">
              <div class="hicon-index"></div>
              Home page
            </a>
            <a class="blog-nav-item" href="/products.php">
              <div class="hicon-products"></div>
                Categories
            </a>
            <a class="blog-nav-item<?= $hiconCart ?>" href="/cart.php">
              <div class="hicon-cart"></div>
              Shopping Cart
            </a>
            <a class="blog-nav-item" href="/product-details.php">
              <div class="hicon-product-details"></div>
              Product details
            </a>
          </li>
          <li class="blog-nav" id="reg">
            <a class="blog-nav-item<?= $hiconSignIn ?>" id="signIn" href="/login.php">
              <div class="sign-in">
                <div>Sign in</div>
              </div>
            </a>
            <a class="blog-nav-item<?= $hiconSignUp ?>" id="signUp" href="/signup.php">
              <div class="sign-up">
                <div class="border-sign-up">Sign Up</div>
              </div>
            </a>
          </li>
        </ul>
        <div class="article">
          <h1 id="article"><?= $article ?></h1>
        </div>
      </div>
    </header>