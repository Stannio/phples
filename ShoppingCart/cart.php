<?php
include "includes/header.php";
include "database.php";

    session_start();

    if(isset($_GET['re'])){
        echo "<script>window.location = 'cart.php'</script>";
    }

    if( isset($_GET['remove']) ){
        $_SESSION['cart_content'] = preg_replace('/'.$_GET['pid'].'/', '', $_SESSION['cart_content'], 1);
        $_SESSION['cart_content'] = preg_replace(',,', ',', $_SESSION['cart_content']);
        $_SESSION['cart_content'] = trim( $_SESSION['cart_content'], "," );
        header("Location: cart.php");
    }

    if( isset ( $_GET['pid'] ) && !isset( $_GET['remove'] )){
        if ( !isset( $_SESSION['cart_content'] ) ){
            $_SESSION['cart_content'] = $_GET['pid'];
        }else{
            $_SESSION['cart_content'] .= ',';
            $_SESSION['cart_content'] .= $_GET['pid'];
        }
    }

    if ( isset ( $_GET['empty'] )){
        session_destroy();
        header('Location: cart.php');
    }

    if ( $database_config['debug'] ){
        echo "<pre>";
        print_r( $_SESSION );
        echo "</pre>";
    }

    if ( isset( $_SESSION['cart_content'] ) ){
        if ( strlen($_SESSION['cart_content']) < 1 ){
            unset( $_SESSION['cart_content'] );
        }
    }

?>

    <div class="container">

        <h1>Producten in winkelwagen</h1>

        <div class="row">

            <?php

                if ( isset($_SESSION['cart_content']) ){
                    $cart_array = explode(',', $_SESSION['cart_content']);

                    if ( $database_config['debug'] ){
                        echo "<pre>";
                        print_r($cart_array);
                        echo "</pre>";
                    }
                    foreach ( $cart_array as $item ){
                        $query = "SELECT * FROM cart_producten WHERE id = ?";
                        $prepared_query = $conn->prepare($query);
                        $prepared_query->bindParam(1, $item);
                        $prepared_query->execute();
                        $product = $prepared_query->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <p class="col m4"><?php echo $product['naam'] ?></p>
                                <p class="col m4">&euro; <?php echo $product['prijs'] ?></p>
                                <a class="col m4" href="cart.php?remove=true&pid=<?php echo $product['id'] ?>">Remove</a>
                            </div>
                        </div>
                        <?php
                    }
                }

            ?>

        </div>
        <div class="row">
            <div class="col s12">
                <div class="right">
                    <a href="cart.php?empty=true" class="waves-effect waves-light btn red darken-2">Empty Cart</a>
                </div>
            </div>
        </div>
        <div class="row">
            <form action="bestelling.php" method="post" class="col s12">
                <div class="row">
                    <div class="input-field col s3">
                        <input type="text" id="name" name="name">
                        <label for="name">Volledige Naam...</label>
                    </div>
                    <div class="input-field col s3">
                        <input type="email" id="email" name="email">
                        <label for="email">Email...</label>
                    </div>
                    <div class="col s6">
                        <button type="submit" class="waves-effect waves-light btn red">Order</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

<?php
include "includes/footer.php";
?>
