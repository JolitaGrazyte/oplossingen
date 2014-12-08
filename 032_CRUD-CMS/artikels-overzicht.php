<?php 

session_start(); 

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}

$msqlConn = new MsqlConnect( 'CRUD_CMS', 'jolita', 'zN6br4fLYVJ8pSNy');

$messages = Message::getMessages();
$artikels = Artikels::getArtikels( $msqlConn );

$email = isset($_SESSION['login']['email']) ? $_SESSION['login']['email'] : '';

// var_dump($_SESSION['artikel']['artikel_id']);
// var_dump($_SESSION);
// var_dump($artikels);

 ?>

 <!doctype html>
 <html>
     <head>
         <meta charset="utf-8">
         <meta name="description" content="">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Overzicht artikels</title>
         <link rel="stylesheet" href="css/style.css">
     </head>
     <body>

     <header>
     <?php if ($messages): ?>
            <?php foreach ($messages as $value): ?>

                <div class="<?=$value['type'] ?>"><?=$value['text'] ?></div> 

            <?php endforeach ?>
        <?php endif ?>

     <a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <a href="<?='mailto:$email'  ?>"> <?=$email  ?> </a>  | <a href="logout.php">uitloggen</a>

     </header>

    <div class="container">

	<h1>Overzicht van de artikels</h1>

    <?php if ($artikels): ?>
        <section id='artikel'>
        <?php  foreach ($artikels as $key => $value): ?>
                <article class="<?=( ($value['is_active'] == 0) ? 'notActive' : 'isActive' ) ?>">
                <h2><?=$value['title'] ?></h2>
                <p class="text"><?=$value['artikel'] ?></p>
                <p><span>Kernwoorden: </span><a href=""><?=$value['kernwoorden'] ?></a></p>
                <p><a href="artikel-wijzigen-form.php?artikel=<?=$key ?>">artikel wijzigen</a> | <a href="artikel-activeren.php?artikel=<?=$key ?>">artikel <?=( ($value['is_active'] == 0) ? 'activeren' : 'deactiveren' ) ?> </a> | <a href="artikel-verwijderen.php?artikel=<?=$key ?>">artikel verwijderen</a></p>
                </article>
        <?php endforeach; ?> 
        </section>
    <?php else: ?>
        <p>Geen artikels gevonden</p>
    <?php endif ?>

	<a class="voegArtikelToe" href="artikel-toevoegen-form.php">Voeg een artikel toe</a>

    </div>

     </body>
 </html>