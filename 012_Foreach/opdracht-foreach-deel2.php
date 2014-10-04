<!doctype html>
<html>
<?php 
$text = file_get_contents('text.txt');
$chars = str_split($text);

$textChars = array();
foreach($chars as $value){
	$textChars[] =strtoupper($value);
}
$letters = range('A', 'Z'); //array of alphabetical letters
$alphabetical = array();

for ($i=0; $i < sizeof($textChars) ; $i++) { 
    for ($j=0; $j < sizeof($letters); $j++) { 
        if ($textChars[$i] == $letters[$j]) {
        $alphabetical[] = $textChars[$i];
        }
    }
}
sort($alphabetical);
 
$uniqueChar = array();
$notUniqueChar = array_count_values($textChars);
$counts = array();

 ?>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Foreach</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <h1>Opdracht Foreach</h1>
    <h2>Opdracht foreach: deel 2</h2>
    
    <ul>
    <?php for ($i=0; $i < sizeof($alphabetical); $i++): ?>
        <?php  if ($alphabetical[$i] != $alphabetical[$i-1]): ?>
            <?php   $uniqueChar[] = $alphabetical[$i]; ?>
        <?php  endif; ?>
    <?php  endfor; ?>

    <?php   for ($j=0; $j < sizeof($uniqueChar); $j++): ?>
        <?php  foreach ($notUniqueChar as $key => $value): ?>
            <?php  $counts[] = $value; ?>
        <?php endforeach; ?>
        <li><?php echo $uniqueChar[$j].' x '.$counts[$j]; ?></li>
    <?php endfor; ?>
    </ul>

        <script src="js/main.js"></script>
    </body>
</html>