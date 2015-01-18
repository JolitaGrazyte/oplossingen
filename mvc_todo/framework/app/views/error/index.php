<section>
    
<h1>Error</h1>

<?php if ( isset( $this->msg ) && !empty( $this->msg )): ?>
		<?php foreach ($this->msg as $val): ?>
			
				<p class="message <?=$val['type'] ?>"><?=$val['text'] ?></p>	
			
	<?php endforeach ?>

<?php endif ?>

</section>

