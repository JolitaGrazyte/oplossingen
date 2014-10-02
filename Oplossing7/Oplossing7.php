<!doctype html>
<html>
<?php 
$getal = 35;
if ($getal > 0 && $getal <= 10) {
    $uitkomst = 'Het getal ligt tussen 0 en 10.';
}
elseif ($getal >10 && $getal <= 20) {
    $uitkomst = 'Het getal ligt tussen 10 en 20.';
}
elseif ($getal >20 && $getal <= 30) {
    $uitkomst = 'Het getal ligt tussen 20 en 30.';
}
elseif ($getal >30 && $getal <= 40) {
    $uitkomst = 'Het getal ligt tussen 30 en 40.';
}

$omgekeerd = strrev($uitkomst);
 ?>

    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Untitled</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h2><?= $uitkomst ?></h2>
        <h2><?= $omgekeerd ?></h2>
        <script src="js/main.js"></script>
    </body>
</html>