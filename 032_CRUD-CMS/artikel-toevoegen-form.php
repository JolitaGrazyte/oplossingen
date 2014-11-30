<?php
session_start(); 

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}

$messages = Message::getMessages();

//___destroy session__//
if (isset($_GET['session'])) {
    
    if ($_GET['session'] === 'destroy') {

        session_destroy();

        Header('Location: artikel-toevoegen-form.php');
    }
}

 ?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Artikels Toevoegen</title>
        <link rel="stylesheet" href="css/style.css">

    </head>

    <header>

        <?php if ($messages): ?>
            <?php foreach ($messages as $value): ?>

                <div class="<?=$value['type'] ?>"><?=$value['text'] ?></div> 

            <?php endforeach ?>
        <?php endif ?>

        <div><a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <a href="">test@test.be</a>  | <a href="logout.php">uitloggen</a></div>
        
        <div><a href="artikels-overzicht.php">Terug naar overzicht</a></div>

     </header>


    <body>
        <h1>Artikels toeveoegen</h1>

        <form action="artikel-toevoegen-process.php" method="POST">
        	<label for="title">Title</label>
        	<input id="title" name="title" type="text"></input>

        	<label for="artkel">Artikel</label>
        	<div><textarea id="artikel" name="artikel"></textarea></div>

        	<label for="kernwoorden">Kernwoorden</label>
        	<input id="kernwoorden" name="kernwoorden" type="text"></input>
 
        	<label for="datum">Datum  (jjjj-mm-dd)</label>
        	<input id="datum" name="datum" type="date" ></input> 

        	<input id="submit" name="submit" type="submit" value="artikel toevoegen"></input>

            <a href="?session=destroy">begin opnieuw</a>

        </form>

    </body>
</html>

