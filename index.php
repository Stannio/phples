<?php




?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta name="charset" content="UTF-8">
            <title>XAMPP Dev Page</title>
            <link rel="stylesheet" href="styles.css">
            <link rel="shortcut icon" href="Xampp-Favicon.png">
        </head>

        <body>
            <div class="header">
                <div class="container">
                    <!-- Dit is de Titel -->
                    <h1>XAMPP Index Pagina</h1>
                </div>
            </div>

            <div class="container">
                <?php if ($handle = opendir('.')) {

                    while (false !== ($entry = readdir($handle))) {

                        if ($entry != "." && $entry != "..") {

                            echo "<a href='$entry'>$entry</a>";
                        }
                    }

                    closedir($handle);
                } ?>
            </div>
        </body>

    </html>
