<!doctype html>
<html>
<?php 
$pigHealth = 5;
$maximumThrows = 8;
$record = array();

function calculateHit(){
	global $pigHealth;
	global $record;
	
	$raakKans = rand(1, 100);
	
	if ($pigHealth > 0) {
		if ($raakKans >= 50) 
		{
			--$pigHealth;
			if ($pigHealth == 1) 
			{
				array_push($record, 'Raak! Er zijn nog maar '.$pigHealth.substr("varkens", 0, -1). ' over.');
			}
			else
			{
				array_push($record, 'Raak! Er zijn nog maar '.$pigHealth. ' varkens over.');
			}
			
			//
		}
		else
		{
			if ($pigHealth == 1) 
			{
				array_push($record, 'Mis! Nog '.$pigHealth. ' varken over in het team.');
			}
			else
			{
				array_push($record, 'Mis! Nog '.$pigHealth. ' varkens over in het team.');
			}
		}
	}
	
	
}

function launchAngryBird(){
	static $count = 0;
	global $maximumThrows;
	global $pigHealth;
	global $record;

	if ($count < $maximumThrows) {
		calculateHit();
		++$count;
		launchAngryBird();
	}
	else{
		
		calculateHit();
		if ($pigHealth <= 0) { array_push($record, 'Gewonnen!'); }
		else { array_push($record, 'Verloren!'); }
	}
}

launchAngryBird();

?>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Functies Gevorderd | Deel 2</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <h1>Functies Gevorderd - Deel 2</h1>
    <h2>Text-based Angry Birds</h2>
    	<?php foreach ($record as $value): ?>
    	<?php echo "<p>".$value."</p>" ?>
    	<?php endforeach; ?>
        <script src="js/main.js"></script>
    </body>
</html>