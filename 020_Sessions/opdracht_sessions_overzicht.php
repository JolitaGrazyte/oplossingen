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

   if(isset($_POST["submit"]))
    {
        $_SESSION['adres']["straat"] = $_POST["straat"]; 
        $_SESSION['adres']["nummer"] = $_POST["nummer"]; 
        $_SESSION['adres']["postcode"] = $_POST["postcode"]; 
        $_SESSION['adres']["gemeente"] = $_POST["gemeente"]; 
    } 
      
 ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Session Overzicht</title>
        <link rel="stylesheet" href="css/style.css">
        
    </head>
    <body>
        <div class="container">
        <h1>Overzicht</h1>
        		 <fieldset>
        		<ul>

                <?php foreach ($_SESSION["registratie"] as $key => $value): ?>
                    <li><?=$key ?> : <?=$value ?><a href="opdracht_sessions_registratie.php?focus=<?=$key ?>"> [wijzig]</a></li> 
                <?php endforeach ?>
                
                <?php foreach ($_SESSION['adres'] as $key => $value): ?>
                    <li><?=$key ?> : <?=$value ?><a href="opdracht_sessions_adres.php?focus=<?=$key ?>"> [wijzig]</a></li>
                <?php endforeach ?>            
                

                  <!--   <li>email: <?=$_SESSION['registratie']['email']; ?> <a href="opdracht_sessions_registratie.php?focus=email">wijzig</a></li>
                    <li>nickname: <?=$_SESSION['registratie']['name']; ?> <a href="opdracht_sessions_registratie.php?focus=name">wijzig</a></li>
                    <li>straat: <?=$_SESSION['adres']['straat']; ?> <a href="opdracht_sessions_adres.php?focus=straat">wijzig</a></li>
                    <li>nummer: <?=$_SESSION['adres']['nummer']; ?> <a href="opdracht_sessions_adres.php?focus=nummer">wijzig</a></li>
                    <li>gemeente: <?=$_SESSION['adres']['gemeente']; ?> <a href="opdracht_sessions_adres.php?focus=gemeente">wijzig</a></li>
                    <li>postcode: <?=$_SESSION['adres']['postcode']; ?> <a href="opdracht_sessions_adres.php?focus=postcode">wijzig</a></li> -->
                </ul>
                </fieldset>
                <a href="opdracht_sessions_overzicht.php?session=destroy">begin opnieuw</a>
                <?php var_dump($_SESSION) ?>
        </div>

        <script src="js/main.js"></script>
    </body>
</html>