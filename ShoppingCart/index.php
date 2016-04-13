<?php
    include "includes/header.php";


?>

    <header class=" header">
        <div class="container">
            <h1>Amazing!</h1>
        </div>
    </header>
<?php

if(isset($_GET['bestelling'])){

        if($_GET['bestelling'] == 1){
            echo "<div class='row'><div class='col s12 m8 l6 offset-m2 offset-l3'><div class='card-panel green white-text'><h3>Bedankt voor uw bestlling</h3></div></div></div>";
        }elseif($_GET['bestelling'] === 2){
            echo "<div class='row'><div class='col s12 m8 l6 offset-m2 offset-l3'><div class='card-panel red white-text'><h3>Er is iets missgegaan</h3></div></div></div>";
        }else{
            echo "<div class='row'><div class='col s12 m8 l6 offset-m2 offset-l3'><div class='card-panel red white-text'><h3>Er is iets missgegaan</h3></div></div></div>";
        }

}
?>
    <div class="container">
        <div class="row">
            <div class="col m4 s12"><h2>Feature 1 yay!</h2></div>
            <div class="col m4 s12"><h2>Feature 2 yay!</h2></div>
            <div class="col m4 s12"><h2>Feature 3 yay!</h2></div>
        </div>
    </div>

<?php
    include "includes/footer.php"
?>
