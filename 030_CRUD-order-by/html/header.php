 <!doctype html>
 <html>
     <head>
         <meta charset="utf-8">
         <meta name="description" content="">
         <meta name="viewport" content="width=device-width, initial-scale=1">
			<?php if (!empty($title)): ?>
         		<title><?=$title ?></title>
            <?php else: ?>
                <title></title>
         	<?php endif ?>
         <link rel="stylesheet" href="./css/style.css">

     </head>

     <header>
     <?php if (!empty($title)): ?>
     	<h1><?=$title ?></h1>
     <?php endif ?>
     </header>