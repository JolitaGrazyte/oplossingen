<!doctype html>
<?php 

$individueelArtikel = false;
if (isset($_GET['id'])) {
    $individueelArtikel = true;
}
	$artikels = array(
        array('title' => 'Web Design is 95% Typography', 'datum' => 'october 19, 2006','inhoud' =>file_get_contents('txt1.txt'), 'afbeelding' => 'img/koih.gif', 'afbeeldingBeschrijving' => ''), 
        array('title' => 'Building a Better Node Community.', 'datum' => 'october 10, 2014', 'inhoud' => file_get_contents('txt2.txt'), 'afbeelding' => 'img/img2.png', 'afbeeldingBeschrijving' => ''), 
        array('title' => "Don't Copy Ideas, Steal Them!", 'datum' => 'october 6, 2013', 'inhoud' => file_get_contents('txt3.txt'), 'afbeelding' => 'img/picasso.jpg', 'afbeeldingBeschrijving' => ''));
    $kort_inhoud = array();
foreach ($artikels as $key => $value) {
    $kort_inhoud[] = substr($artikels[$key]['inhoud'], 0, 210);
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht GET</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <div class="container">
    <h1>Opdracht GET</h1>
    <form action="" method="get">
        <input type="text"><button>Search</button>
    </form>
    <?php if (!($individueelArtikel)): ?>
            
            <?php  foreach ($artikels as $key => $value): ?>
                <article class="kort_artikel">
                <h2><?=$value['title'] ?></h2>
                <p><?=$value['datum'] ?></p>
                <img src="<?=$value['afbeelding'] ?>" alt="<?= $value['afbeeldingBeschrijving']  ?>" width=250>
                <p><?=$kort_inhoud[$key] ?></p>
                <a href="<?="opdracht-get.php?id=$key" ?>">Lees meer</a>
                 </article>
                <?php endforeach; ?>
    <?php endif; ?>

            <article class="lang_artikel">
                <h2><?=$artikels[$_GET['id']]['title'] ?></h2>
                <p><?=$artikels[$_GET['id']]['datum'] ?></p>
                <img src="<?=$artikels[$_GET['id']]['afbeelding'] ?>" alt="<?=$artikels[$_GET['id']]['afbeeldingBeschrijving']  ?>" width=200>
                <p><?=$artikels[$_GET['id']]['inhoud'] ?></p>
                <?php if ($individueelArtikel): ?>
                <a href="<?="opdracht-get.php" ?>">Back</a>
                <?php endif; ?>
            </article>
            <?=var_dump($artikels)  ?>
        </div>
        <script src="js/main.js"></script>
    </body>
</html>