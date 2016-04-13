<?php include "Session.php"?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="icon" type="image/png" href="favicon.png">
        <title>Shopping Cart PHP</title>
    </head>
<body>

    <nav>
        <div class="nav-wrapper red">
            <div class="container">
                <a href="index.php" class="brand-logo">Amazing E-Books</a>
                <a href="#" data-activates="mobile-nav" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
                <ul class="side-nav" id="mobile-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </div>
        </div>
    </nav>