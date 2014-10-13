<!doctype html>
<?php 
$cursus = false;
$voorbeelden = false;
$opdrachten = false;

if (isset($_GET['link'])) {
    switch ($_GET['link']) {
        case 'cursus':
            $cursus = true;
            break;

        case 'voorbeelden':
            $voorbeelden = true;
            break;
        
        case 'opdrachten':
            $opdrachten = true;
            break;
    }
    
}

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
        <a href="herhalings_opdracht.php?link=cursus">
            <li>Cursus</li>
        </a>
        <a href="herhalings_opdracht.php?link=voorbeelden">
            <li>Voorbeelden</li>
        </a>
        <a href="herhalings_opdracht.php?link=opdrachten">
            <li>Oplossingen</li>
        </a>
    </ul>
    <form action="herhalings_opdracht.php" method="GET">
        <ul>
            <li><label>Zoek naar:</label></li>
            <li><input id="search" type="text" name="search"> <button type="submit" name="submit">Zoek</button></li>
            <li></li>
        </ul>   
    </form>
<?php if ($cursus): ?>
    <iframe src="<?="http://web-backend.local/web-backend-uitdieping.pdf" ?>"></iframe>
<?php endif ?>
    
    </div>
</body>
</html>