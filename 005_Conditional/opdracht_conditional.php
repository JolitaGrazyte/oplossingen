<!doctype html>
<?php
    $dag1 = 1; 
    if ($dag1 == 1) {
	   $deDag = "maandag";
}
    $dagToUpper = strtoupper($deDag);
    $laatsteA_Pos = strrpos($dagToUpper, "A");
    $laatsteA = substr($dagToUpper, -2, 1);
    $restToLower = strtolower($laatsteA);
    $dagToUpperSub = substr($dagToUpper, 0, $laatsteA);
    $dagToUpperSubstr = substr($dagToUpper, $laatsteA+1, strlen($deDag));
    $LowerA = $dagToUpperSub.$restToLower.$dagToUpperSubstr;

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
        <h2>Deel 1</h2>
            <h3><?= $deDag ?></h3>
        <h2>Deel 2</h2>
            <h3><?= $LowerA ?></h3>
        
        <script src="js/main.js"></script>
    </body>
</html>