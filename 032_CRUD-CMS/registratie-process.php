<?php 
session_start();

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}


//___destroy session__//
if (isset($_GET['session'])) {
    
    if ($_GET['session'] === 'destroy') {

        session_destroy();

        Header('Location: registratie-form.php');
    }
}

if ( isset( $_POST['generatePass'] ) ) {


    $pass = GeneratePass::generatePassword( 25 );

    if ( filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) {
        
        $_SESSION['registratie']['email'] = $_POST['email'];
        
        $_SESSION['registratie']['pass']  = $pass;

        Header('Location: registratie-form.php');

    }
    else{
        
        Message::setMessage('Dit is geen geldig e-mailadres. Vul een geldig e-mailadres in.', 'error');
        Header('Location: registratie-form.php');

    }
        
}


if ( isset($_POST['submit']) ) {

    if ( filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) {

        $email  =   $_POST[ 'email' ];
        $pass   =   $_POST[ 'password' ];

            if (!empty($pass)) {

                $_SESSION['registratie']['email'] = $_POST['email'];
        
                $_SESSION['registratie']['pass']  = $pass;

            }

            else{
                
                Message::setMessage( 'Genereer een password, a.u.b' , 'error');
                Header('Location: registratie-form.php');

            }

     try {

    //___CREATE USER and query string with hashed password etc.
        $createUser = User::createUser($email, $pass);

    //___make connection to database___//
        $msqlConn = new MsqlConnect('CRUD_CMS', 'jolita', 'zN6br4fLYVJ8pSNy', $createUser['queryStr']);

        $isSubmited = $msqlConn->insert_delete($createUser['queryStr'],$createUser['valuesToBind']);

        if ($isSubmited[0]) {

            //__if new user successfully submited__//

            //  T I J D E L i J K set in login session nu ook

            $_SESSION['login']['email'] = $email;

            session_destroy();

            header('Location: dashboard.php');

        }
        else{
            //__if getting an error__//

            if ( strchr( $isSubmited[1], 'Duplicate' ) ) {

                //session_destroy();

                $message = 'E-mailadres:' .$email. ' komt reeds voor in de database.';

                Message::setMessage( $message , 'error');

                Header('Location: registratie-form.php');
                
            }
            else{
              
                $message = 'Er ging iets mis. Probeer opnieuw of neem contact op met de systeembeheerder.
                            <a class="contact" href="mailto:jolita@wgwstore.com?subject=Registratie niet gelukt&body='.$isSubmited[1].'">jolita@wgwstore.com</a>';

                Message::setMessage( $message , 'error');

            }

        }

        } catch (PDOException $e) {
                            
            $error = $e->getMessage();

            $message  =  'Er ging iets mis. Probeer opnieuw of neem contact op met de systeembeheerder.
                                <a class="contact" href="mailto:jolita@wgwstore.com?subject=Registratie niet gelukt&body='.$error.'">jolita@wgwstore.com</a>';
                            
            Message::setMessage($message, 'error');
    
        }  
    }
    else {
        Message::setMessage('Email en/of password leeg', 'error');
        Header('Location: registratie-form.php');

    }
}

 ?>