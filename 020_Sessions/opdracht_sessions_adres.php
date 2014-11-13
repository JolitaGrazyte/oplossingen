<!doctype html>
<?php   
    session_start();

// if (isset('session_destroy') {
//     session_destroy();
//     header('Location: opdracht_sesssions_adres.php');
// }
    if (empty($_SESSION['count'])) 
    {
        $_SESSION['count'] = 1;
    } 
    else 
    {
        $_SESSION['count']++;
    }

    if(isset($_POST["submit"]))
    {
        $_SESSION['registratie']["email"] = $_POST["email"];
        $_SESSION['registratie']["name"] = $_POST["name"]; 
    }


    if (isset($_GET['session'])) 
    {
        if ($_GET['session'] === 'destroy') 
        {
            session_destroy();
            header('Location: opdracht_sessions_registratie.php');
        }
    }

$straat = isset($_SESSION['adres']['straat'])? $_SESSION['adres']['straat'] : '';
$nummer = isset($_SESSION['adres']['nummer'])? $_SESSION['adres']['nummer'] : '';
$gemeente = isset($_SESSION['adres']['gemeente'])? $_SESSION['adres']['gemeente'] : '';
$postcode = isset($_SESSION['adres']['postcode'])? $_SESSION['adres']['postcode'] : '';


 ?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Session</title>
        <link rel="stylesheet" href="css/style.css">
        
    </head>
    <body>
        <div class="container">
        <h1>Registratiegegevens</h1>
        	<form action="opdracht_sessions_overzicht.php" method="POST">
        		 <fieldset>
        		 <ul>

                <?php foreach ($_SESSION["registratie"] as $key => $value): ?>
                    <li><?=$key ?> : <?=$value ?></li>
                <?php endforeach ?>

                    <!-- <li>e-mail: <?=$_SESSION['registratie']['email']; ?></li>
                    <li>nickname: <?=$_SESSION['registratie']['name']; ?></li> -->

        		     <li><label>straat</label></li>
        		     <li><input id="straat" type="text" name="straat" value="<?=$straat;  ?>" <?= ( isset( $_GET['focus'] ) && $_GET['focus'] == "straat" ) ? 'autofocus' : '' ?> /></li>
        		     <li><label>nummer</label></li>
        		     <li><input id="nummer" type="text" name="nummer" value="<?=$nummer;  ?>" <?= ( isset( $_GET['focus'] ) && $_GET['focus'] == "nummer" ) ? 'autofocus' : '' ?> /></li>
                     <li><label>gemeente</label></li>
                     <li><input id="gemeente" type="text" name="gemeente" value="<?=$gemeente;  ?>" <?= ( isset( $_GET['focus'] ) && $_GET['focus'] == "gemeente" ) ? 'autofocus' : '' ?> /></li>
                     <li><label>postcode</label></li>
                     <li><input id="postcode" type="text" name="postcode" value="<?=$postcode; ?>" <?= ( isset( $_GET['focus'] ) && $_GET['focus'] == "postcode" ) ? 'autofocus' : '' ?> /></li>
        		     <li><button type="submit" name="submit">volgende</button></li>
        		 </ul>
                </fieldset>
    		</form>
<p>
Hello visitor, you have seen this page <?= $_SESSION['count']; ?> times.
</p>

            <a href="opdracht_sessions_adres.php?session=destroy">begin opnieuw</a>
<?php var_dump($_SESSION) ?>
        </div>
        <script src="js/main.js"></script>
    </body>
</html>