<!doctype html>
<html>
<?php 
$i = 0;
 ?>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht While</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <h1>Opdracht While</h1>
    <h2>Deel 1</h2>

    <p>
    	<?php while ($i < 100): ?>
    		<?php echo $i. ', '; ?>
    		<?php 	$i++; ?>
    	<?php  endwhile; ?>
    </p>
	
	<p>
		<?php $i = 0; while ($i < 100): ?>
			<?php if ($i%3 == 0 && $i > 40 && $i < 80): ?>
				<?php echo $i. ', '; ?>
			<?php endif; ?>
			<?php  $i++; ?>
		<?php endwhile; ?>
	</p>

	<h2>Deel 2</h2>
	<h1>Table met while lus</h1>

	<table border=1 width=50%>
	<?php 
	$i=0; 

	while ($i <= 10):// 1ste while lus 

	if(($i % 2) == 1) //check voor even nummers
	{ 
		echo "<tr>"; 
	} 
	else { 
		echo "<tr class='groen'>";  //even nummers
	} 
	echo "<td>".$i."</td>"; 


		$j = 2; 
		while($j <= 10): // 2de while lus 
		$resultaat = $i * $j;  
			if ($resultaat == $i*$i) { 
			echo "<td>" .$resultaat. "</td>"; 
		}
			else{ 
			echo "<td>".$resultaat."</td>"; 
		} 
		$j++; 

		endwhile; //einde 2de lus 

	echo "</tr>"; 
	$i++; 
	endwhile; //einde 1ste loop 

?>



</table>
        <script src="js/main.js"></script>
    </body>
</html>