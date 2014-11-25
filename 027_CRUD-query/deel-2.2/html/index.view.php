
<div class="container">
    <section id='about'>

<?php foreach ($messages as $message): ?>
	<div class="modal <?= $message[ 'type' ] ?>">
		<?=$message['text'];  ?>
		</div>
<?php endforeach ?>

  <h2>Bieren</h2>

     <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
     <select name="brouwernr">
     <?php foreach ($brouwers as $row): ?>
        <?php if ($row['brouwernr'] == $_GET['brouwernr']): ?>
         
        <option id="brouwernr" selected value="<?=$row['brouwernr'] ?>"><?=$row['brnaam'] ?></option>
     
     <?php else: ?>

        <option <option id="brouwernr" value="<?=$row['brouwernr'] ?>"><?=$row['brnaam'] ?></option>

    <?php endif ?>
    <?php endforeach ?>

     </select>
     <input type="submit" value='Geef alle bieren van brouwerij'/>

     </form>
<?php if ($bierenStatus): ?>
    <table>
        <thead>
        <tr>
        <?php foreach ($brouwers as $key => $row): ?>
            <?php if ($row['brouwernr'] == $_GET['brouwernr']): ?>
         
        <th>Bieren van <?=$row['brnaam'] ?> </th>
     
     <?php endif ?>
        <?php endforeach ?>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($bieren as $row): ?>
        <tr>
            <td>    <?=$row['naam']       ?>  </td>
        </tr>
        <?php endforeach ?>
        </tbody>
        <tfoot></tfoot>
     </table>
<?php endif ?>

</section>

</div>

