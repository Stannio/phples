<?php include "includes/header.php";include 'database.php'; ?>
<?php

    if(empty($_POST['name']) || empty($_POST['email'])){
        echo "<script>window.location = 'index.php?bestelling=2'</script>";
        die();
    }

    try{

        $stmt = $conn->prepare("INSERT INTO cart_klanten (naam, email) VALUES (?, ?)");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);

        $name = $_POST['name'];
        $email = $_POST['email'];

        $stmt->execute();
        $lastId = $conn->lastInsertId();


    }catch(PDOException $ex) {
        if ($database_config['debug']) {
            $error = $ex->getMessage();
            echo $error;
        }
    }


    session_start();
    $total_order = 0;
    if( isset( $_SESSION['cart_content'] ) ){
        $cart_array = explode( ',', $_SESSION['cart_content'] );

        foreach ($cart_array as $item){
            $query = "SELECT * FROM cart_producten WHERE id ='". $item . "' ";
            $query_result = $conn->query($query);
            $product = $query_result->fetch(PDO::FETCH_ASSOC);
            $total_order += $product['prijs'];
        }
    }

    try{
        $stmt = $conn->prepare("INSERT INTO cart_bestellingen (Totaalprijs, Klant_id) VALUES (?, ?)");
        $stmt->bindParam(1, $totaal_prijs);
        $stmt->bindParam(2, $klant_id);

        $totaal_prijs = $total_order;
        $klant_id = $lastId;
        $stmt->execute();
        $lastOrderId = $conn->lastInsertId();
    } catch( PDOException $ex ){
        if($database_config['debug']){
            $error = $ex->getMessage();
            echo $error;
        }
    }
    // write order to database with customer_id
    if( isset( $_SESSION['cart_content'] ) ){
        $cart_array = explode( ',', $_SESSION['cart_content'] );

        foreach ($cart_array as $item){
            $query = "SELECT * FROM cart_producten WHERE id ='". $item . "' ";
            $query_result = $conn->query($query);
            $product = $query_result->fetch(PDO::FETCH_ASSOC);

            try{
                $stmt = $conn->prepare("INSERT INTO cart_bestellingregels (Product_id, Bestelling_id, aantal) VALUES (?, ?, ?)");
                $stmt->bindParam(1, $product_id);
                $stmt->bindParam(2, $bestelling_id);
                $stmt->bindParam(3, $aantal);

                $product_id = $item;
                $bestelling_id = $lastOrderId;
                $aantal = 1;
                $stmt->execute();

            } catch( PDOException $ex ){
                if($database_config['debug']){
                    $error = $ex->getMessage();
                    echo $error;
                }
            }

        }
        echo "<script>window.location = 'index.php?bestelling=1'</script>";
    }else{
        echo "<script>window.location = 'index.php?bestelling=2'</script>";
        die();
    }
?>

    <div class="container">
        <div class="row">
            <p>Thank you for your order <?php  echo htmlentities($_POST['name']); ?>.</p>
            <p>Your order has been recorded as order number <?php echo $lastOrderId; ?>.</p>
        </div>
    </div>

<?php include "includes/footer.php"; ?>
