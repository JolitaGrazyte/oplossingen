<!doctype html>
<?php   
session_start();

if (isset($_GET['session'])) 
    {
        if ($_GET['session'] === 'destroy') 
        {
            session_destroy();
            header('Location: opdracht_sessions_registratie.php');
        }
    }
      
 ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Session Registratie</title>
        <link rel="stylesheet" href="css/style.css">
        
    </head>
    <body>
        <div class="container">
        <h1>Registratie</h1>
        	<form action="opdracht_sessions_adres.php" method="POST">
        		 <fieldset>
        		 <ul>
        		     <li><label>email</label></li>
        		     <li><input id="email" type="email" name="email" value="<?=$_SESSION['registratie']['email']; ?>" <?= ( isset( $_GET['focus'] ) && $_GET['focus'] == "email" ) ? 'autofocus' : '' ?> /></li>
        		     <li><label>name</label></li>
        		     <li><input id="name" type="text" name="name" value="<?=$_SESSION['registratie']['name'];?>" <?= ( isset( $_GET['focus'] ) && $_GET['focus'] == "name" ) ? 'autofocus' : '' ?> /></li>
        		     <li><button id='submit' type="submit" name="submit">volgende</button></li>
        		 </ul>
                </fieldset>
    		</form>
            <a href="opdracht_sessions_registratie.php?session=destroy">begin opnieuw</a>
        </div>
        <script src="js/main.js"></script>
    </body>
</html>