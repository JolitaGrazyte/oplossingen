
<section>

<h1>De TODO-App</h1>

<!-- MESSAGE -->
<?php if ( isset( $this->msg ) && !empty( $this->msg )): ?>

		<?php foreach ($this->msg as $val): ?>
			
			<p class="message <?=$val['type'] ?>"><?=$val['text'] ?></p>	
			
	<?php endforeach ?>

<?php endif ?>
<!-- end of MESSAGE -->


<?php if ( isset( $this->todosArr )  || isset( $this->doneArr )): ?>
	
	<?php if (!empty( $this->todosArr ) || !empty( $this->doneArr ) ): ?>
	
	<h2>Wat moet er allemaal gebeuren?</h2>

	<a class="addTodo" href="<?=URL ?>/todo/addTodo/"> Voeg Toe</a>

<!-- TODOS -->
	<?php if ( isset( $this->todosArr ) && !empty( $this->todosArr ) ): ?>
	
	<h2>Todos</h2>

	<ul>
		<?php foreach ( $this->todosArr as $val): ?>
			
			<li class="todo">

					<span class="activate" title="Vink maar af">
						<a class="icon" href="<?=URL ?>/todo/toggleStatus/<?=$val['id'] ?>" ></a>
					</span>
					
						<span class="text"> <?=$val['name'] ?> </span>
				
					<span class="delete" title="Verwijder dit maar">
						<a class="icon" href="<?=URL ?>/todo/deleteTodo/<?=$val['id'] ?>" ></a>
					</span>

			</li>

		<?php endforeach ?>
	</ul>

<?php else: ?>
	<p>
		
		Allright, all done!

	</p>

<?php endif ?>

<!-- end of TODOS -->
		
<!-- DONES -->		
	
	<h2>Dones</h2>
	
	<?php if ( isset( $this->doneArr ) && !empty( $this->doneArr )): ?>
		
		<ul> 
		    <?php foreach ($this->doneArr as $val): ?>

				<li class="done">

					<span class="activate" title="Vink maar af">
						<a class="icon" href="<?=URL ?>/todo/toggleStatus/<?=$val['id'] ?>" ></a>
					</span>
					
						<span class="text"> <?=$val['name'] ?> </span>
				
					<span class="delete" title="Verwijder dit maar">
						<a class="icon" href="<?=URL ?>/todo/deleteTodo/<?=$val['id'] ?>" ></a>
					</span>

				</li>

			<?php endforeach ?>
		</ul>
 		
	<?php else: ?>
		<p>
			
			Damn, werk aan de winkel...

		</p>

	<?php endif ?>
<!-- end of DONES -->

<?php else: ?>
	Nog geen todo-items. <a class="addTodo" href="<?=URL ?>/todo/addTodo/"> Voeg Toe</a>

<!-- end of checking isset todoARR -->
		<?php endif ?>

<?php endif ?>

<!-- end of checking isset todoARR -->


<form action="<?=URL ?>/todo/addTodoProcess/" method="POST">
	
	<?php if ( $this->voegToe ): ?>

	<label for="addTodo">Wat moet er gedaan worden?</label>

	<p>
		<input style="display:none" 
			class="uid" 
			type="hidden"
			name="user_token"
			value="<?=$this->uid ?>">
		</input>
	</p>

	<p><input type="text" class="voegToe" name="addTodo"></input></p>

	<p><input class="submit" name="submit" type="submit"></input></p>

<?php endif ?>

</form>

<!-- <div>

	<?=var_dump( $this->todosArr ) ?>
	<?=var_dump( $this->doneArr ) ?>

	<?php if ( !empty($this->msg) ): ?>
		<?=var_dump( $this->msg ) ?>
		<?php endif ?>
	
    <?=var_dump($_SESSION) ?>
    <?=var_dump($_COOKIE) ?>
</div> -->


</section>  


