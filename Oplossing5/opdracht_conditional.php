<!doctype html>
<?php
$dag1 = 1; 
if ($dag1 == 1) {
	$deDag = "maandag";
}
$dagToUpper = strtoupper($deDag);
$laatsteA = strrpos($dagToUpper, "A");
$rest = substr($dagToUpper, -2, 1);
$toLower = strtolower($rest);
$replace = str_replace($laatsteA, $toLower, $dagToUpper);



 ?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht condtional</title>
        
    </head>
    <body>
    <h1>Opdracht condtional</h1>
        <h2><?= $deDag ?></h2>
        <h2><?= $dagToUpper ?></h2>
        <h2><?= $laatsteA ?></h2>
        <h2><?= $rest ?></h2>
        <h2><?= $replace ?></h2>
        
        <script src="js/main.js"></script>
    </body>
</html>