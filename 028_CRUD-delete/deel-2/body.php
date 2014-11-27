
 <body>
     <h2>Overzicht van de brouwers</h2>
     <?php if ($messages): ?>
        <?php foreach ($messages as $value): ?>
            <div class="<?=$value['type'] ?>"><?=$value['text'] ?></div> 
        <?php endforeach ?>
    <?php endif ?>


     
  	<?php if ($delete): ?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <button name="ja" type="submit" value="<?=$valToDelete ?>">JA</button>
            <button name="nee" type="submit" value="nee">NEE</button>
        </form>
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
        <tr class="<?=($row['brouwernr'] == $valToDelete) ? 'toBeDeleted' : '' ?>">
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
