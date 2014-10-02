<!doctype html>
<?php 
$jaartal = date("Y");
$_jaartal = 1904;
$schrikkeljaar = "??";
if ($jaartal%4 == 0) {
	$schrikkeljaar = "Is een schrikkeljaar";
}
else{
	$schrikkeljaar = "Is geen schrikkeljaar";;
}

$seconds = 221108521;
$i = floor($seconds / 60);
$H = floor($seconds / 3600);
$days = floor($seconds / (60 * 60 * 24));
$weken = floor($days / 7);
$months = floor($seconds / (60 * 60 * 24 * 31));
$years = floor($months/12);

$toPrint = 'Jaren: '.$years.' Maanden: '.$months.' Weken: '.$weken.' Dagen: '.$days.' Uren: '.$H. ' Minuten: '.$i;

 ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Untitled</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <h2>Deel 1</h2>
        <H3><?= $jaartal ?></H3>
        <H3><?= $schrikkeljaar ?></H3>

    <H2>Deel 2</H2>
        <H3><?= $toPrint ?></H3>
        <script src="js/main.js"></script>
    </body>
</html>