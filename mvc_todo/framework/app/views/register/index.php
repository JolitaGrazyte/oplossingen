<section>

<h1>Register PAGE</h1>

<?= $this->msg; ?>

<form action="<?=URL ?>/register/register" method="POST"> 

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
