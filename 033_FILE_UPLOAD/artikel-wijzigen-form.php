<?php 

session_start(); 

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}

$msqlConn = new MsqlConnect( 'file_upload', 'jolita', 'zN6br4fLYVJ8pSNy');

$artikels = Artikels::getArtikels( $msqlConn );

$messages = Message::getMessages();

$artikelID = isset($_GET['artikel']) ? $_GET['artikel'] : '';
$_SESSION['artikel']['artikel_id'] = $artikels[$artikelID]['id'];

// var_dump($artikelID);
// var_dump($_SESSION['artikel']['artikel_id']);

 ?>

 <!doctype html>
 <html>
     <head>
         <meta charset="utf-8">
         <meta name="description" content="">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Artikel Wijzigen</title>
         <link rel="stylesheet" href="css/style.css">
     </head>
     <body>

     <header>

        <?php if ($messages): ?>
            <?php foreach ($messages as $value): ?>

                <div class="<?=$value['type'] ?>"><?=$value['text'] ?></div> 

            <?php endforeach ?>
        <?php endif ?>

        <a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <a href="">test@test.be</a>  | <a href="logout.php">uitloggen</a>

        <a href="artikels-overzicht.php">Terug naar overzicht</a>

     </header>


    <body>
        <h1>Artikel wijzigen</h1>

        <form action="artikel-wijzigen.php" method="POST">
        	<label for="title">Title</label>
        	<input id="title" name="title" type="text" value="<?=( isset($_POST['title']) ? $_POST['title'] : $artikels[$artikelID]['title'] ) ?>"></input>

        	<label for="artkel">Artikel</label>
        	<div><textarea id="artikel" name="artikel" rows="10" cols="50"><?=( isset($_POST['title']) ? $_POST['title'] : $artikels[$artikelID]['artikel'] ) ?></textarea></div>

        	<label for="kernwoorden">Kernwoorden</label>
        	<input id="kernwoorden" name="kernwoorden" type="text" value="<?=( isset($_POST['kernwoorden']) ? $_POST['kernwoorden'] : $artikels[$artikelID]['kernwoorden']  ) ?>"></input>
 
        	<label for="datum">Datum  (jjjj-mm-dd)</label>
        	<input id="datum" name="datum" type="date" ></input> 

        	<input id="submit" name="submit" type="submit" value="wijziging opslaan"></input>

            <a href="?session=destroy">begin opnieuw</a>

        </form>
         

     </body>
 </html>