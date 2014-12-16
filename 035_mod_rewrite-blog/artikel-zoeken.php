<?php 

session_start(); 

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}
$artikels = false;
$keyword = false;
$datum = false;

if ( isset( $_GET['query-content'] ) ) {
	
	try {

		$keyword = '%'.$_GET['query-content'].'%';

		$_SESSION['keyword'] = strtoupper( $_GET['query-content'] ) ;

		$valToBind = array( ':keyword' => $keyword );

		$msqlConn = new MsqlConnect( 'mod_rewrite', 'jolita', 'zN6br4fLYVJ8pSNy');

		$artikels = Artikels::getArtikelsByKeyword( $msqlConn, $valToBind );

		$_SESSION['artikels'] = $artikels;

		if ( $artikels ) {

			Message::setMessage( 'Gevonden!', 'success' );
			//header( 'Location: http://oplossingen.web-backend.local/035_mod_rewrite-blog/zoeken/' );
			

		}
		else {

			Message::setMessage( 'Geen artikels gevonden!', 'error' );
			header( 'Location: http://oplossingen.web-backend.local/035_mod_rewrite-blog/zoeken/' );

		}

		
	} catch (PDOException $e) {
		
		//$message = 'Connectie met database is niet gelukt. '.$e->getMessage();
        
        Message::setMessage( $e->getMessage(), 'error');
        header( 'Location: http://oplossingen.web-backend.local/035_mod_rewrite-blog/artikels/' );
	}
}

elseif( isset( $_GET['datum'] ) ) {
	
	try {

		$datum = $_GET['datum'];

		$_SESSION['dateSearch'] = '%'.$datum.'%';

		$valToBind = array( ':datum' => $datum );

		$msqlConn = new MsqlConnect( 'mod_rewrite', 'jolita', 'zN6br4fLYVJ8pSNy');

		$artikels = Artikels::getArtikelsByDate( $msqlConn, $valToBind );

		$_SESSION['artikels'] = $artikels;

		if ( $artikels ) {

			Message::setMessage( 'Gevonden!', 'success' );
			header( 'Location: artikel-zoeken.php' );
			

		}
		else {

			Message::setMessage( 'Geen artikels gevonden!', 'error' );
			header( 'Location: artikel-zoeken.php' );

		}

		
	} catch (PDOException $e) {
		
		//$message = 'Connectie met database is niet gelukt. '.$e->getMessage();
        
        Message::setMessage( $e->getMessage(), 'error');
        header( 'Location: artikel-zoeken.php' );
	}

}
// else{

// 	Message::setMessage( 'Er ging iets mis!', 'error' );
// 	header( 'Location: artikel-zoeken.php' );

//  }
$artikels = isset( $_SESSION['artikels'] ) ? $_SESSION['artikels'] : false;
$keyword = isset( $_SESSION['keyword'] ) ? $_SESSION['keyword'] : false;
$messages = Message::getMessages();
$email = isset($_SESSION['login']['email']) ? $_SESSION['login']['email'] : '';
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

     <a href="artikels/">Terug naar artikels overzicht</a> | Ingelogd als <a href="<?='mailto:$email'  ?>"><a href="">test@test.be</a>  <?=$email  ?> </a>  | <a href="logout.php">uitloggen</a>

     </header>

    <div class="container">

	<h1>Zoek resultaat</h1>

    <div class="search-block">
       
    <form action="zoeken/" method="GET">
        
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

    <form action="zoeken/" method="GET">
        
    <select id="datum_select" name="datum">
        <option value = "2014">2014</option>
        <option value = "2013">2013</option>
        <option value = "2012">2012</option>
    </select>
    
    <input type="submit" class="btn_search" name="date_search" value="zoeken op datum"></input>

    </form>

   </div>

    <a class="voegArtikelToe" href="http://oplossingen.web-backend.local/035_mod_rewrite-blog/toevoegen/">Voeg een artikel toe</a>

    <?php if ( $artikels && $keyword ): ?>
        <section id='artikel'>

        <p>Artikels die het woord "<?=$keyword ?>"  bevatten</p>

        <?php  foreach ($artikels as $key => $value): ?>
                <article class="<?=( ($value['is_active'] == 0) ? 'notActive' : 'isActive' ) ?>">
                <h2><?=$value['title'] ?> | <?=$value['datum'] ?></h2>
                <p class="text"><?=$value['artikel'] ?></p>
                <p><span>Kernwoorden: </span><a href=""><?=$value['kernwoorden'] ?></a></p>
                <p><a href="artikel-wijzigen-form.php?artikel=<?=$key ?>">artikel wijzigen</a> | <a href="artikel-activeren.php?artikel=<?=$key ?>">artikel <?=( ($value['is_active'] == 0) ? 'activeren' : 'deactiveren' ) ?></a> | <a href="artikel-verwijderen.php?artikel=<?=$key ?>">artikel verwijderen</a></p>
                </article>
        <?php endforeach; ?> 
        </section>

    <?php elseif( !$artikels && $keyword ): ?>
    <p>Geen artikels gevonden, die het woord "<?=$keyword ?>"  bevatten</p>
    
    <?php else: ?>
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