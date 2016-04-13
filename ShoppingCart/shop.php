<?php
include "includes/header.php";
include "database.php";
?>

    <div class="container">
        <div class="row">

            <?php

            $query = "SELECT * FROM cart_producten";

            $query_result = $conn->query( $query );

            $result_array = $query_result->fetchAll(PDO::FETCH_ASSOC);

            foreach ( $result_array as $item ) {
                ?>


                    <div class="col s12 m6 l4">
                        <div class="card blue-grey darken-2" style="max-height: 225px;min-height: 225px;">
                            <div class="card-content white-text">
                                <span class="card-title"><?php echo $item['naam']; ?></span>
                                <p>$ <?php echo $item['prijs']; ?></p>
                            </div>
                            <div class="card-action" style="position: absolute; bottom: 0; width: 100%;">
                                <a href="cart.php?pid=<?php echo $item['id']; ?>&re=1">Add to cart</a>
                            </div>
                        </div>
                    </div>


                <?php
            }

            if( $database_config['debug']){
                echo '<pre style="overflow: visible">';
                print_r( $result_array );
                echo '</pre>';
            }

            ?>

        </div>
    </div>

<?php
include "includes/footer.php";
?>
