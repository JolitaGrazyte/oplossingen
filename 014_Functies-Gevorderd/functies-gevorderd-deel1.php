<!doctype html>
<html>
<?php 
$md5HashKey = 'd1fa402db91a7a93c4f414b8278ce073';


function HashKey($valueToFind){
	global $md5HashKey;
    return (substr_count($md5HashKey, $valueToFind)*100/strlen($md5HashKey));
}

function HashKey2($valueToFind){
    return (substr_count($GLOBALS['md5HashKey'], $valueToFind) * 100)/strlen($GLOBALS['md5HashKey']);
}

function HashKey3($hashKey, $valueToFind){
    return (substr_count($hashKey, $valueToFind)*100)/strlen($hashKey);
}

function print_all(){
    echo "Functie 1: De needle 'a' komt ".HashKey('2'). " % voor in de hash key ".$GLOBALS['md5HashKey'].".</br>";
    echo "Functie 2: De needle '8' komt ".HashKey2('8'). " % voor in de hash key ".$GLOBALS['md5HashKey'].".</br>";
}
 ?>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Functies Gevorderd | Deel 1</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <h1>Functies Gevorderd - Deel 1</h1>
        <!-- <p><?=print_all($md5HashKey) ?></p> -->
        <p><?php echo "Functie 1: De needle '2' komt ".HashKey('2')." % voor in de hash key '".$md5HashKey."'.</br>";?></p>
        <p><?php echo "Functie 2: De needle '8' komt ".HashKey2('8')." % voor in de hash key '".$md5HashKey."'.</br>";?></p>
        <p><?php echo "Functie 3: De needle 'a' komt ".HashKey3($md5HashKey, 'a')." % voor in de hash key '".$md5HashKey."'.</br>";?></p>
        <script src="js/main.js"></script>
    </body>
</html>