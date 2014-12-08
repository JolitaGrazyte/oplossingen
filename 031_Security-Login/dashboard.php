<?php 

session_start();

function __autoload( $classname ) {
    include_once ('./classes/'. $classname .'.php');
}

//___make connection to database___//
$msqlConn = new MsqlConnect( 'login', 'jolita', 'zN6br4fLYVJ8pSNy' );

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
        <h1>Dashboard</h1>
    <!-- <h1><?=$title ?></h1> -->

        <div class="message">
			
			<?php if ($messages): ?>
            <?php foreach ($messages as $value): ?>

                <div class="<?=$value['type'] ?>"><?=$value['text'] ?></div> 

            <?php endforeach ?>
        <?php endif ?>

		</div>

<!-- 	<?php if ($userName): ?>
			<p>Hallo, <?=$userName ?></p>
		<?php endif ?>
        
 -->    
        <?php if ( $authenticated ): ?>

            <a href="logout.php">Uitloggen</a>

        <?php endif ?>

    </body>
</html>
 