<?php 

session_start();

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}

//__variables__//

$email   = isset( $_SESSION['registratie']['email'] ) ? $_SESSION['registratie']['email'] : '';
$pass    = isset( $_SESSION['registratie']['pass'] )  ? $_SESSION['registratie']['pass']  : '';

$messages = Message::getMessages();

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
	<div class="container">
		<h1>Registreren</h1>
		<div class="message">
			
		<?php if ($messages): ?>
            <?php foreach ($messages as $value): ?>

                <div class="<?=$value['type'] ?>"><?=$value['text'] ?></div> 

            <?php endforeach ?>
        <?php endif ?>

		</div>
		<section>

			<form action="registratie-process.php" method="POST">

				<label for="email">e-mail</label>
				<input name="email" type="text" value="<?=$email ?>">
				<label for="password">password</label>
				<input name="password" type="text" value="<?=$pass ?>">
				<button name="generatePass" type="hidden" value="Genereer een password">Genereer een password</button>
				<button name="submit" type="submit" value="registreer">Registreer</button>	

				<p><a href="?session=destroy">begin opnieuw</a></p>
			

				<?=var_dump($_SESSION) ?>
		
			</form>

		</section>
	</div>
</body>
