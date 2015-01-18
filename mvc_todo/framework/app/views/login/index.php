<section>

<h1><?=$this->title; ?></h1>

<?php if ( isset( $this->msg ) && !empty( $this->msg )): ?>
        <?php foreach ($this->msg as $val): ?>
            
            <p class="message <?=$val['type'] ?>"><?=$val['text'] ?></p>    
            
    <?php endforeach ?>

<?php endif ?>


<form action="<?=URL ?>/login/login" method="POST"> 

<ul>
    <li>
    	<label for="email">Email:</label>
    </li>
    <li>
    	<input class="email" name="email" type="text"></input>
    </li>
    <li>
    	<label for="password">Password:</label>
    </li>
    <li>
    	<input class="pass" name="pass" type="password"></input>
    </li>
</ul>
	<input class="submit" type="submit" name="submit" value="Login"></input>

</form>

</section>   
