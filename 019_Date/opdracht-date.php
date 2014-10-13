<!doctype html>
<?php
   $timestamp = mktime(22, 35, 25, 1, 21, 1904);
   $date = date("j F, Y, g:i:s a", $timestamp);
   setlocale(LC_ALL, 'nl_NL');
   $date_nl = strftime("%d %B %Y %u %I:%M:%S", $timestamp);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Date - Deel 1</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <h1>Opdracht date</h1>
    <h2>Deel 1</h2>
    <p><?=$timestamp ?></p>
    <p><?=$date  ?></p>
    <h2>Deel 2</h2>
    <p><?=$date_nl  ?></p>
    
        
        <script src="js/main.js"></script>
    </body>
</html>