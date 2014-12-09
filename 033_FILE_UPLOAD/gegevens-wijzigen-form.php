<?php 
session_start(); 

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}

$msqlConn = new MsqlConnect( 'file_upload', 'jolita', 'zN6br4fLYVJ8pSNy');

$img = isset( $_SESSION['profileImg'] ) ? $_SESSION['profileImg'] : '';

$email = isset( $_SESSION['login']['email'] ) ? $_SESSION['login']['email'] : '';

//var_dump($_SESSION);

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

 <!doctype html>
 <html>
     <head>
         <meta charset="utf-8">
         <meta name="description" content="">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Gegevens wijzigen</title>
         <link rel="stylesheet" href="css/style.css">
    
     </head>
     <body>

         <header>

        <a href="dashboard.php">Terug naar dashboard</a> | Ingelogd als <a href="<?=$email ?>"><?=$email ?></a>  | <a href="logout.php">uitloggen</a>
        
        <div class="message">
            
        <?php if ($messages): ?>
            <?php foreach ($messages as $value): ?>

                <div class="<?=$value['type'] ?>"><?=$value['text'] ?></div> 

            <?php endforeach ?>
        <?php endif ?>

        </div>


    </header>

     <h1>Gegevens wijzigen</h1>
     
     <!-- <form action=""></form> -->

     <form action="gegevens-bewerken.php" method="POST" enctype="multipart/form-data">

     	<img src="<?=$img ?>" alt="<?='Profile photo van '.$email ?>" class="profile_img">

     	<input type="file" name="file" class="file" ></input>

     	<input type="email" name="email" class="email" value="<?=(isset($_POST['email']) ? $_POST['email'] : $email )  ?>"></input>

     	<input id="submit" name="submit" type="submit" value="wijziging opslaan"></input>

        <a href="?session=destroy">begin opnieuw</a>
    </form>

     </body>
 </html>