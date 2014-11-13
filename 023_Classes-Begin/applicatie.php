<!doctype html>
<?php 

// we've writen this code where we need
function __autoload($classname) {
    $filename = "./classes/". $classname .".php";
    include_once($filename);
}
$numbers = array();
$percent = new Percent(150, 100);
$numbers['Absolute'] = $percent->formatNumber($percent->absolute);
$numbers['Relatief'] = $percent->formatNumber($percent->relative);
$numbers['Geheel Getal'] = $percent->hundred."%";
$numbers['Nominaal'] = $percent->nominal;

 ?>


<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Classes Begin</title>
        <link rel="stylesheet" href="css/style.css">

    </head>
    <body>
        <table>
        <thead>Hoeveel procent is 150 van 100?</thead>
        
        <?php foreach ($numbers as $key => $value): ?>
        	<tr>
        		<td><?=$key  ?></td>
        		<td><?=$value ?></td>
        	</tr>
        <?php endforeach ?>
        </table>
    </body>
</html>