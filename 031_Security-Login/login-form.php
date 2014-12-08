<?php 
session_start();

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}


$msqlConn = new MsqlConnect( 'login', 'jolita', 'zN6br4fLYVJ8pSNy' ); 

if ( User::authenticate( $msqlConn )) {

    header( 'Location: dashboard.php' );
}

else{

    $messages = Message::getMessages();
        
    $email  = isset( $_SESSION['login']['email'] )    ? $_SESSION['login']['email'] : '';
        
    $pass   = isset( $_SESSION['login']['password'] ) ? $_SESSION['login']['password'] : '';

}

var_dump( $_COOKIE );

 ?>

 <!doctype html>
 <html>
     <head>
         <meta charset="utf-8">
         <meta name="description" content="">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Inloggen</title>
         <link rel="stylesheet" href="css/style.css">

     </head>
     <body>
         <?php if ($messages): ?>
            <?php foreach ($messages as $value): ?>

                <div class="<?=$value['type'] ?>"><?=$value['text'] ?></div> 

            <?php endforeach ?>
        <?php endif ?>

        <form action="login-confirm.php" method="post">

			<label for="email">Email</label>
			<input type="text" name="email" id="email" value="<?= $email ?>">

			<label for="password">Paswoord</label>
			<input type="password" name="password" id="password" value="<?= $pass ?>">

			<input type="submit" name="submit" value="log in">

		</form>

		<div>Nog geen account? Maak er dan eentje aan op de <a href="registratie-form.php">registratiepagina</a>.</div>

     </body>
 </html>