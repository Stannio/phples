<?php

    include_once 'moneyFormat.php';

if(isset($_POST['submit'])){

    $startVal    =  $_POST['startVal'];
    $interestVal =  $_POST['interestVal'];
    $numOfYears  =  $_POST['numOfYears'];
    $endMoney = null;

    $interest = 100 + $interestVal;

    $moneyVal = $startVal;
    $calcDone = 0;

    $forDone = false;

}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/styles.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.jqplot.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.jqplot.css" />
        <title>Compound Interest</title>
    </head>

    <body>

        <div class="jumbotron">
            <div class="container">
                <h1>Compound Interest Calculator <i class="glyphicon glyphicon-credit-card"></i></h1>
            </div>
        </div>

        <div class="container">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h2>Compound Interest Calculator</h2>
                    </div>

                    <div class="panel-body height">
                        <form action="index.php" method="post" enctype="multipart/form-data">
                            <input type="number" placeholder="Starting Quantity" name="startVal" class="form-control"> <br>
                            <input type="text" placeholder="Yearly Interest" name="interestVal" class="form-control"> <br>
                            <input type="number" placeholder="Number of years saving" name="numOfYears" class="form-control"> <br>
                            <input type="submit" value="Calculate" class="btn btn-primary" name="submit">
                        </form>
                    </div>

                    <div class="panel-footer">
                        <p class="text-center">© Stan de Horn 2016</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel ">
                    <div class="panel-heading">
                        <h2>Starting Parameters</h2>
                    </div>

                    <div class="panel-body height" style="font-size: 24px;">

                        <p>Starting Money: <?php if(isset($_POST['submit'])) {
                                                    $startingMoney = $startVal;
                                                    $startingMoney = round($startingMoney, 2);
                                                    $startingMoney = number_format($startingMoney, 2, ',', '.');
                                                    echo $startingMoney . " &euro;";
                                                }
                            ?></p>
                        <p>Interest per year: <?php if(isset($_POST['submit'])) { echo $interestVal . " %"; } ?></p>
                        <p>Number of years saving: <?php if(isset($_POST['submit'])) { echo $numOfYears; } ?></p>
                    </div>

                    <div class="panel-footer">
                        <p class="text-center">© Stan de Horn 2016</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h2>Graph of earned money</h2>
                    </div>

                    <div class="panel-body" style="font-size: 24px;">

                        <div id="chart1" style="height:auto;width:auto; "></div>

                        <script>
                            $(document).ready(function(){
                                $.jqplot.config.enablePlugins = true;
                                var s1 = [2, 6, 7, 10];
                                var ticks = ['a', 'b', 'c', 'd'];

                                plot1 = $.jqplot('chart1', [s1], {
                                    // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
                                    animate: !$.jqplot.use_excanvas,
                                    seriesDefaults:{
                                        renderer:$.jqplot.BarRenderer,
                                        pointLabels: { show: true }
                                    },
                                    axes: {
                                        xaxis: {
                                            renderer: $.jqplot.CategoryAxisRenderer,
                                            ticks: ticks
                                        }
                                    },
                                    highlighter: { show: false }
                                });

                                $('#chart1').bind('jqplotDataClick',
                                    function (ev, seriesIndex, pointIndex, data) {
                                        $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
                                    }
                                );
                            });
                        </script>
                    </div>

                    <div class="panel-footer">
                        <p class="text-center">© Stan de Horn 2016</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h2>Calculated Compound Interest</h2>
                    </div>

                    <div class="panel-body height overflow" style="font-size: 24px;">
                        <ol>
                            <?php

                            if(isset($_POST['submit'])) {
                                for ($x = 1; $x <= $numOfYears; $x = $x + 1) {

                                    $moneyVal = $moneyVal / 100 * $interest;

                                    $moneyVal = round($moneyVal, 2);
                                    $moneyCal = number_format($moneyVal, 2, ',', '.');

                                    echo "<li id='year[$x]'>" . $moneyCal . " " . "&euro;" . "</li>";


                                    if($x == $numOfYears){

                                        $endMoney = $moneyVal;
                                        $moneyEarned = $endMoney - $startVal;
                                        $moneyEarned = number_format($moneyEarned, 2, ',', '.');

                                        echo "<hr>";
                                        echo "<b>Money earned:</b> " . $moneyEarned . " &euro;" . " over $numOfYears years";

                                        $forDone = true;

                                        $calcDone = 1;
                                    }
                                }
                            }

                            ?>
                        </ol>
                    </div>

                    <div class="panel-footer">
                        <p class="text-center">© Stan de Horn 2016</p>
                    </div>
                </div>
            </div>


        </div>

    </body>

</html>