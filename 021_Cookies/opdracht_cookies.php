<!doctype html>
<?php   
    
    $text_file = file_get_contents('data_file.txt');
    $data = explode(',', $text_file);
    $ingelogd = false;

    if (isset($_POST['submit']))
    {
        for ($i=0; $i < sizeof($data); ++$i)
            if ($_POST['naam'] == $data[$i] && $_POST['password'] == $data[$i+1]) 
            {   $time = (60*60*24*6);
                if (isset($_POST['mijOnthouden'])) {
                    $time = (60*60*24*30);
                }

                setcookie('theCookie', '1', time()+$time);
                header('Location: opdracht_cookies.php');
            }
    }

    if (isset($_COOKIE['theCookie'])) {
            $ingelogd = true;
            $message = "U bent ingelogd.";        
    }
    else{
            $message = 'Gebruikersnaam en/of paswoord niet correct. Probeer opnieuw.';
    }

    if (isset($_GET['uitloggen']) && ($_GET['uitloggen'] == true)) 
    {
        $ingelogd = false;
        setcookie("theCookie", "1" , time()-(60*60*24*6));
        header('Location: opdracht_cookies.php');   
    }

 ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Cookies</title>
        <link rel="stylesheet" href="css/style.css">
        
    </head>
    <body>
        <div class="container">
        <h1>Opdracht Inloggen</h1>
        	<form action="<?="opdracht_cookies.php" ?>" method="POST">
            <?php if (!$ingelogd): ?>
                <h2>Inloggen</h2>
                <h2><?=$message  ?></h2>
        		 <fieldset>
        		 <ul>
        		     <li><label>gebruikersnaam</label></li>
        		     <li><input id="name" type="text" name="naam"></li>
        		     <li><label>password</label></li>
        		     <li><input id="password" type="password" name="password"></li>
        		     <li><button type="submit" name="submit">Submit</button></li>
                     <li><input type="checkbox" name="mijOnthouden" value="checked"> Mij onthouden</li>
        		 </ul>
                </fieldset>
            <?php else:  ?>
                 <h2>Dashboard</h2>
                <h2><?=$message  ?></h2>
                <p><a href="opdracht_cookies.php?uitloggen=true">Uitloggen</a></p>
            <?php endif ?>
    		</form>
        </div>
        <script src="js/main.js"></script>
    </body>
</html>