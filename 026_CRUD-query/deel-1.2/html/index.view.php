
<div class="container">
    <div class="wrapper">
    <section id='about'>

       <article>
<?php foreach ($messages as $message): ?>
	<div class="modal <?= $message[ 'type' ] ?>">
		<?=$message['text'];  ?>
		</div>
<?php endforeach ?>

  <table>
     	<thead>
     	<tr>
        <th>#</th>
  		<?php foreach ($thead as $value): ?>
     		<th><?=$value ?></th>
     	<?php endforeach ?>
     	</tr>
     	</thead>
     	<tbody>
     	<?php foreach ($bieren as $indx => $row): ?>
     	<tr>
        <td> <?=($indx+1) ?> </td>
            <?php foreach ($row as  $value): ?>
                <td> <?=$value ?> </td>
            <?php endforeach ?>
     	</tr>
     	<?php endforeach ?>
     	</tbody>
     	<tfoot></tfoot>
     </table>

       </article>
    </section>
    <aside>
    	
    </aside>
    
    </div>
</div>