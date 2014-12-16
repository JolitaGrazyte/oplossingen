<?php 
    
function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}
    $admin_email = 'jolita@wgwstore.com';
    $messages = Message::getMessages();
    $valToDelete = isset( $_POST['delete'] ) ? $_POST['delete'] : false;
    $editForm = false;
    $brouwernr = isset( $_GET['brouwernr'] )? $_GET['brouwernr'] : '';

    $colNames = false;
    $bierenOverzicht = false;
    $selectedBieren = false;

    $order = 'ASC';
    $limit = ' LIMIT 10';
    $colToOrderBy = 'bieren.biernr';

    var_dump( $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

    $url = "http://oplossingen.web-backend.local/036_mod-rewrite-single-point-of-entry/bieren/";
    
    try{

        if (isset($_GET['orderBy'])) {

            $orderByArr = explode('-', $_GET['orderBy']);
            $colToOrderBy = $orderByArr[0];

            
                if ($orderByArr[1] === 'DESC') {
                    $order = 'ASC';
                }

                else{
                    $order = 'DESC';
                }
        }

        //__connection__//
        $msqlConn = new MsqlConnect('bieren', 'jolita', 'zN6br4fLYVJ8pSNy');
        $brouwers = Brouwers::getAllBrouwers( $msqlConn );

        
        // $colNames = array(  'biernr'     => 'Biernummer (PK)', 
        //                     'naam'       => 'Biernaam', 
        //                     'brnaam'     => 'Brouwernaam', 
        //                     'soort'      => 'Soort', 
        //                     'alcohol'    => 'Alcoholpercentage',
        //                     'brouwernr'  => 'Brouwernr(PK)' );

        
        if ( isset( $_GET['method'] ) ) {

            $useMethod = $_GET['method'];

            switch ( $useMethod ) {

                case 'overview':

                    //__get oveview of ALL products__//
                    $bierenOverzicht = Bieren::overview( $msqlConn, array( ':val' => 1 ), $colToOrderBy, $order,  $limit );

                    //__get oveview of SELECTED products__//
                    if ( isset($_GET['brouwernr']) ) {

                        $selectedBieren =  Bieren::overview( $msqlConn, array( ':val' => $brouwernr ), $colToOrderBy, $order,  $limit );
                    }
                
                break;

                case 'update':
                    //__get oveview of ALL products__//

                    $editForm = true;
                    $toEdit = Bieren::overview( $msqlConn, array( ':val' => $brouwernr ), $colToOrderBy, $order,  $limit );

                    $bierenUpdate = Bieren::update( $msqlConn, array( ':naam' => 'jolita TEST', ':brouwernr' => $brouwernr ) );
                    //header( 'Location:'.$url.'bieren/overview/127');
                
                break;

                case 'delete':

                    if ( isset($_GET['ja'] ) ) {

                       $deleteBier = Bieren::delete( $msqlConn, array( ':brouwernr' => $brouwernr ) );

                       if ( $deleteBier[0] ) {
                           Message::setMessage( 'deleted', 'success' );
                       }
                       else{

                           Message::setMessage( $deleteBier[1], 'error' );     
                       }

                       
                    }
                    
   
                break;

                case 'insert':

                    $newBier = Bieren::insert( $msqlConn, $valToBind );
   
                break;

            }

        }
        
  
} 
catch (PDOException $e) {
    
    $message = 'Sorry, failed! '.$e->getMessage();
    
    Message::setMessage($message, 'error');
    
}

 ?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>mod_rewrite single point of entry</title>
        <link rel="stylesheet" href="http://oplossingen.web-backend.local/036_mod-rewrite-single-point-of-entry/css/style.css">
    </head>

    <body>

    <header>
        
          <?php if ( $messages ): ?>

            <?php foreach ( $messages as $value ): ?>

                <div class="<?=$value['type'] ?>"><?=$value[ 'text'] ?></div>
        
            <?php endforeach ?>
        
        <?php endif ?>

    </header>

    <div class="container">

<!--SELECT BROUWER-->
    <aside>
        <h2>Brouwers</h2>

            <ul>
                <?php foreach ( $brouwers['data'] as $row ): ?>

                <li><a href="<?=$url ?>overview/<?=$row['brouwernr'] ?>"><?=$row['brnaam'] ?></a></li>
         
                <?php endforeach ?>  
        
        </ul>
        

    </aside>
    <section>

        <form action="<?=$url ?>" method="GET">
     
            <select name="brouwernr">
            
                <?php foreach ( $brouwers['data'] as $row ): ?>
                
                    <?php if ( $row['brouwernr'] == $brouwernr ): ?>
         
                        <option id="brouwernr" selected value="<?=$row['brouwernr'] ?>"><?=$row['brnaam'] ?></option>
     
                    <?php else: ?>

                        <option <option id="brouwernr" value="<?=$row['brouwernr'] ?>"><?=$row['brnaam'] ?></option>

                    <?php endif ?>

                <?php endforeach ?>

     </select>

     <input type="submit" value='Geef alle bieren van brouwerij'/>

     </form>

    </section>

<!--end of SELECT BROUWER-->

    <section>

    <h2>Overzicht van de bieren</h2>
<!-- BIEREN EDIT -->
        <?php if ( $editForm ): ?>

            <?=var_dump($toEdit) ?>

        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            
            <h2>Brouwerij <?=$brouwernr ?> wijzigen.</h2>
            
            <?php foreach ( $toEdit['colNames'] as $colVal): ?>

                <label for="<?= $colVal  ?>"><?=$colVal ?></label>

            <?php endforeach ?>
              
            <?php foreach ( $toEdit['data'][0] as $val ): ?>
  
                <!-- <?php if ( $val !=$brouwernr ): ?> -->
                    
                    <input type="text" name="<?= $colVal ?>" value="<?= $val ?>">

                <!-- <?php endif ?> -->

            <?php endforeach ?>
            
            <input type="hidden" value="<?= $toEdit['brouwernr'] ?>" name="brouwernr">
        
            <div>
                <input class="submit" type="submit" name="submit" value="submit">
            </div>

        </form>
    
        <?php endif ?>
<!-- end of  BIEREN EDIT -->


<!-- BIEREN DELETE -->

        <a href="<?=$url ?>delete/<?=$valToDelete ?>"> <button name="ja" type="submit">JA</button></a>

        <button name="nee" type="submit" value="nee">NEE</button>

<!-- end of  BIEREN DELETE -->

<!-- BIEREN OVERZICHT -->
    <!-- <form action="<?=$_SERVER['PHP_SELF']?>" method="POST"> -->
    <?php if ( $selectedBieren || $bierenOverzicht ): ?>

        <table>
            <thead>

                <tr>
                    <?php foreach ( $bierenOverzicht['colNames'] as $key => $value ): ?>

                    <th class="<?=($order == 'DESC') ? 'asc' : 'desc' ?>">

                        <a href="?orderBy=<?="$key" ?>-<?="$order" ?>"> <?=$value ?></a>

                    </th>

                    <?php endforeach ?>

                    <th>delete</th>

                    <th>edit</th>

                </tr>
            </thead>

            <tbody>

                <?php if ( $selectedBieren ): ?>

                <?php foreach ( $selectedBieren['data'] as $indx=>$row ): ?>

                <tr class="<?=($row['brouwernr'] == $valToDelete) ? 'toBeDeleted' : '' ?>">

                    <?php foreach ($row as $value): ?>
                    
                    <td><?=$value ?></td>
                    
                    <?php endforeach ?>

                    <td><a href="<?=$url ?>delete/<?=$row['brouwernr'] ?>"><button class="delete" name="delete" value="<?=$row['brouwernr'] ?>"></button></a></td>
                    
                    <td><a href="<?=$url ?>update/<?=$row['brouwernr'] ?>"><button name="update" class="edit" value="<?=$row['brouwernr'] ?>"></button></a></td>

                </tr>

                <?php endforeach ?>

                <?php elseif ( $bierenOverzicht ): ?>

                <?php foreach ( $bierenOverzicht['data'] as $indx=>$row ): ?>

                <tr class="<?=($row['brouwernr'] == $valToDelete) ? 'toDelete' : '' ?>">

                    <?php foreach ($row as $value): ?>
                    
                    <td><?=$value ?></td>
                    
                    <?php endforeach ?>

                    <td><a href="<?=$url ?>delete/<?=$row['brouwernr'] ?>"><button class="delete" name="delete" value="<?=$row['brouwernr'] ?>"></button></a></td>
                    
                    <td><a href="<?=$url ?>update/<?=$row['brouwernr'] ?>"><button name="update" class="edit" value="<?=$row['brouwernr'] ?>"></button></a></td>

                </tr>

                <?php endforeach ?>

                <?php endif ?>
            </tbody>

            <tfoot></tfoot>

        </table>

    <?php endif ?>
    <!-- </form> -->

    <!--end of BIEREN OVERZICHT -->

    </section>

    </div>

    </body>

    <?=var_dump($_GET) ?>
 </html>