<body>
<div class="container">
<section>
    <h2>Overzicht van de bieren</h2>
    <?php if ($messages): ?>
    <?php foreach ($messages as $value): ?>
    <div class="<?=$value['type'] ?>">
        <?=$value[ 'text'] ?>
    </div>
    <?php endforeach ?>
    <?php if (!empty($email)): ?>
        <a href="$email"><?=$email ?></a>
    <?php endif ?>
    <?php endif ?>


    <?php if ($toEdit): ?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <h2>Brouwerij <?=$valToEdit ?> wijzigen.</h2>
        <?php foreach ($toEdit as $key=>$val): ?>
        <ul>
            <?php if ($val !=$valToEdit): ?>
            <li>
                <div>
                    <label for="<?= $key  ?>">
                        <?=$key ?>
                    </label>
                </div>
                <input type="text" name="<?= $key ?>" value="<?= $val ?>">
            </li>
            <?php endif ?>
        </ul>

        <?php endforeach ?>
        <input type="hidden" value="<?= $toEdit['brouwernr'] ?>" name="brouwernr">
        <div>
            <input class="submit" type="submit" name="submit" value="submit">
        </div>

    </form>
    <?php endif ?>

    <?php if ($valToDelete): ?>
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
                    <?php foreach ($colNames as $value): ?>
                    <th>
                        <?=$value ?>
                    </th>
                    <?php endforeach ?>
                    <th>delete</th>
                    <th>edit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($brouwers as $indx=>$row): ?>
                <tr class="<?=($row['brouwernr'] == $valToDelete) ? 'toBeDeleted' : '' ?>">
                    <td>
                        <?=($indx+1) ?>
                    </td>
                    <?php foreach ($row as $value): ?>
                    <td>
                        <?=$value ?>
                    </td>
                    <?php endforeach ?>

                    <td>
                        <button class="delete" name="delete" type="submit" value="<?=$row['brouwernr'] ?>"></button>
                    </td>
                    <td>
                        <button class="edit" name="edit" type="submit" value="<?=$row['brouwernr'] ?>"></button>
                    </td>

                </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot></tfoot>

        </table>
    </form>
</section>
</div>
