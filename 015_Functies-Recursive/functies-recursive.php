<!doctype html>
<?php 
$startGeld = 1000000;
$beleggingsJaren = 10;
$rentevoet = 8;
	
	function bereken($startGeld, $beleggingsJaren, $rentevoet)
	{
		static $counter = 1;
		static $arrayTotals = array();
		
		$jaarlijksWinst = floor($startGeld * ($rentevoet/100));
		
		$totaal = floor($startGeld + $jaarlijksWinst);
		
		array_push($arrayTotals, 'Na '.$counter.' jaar het totaal bedrag is '.$totaal.' en de winst is '.$jaarlijksWinst.'.' );

		if ($counter < $beleggingsJaren) {
			++$counter;
			return bereken($totaal, $beleggingsJaren, $rentevoet); 
		}

		return $arrayTotals;

	}

$totaleWinst = bereken($startGeld, $beleggingsJaren, $rentevoet);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Recursive</title>
        <link rel="stylesheet" href="css/style.css">
    
    </head>
    <body>
    <h1>Recursive functions</h1>

	<?php foreach ($totaleWinst as $value): ?>
	<li><?php echo $value; ?></li>
	<?php endforeach; ?>
        
        <script src="js/main.js"></script>
    </body>
</html>