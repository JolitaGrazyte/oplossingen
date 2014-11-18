<!doctype html>
<?php 

$indhoud = array();
$cursus = isset($_GET['link']) ? $_GET['link']: 'cursus';
$voorbeelden = isset($_GET['link']) ? $_GET['link']: 'voorbeelden';
$oplossingen = isset($_GET['link']) ? $_GET['link']: 'oplossingen';

function searchFiles(){

}

function showList(){

    
}

 ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Herhalings Opdracht</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container">
<h1>Herhalings Opdracht</h1>
<h2>Indexpagina</h2>
    <ul>
        <!-- <a href="herhalings_opdracht.php?link=cursus"> -->
        <a href="?link=cursus">
            <li>Cursus</li>
        </a>
        <a href="?link=voorbeelden">
            <li>Voorbeelden</li>
        </a>
        <a href="?link=oplossingen">
            <li>Oplossingen</li>
        </a>
    </ul>
    <form action="herhalings_opdracht.php" method="GET">
        <ul>
            <li><label>Zoek naar:</label></li>
            <li><input id="search" type="text" name="search" value="Geef een zoekterm in"> <button type="submit" name="submit">Zoek</button></li>
            <li></li>
        </ul>   
    </form>
<?php if ($cursus): ?>
    <iframe src="<?="http://web-backend.local/web-backend-uitdieping.pdf" ?>"></iframe>
<?php endif ?>
    
    </div>
</body>
</html>