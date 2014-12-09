<?php 
session_start();

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}

$isEmailValid = filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ? true : false;

//___destroy session__//
if (isset($_GET['session'])) {
    
    if ($_GET['session'] === 'destroy') {

        session_destroy();

        Header('Location: registratie-form.php');
    }
}

if ( isset( $_POST['generatePass'] ) ) {


    $pass = GeneratePass::generatePassword( 25 );

    if ( $isEmailValid ) {
        
        $_SESSION['registratie']['email'] = $_POST['email'];
        
        $_SESSION['registratie']['pass']  = $pass;

        Header('Location: registratie-form.php');

    }
    else{
        
        Message::setMessage('Dit is geen geldig e-mailadres. Vul een geldig e-mailadres in.', 'error');
        Header('Location: registratie-form.php');

    }
        
}

if (isset($_POST['submit'])) {

    if ( $isEmailValid && !empty($_POST[ 'password' ]) ) {

        $email = $_POST[ 'email' ];
        $pass  = $_POST[ 'password' ];

        $_SESSION['registratie']['email'] = $email; 
        $_SESSION['registratie']['pass']  = $pass;


        try {

            //___make connection to database___//
            $msqlConn = new MsqlConnect( 'file_upload', 'jolita', 'zN6br4fLYVJ8pSNy');

            //___CREATE USER and query string with hashed password etc.
            $createUser = User::createUser($msqlConn, $email, $pass);

            //__pass query string and values to bind__//
            $isSubmited = $createUser['results'][0];
            $error      = $createUser['results'][1];     

            if ( $isSubmited ) {

                //__if new user successfully submited__//

                session_destroy();

                header('Location: dashboard.php');

            }
            
            else{
            //__if getting an error__//

                if ( strchr( $error, 'Duplicate' ) ) {

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
        }
        catch (PDOException $e) {

             $error = $e->getMessage();

            $message  =  'Er ging iets mis. Probeer opnieuw of neem contact op met de systeembeheerder.
                                <a class="contact" href="mailto:jolita@wgwstore.com?subject=Registratie niet gelukt&body='.$error.'">jolita@wgwstore.com</a>';
                            
            Message::setMessage($message, 'error');

            Header('Location: registratie-form.php');
            
        }
        

    }elseif ( empty($_POST[ 'password' ] ) ) {
    
        Message::setMessage('Email en/of password leeg', 'error');
    
        Header('Location: registratie-form.php');

    }     
}


 ?>