<?php 

session_start();

function __autoload( $classname ) {
    include_once ('./classes/'. $classname .'.php');
}

$email = isset($_SESSION['login']['email']) ? $_SESSION['login']['email'] : '';

//___make connection to database___//
$msqlConn = new MsqlConnect( 'CRUD_CMS', 'jolita', 'zN6br4fLYVJ8pSNy' );

//__validate User__//
$authenticated = User::authenticate( $msqlConn );

    if ( $authenticated )
    {
        $messages = Message::getMessages();

    }
    else
    {
        User::logout();
        Header( 'Location: login-form.php' );
    }

    ?>
 <html>
     <head>
         <meta charset="utf-8">
         <meta name="description" content="">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Dashboard</title>
         <link rel="stylesheet" href="css/style.css">

     </head>
    <body>
    <header>

        <a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <a href="<?=$email ?>"><?=$email ?></a>  | <a href="logout.php">uitloggen</a>
        
    </header>

        <h1>Dashboard</h1>
    <!-- <h1><?=$title ?></h1> -->

        <div class="message">
            
        <?php if ($messages): ?>
            <?php foreach ($messages as $value): ?>

                <div class="<?=$value['type'] ?>"><?=$value['text'] ?></div> 

            <?php endforeach ?>
        <?php endif ?>

        </div>

        <p><a href="artikels-overzicht.php">Artikels</a></p>

        <p><a href="logout.php">Uitloggen</a></p>

    </body>
</html>