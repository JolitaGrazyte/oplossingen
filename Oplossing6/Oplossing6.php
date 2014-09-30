<!doctype html>
<?php 
$jaartal = date("Y");
$schrikkeljaar = "??";
if ($jaartal%4 == 0 || $jaartal%400 == 0) {
	$schrikkeljaar = "Is een schrikkeljaar";
}
else{
	$schrikkeljaar = "Is geen schrikkeljaar";;
}

 ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Untitled</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>
        <h2><?= $jaartal ?></h2>
        <h2><?= $schrikkeljaar ?></h2>
        <script src="js/main.js"></script>
    </body>
</html>