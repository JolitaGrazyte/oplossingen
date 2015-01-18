
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>todo app mvc</title>
        <link rel="stylesheet" href="<?= URL ?>/public/css/global.css">
    </head>
    <body>

    <header>
        <div class="homeLink"><a href="<?= URL ?>/home">home</a></div>
        <nav class="">
            <ul>
              <?php if ( $this->loggedIn ) : ?>

                <li><a href="<?= URL ?>/todo"> todos </a></li>
                <li><a href="<?= URL ?>/dashboard"> dashboard </a></li>
                <li><a href="<?= URL ?>/public/dashboard/logout/" >logout ( <?=$this->email ?> ) </a></li>


              <?php else: ?>

                <li><a href="<?= URL ?>/login"> login </a></li>
                <li><a href="<?= URL ?>/register"> register </a></li>

              <?php endif ?>
              
            </ul>
        </nav>
        </header>


