    <body>
    <h2><?=$title ?></h2>
        <section>
             <h1>Voeg een brouwer toe</h1>
             <?php if ($mStatus): ?>
                <?php foreach ($messages as $value): ?>
                    <div class="<?=$value['type'] ?>"><?=$value['text'] ?></div> 
                <?php endforeach ?>
             <?php endif ?>
                 

                    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                        <ul>
                            <li>
                                <div><label for="brouwernaam">Brouwernaam</label></div>
                                <input type="text" id="brouwernaam" name="brouwernaam">
                            </li>
                            <li>
                                <div><label for="adres">adres</label></div>
                                <input type="text" id="adres" name="adres">
                            </li>
                            <li>
                                <div><label for="postcode">postcode</label></div>
                                <input type="text" id="postcode" name="postcode">
                            </li>
                            <li>
                                <div><label for="gemeente">gemeente</label></div>
                                <input type="text" id="gemeente" name="gemeente">
                            </li>
                            <li>
                                <div><label for="omzet">omzet</label></div>
                                <input type="text" id="omzet" name="omzet">
                            </li>
                        </ul>
                        <div><input class="submit" type="submit" name="submit"></div>
                        
                    </form>
        </section>
