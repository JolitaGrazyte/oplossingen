<body>
    <h1><?=$title ?></h1>
     <h2>Overzicht van de bieren</h2>
     <?php if ($messages): ?>
        <?php foreach ($messages as $value): ?>
            <div class="<?=$value['type'] ?>"><?=$value['text'] ?></div> 
        <?php endforeach ?>
    <?php endif ?>
     <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
     <table>
        <thead>
        <tr>
        <th>#</th>
        <?php foreach ($thead as $value): ?>
            <th><?=$value ?></th>
        <?php endforeach ?>
        <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($brouwers as $indx => $row): ?>
        <tr>
        <td> <?=($indx+1) ?> </td>
            <?php foreach ($row  as  $value): ?>
                <td> <?=$value ?> </td>
            <?php endforeach ?>
            <td><button class="delete" name="delete" type="submit" value="<?=$row['brouwernr'] ?>"></button></td>
        </tr>
        <?php endforeach ?>
        </tbody>
        <tfoot></tfoot>
        
     </table>
     </form>
</body>
