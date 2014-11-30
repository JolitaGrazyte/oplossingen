<?php 
session_start();

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}

$email   = isset($_SESSION['registratie']['email']) ? $_SESSION['registratie']['email'] : '';
$pass    = isset($_SESSION['registratie']['pass'])  ? $_SESSION['registratie']['pass']  : '';

$messages = Message::getMessages();

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