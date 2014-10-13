<!doctype html>
<?php 
	$password = 'azerty';
	$naam = 'Jolita';
	$message = '';

	if (isset($_POST['submit'])) {
        if ($_POST['naam'] == $naam && $_POST['password'] == $password ) {
            $message = 'Welkom '.$naam;
        }
        else {
            $message = 'Er ging iets mis bij het inloggen, probeer opnieuw';
        }
        
   
}
 ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht POST</title>
        <link rel="stylesheet" href="css/style.css">
        
    </head>
    <body>
        <div class="container">
        <h1>Inloggen</h1>
        <h2><?=$message  ?></h2>
        	<form action="opdracht_post.php" method="POST">
        		 <fieldset>
        		 <ul>
        		     <li><label>gebruikersnaam</label></li>
        		     <li><input id="name" type="text" name="naam"></li>
        		     <li><label>password</label></li>
        		     <li><input id="password" type="password" name="password"></li>
        		     <li><button type="submit" name="submit">Submit</button></li>
        		 </ul>
    
                </fieldset>
    		</form>
            
        </div>
        <script src="js/main.js"></script>
    </body>
</html>