<?php 

session_start(); 

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}

//___destroy session__//
if (isset($_GET['session'])) {
    
    if ($_GET['session'] === 'destroy') {

        session_destroy();

        Header('Location: http://oplossingen.web-backend.local/035_mod_rewrite-blog/artikels/');
    }
}

$msqlConn = new MsqlConnect( 'mod_rewrite', 'jolita', 'zN6br4fLYVJ8pSNy');

$messages = Message::getMessages();
$alleArtikels = Artikels::getArtikels( $msqlConn );

$email = isset($_SESSION['login']['email']) ? $_SESSION['login']['email'] : '';

// var_dump($_SESSION['artikel']['artikel_id']);
var_dump($_SESSION);
var_dump($_GET);
// var_dump($artikels);

 ?>

 <!doctype html>
 <html>
     <head>
         <meta charset="utf-8">
         <meta name="description" content="">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Overzicht artikels</title>
         <link rel="stylesheet" href="http://oplossingen.web-backend.local/035_mod_rewrite-blog/css/style.css">
     </head>
     <body>

     <header>
     <?php if ($messages): ?>
            <?php foreach ($messages as $value): ?>

                <div class="<?=$value['type'] ?>"><?=$value['text'] ?></div> 

            <?php endforeach ?>
        <?php endif ?>

     <a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <a href="<?='mailto:$email'  ?>"><a href="">test@test.be</a>  <?=$email  ?> </a>  | <a href="logout.php">uitloggen</a>

     </header>

    <div class="container">

	<h1>Overzicht van de artikels</h1>

    <div class="search-block">
       
    <form action="http://oplossingen.web-backend.local/035_mod_rewrite-blog/zoeken/" method="GET">
        
        <input  type="text" 
                class="search" 
                name="query-content" 
                value="Search..." 
                onblur="if(this.value==''){this.value='Search...'}" 
                onclick="if(this.value=='Search...'){this.value=''}">
        </input>

        <input  type="submit" 
                class="btn_search" 
                name="btn_search" 
                value="zoeken">
        </input>

    </form>

    <form action="http://oplossingen.web-backend.local/035_mod_rewrite-blog/zoeken/" method="GET">
        
    <select id="datum_select" name="datum">
        <option value = "2014">2014</option>
        <option value = "2013">2013</option>
        <option value = "2012">2012</option>
    </select>
    
    <input type="submit" class="date_search" name="jaar" value="zoeken op datum"></input>

    </form>

   </div>

    <a class="voegArtikelToe" href="http://oplossingen.web-backend.local/035_mod_rewrite-blog/toevoegen/">Voeg een artikel toe</a>

    <?php if ( $alleArtikels): ?>
        
        <section id='artikel'>

        <?php  foreach ($alleArtikels as $key => $value): ?>
                <article class="<?=( ($value['is_active'] == 0) ? 'notActive' : 'isActive' ) ?>">
                <h2><?=$value['title'] ?> | <?=$value['datum'] ?></h2>
                <p class="text"><?=$value['artikel'] ?></p>
                <p><span>Kernwoorden: </span><a href=""><?=$value['kernwoorden'] ?></a></p>
                <p><a href="artikel-wijzigen-form.php?artikel=<?=$key ?>">artikel wijzigen</a> | <a href="artikel-activeren.php?artikel=<?=$key ?>">artikel <?=( ($value['is_active'] == 0) ? 'activeren' : 'deactiveren' ) ?></a> | <a href="artikel-verwijderen.php?artikel=<?=$key ?>">artikel verwijderen</a></p>
                </article>
        <?php endforeach; ?>

        </section>
    <?php endif ?>

    </div>

     </body>
 </html>