<?php 

/**
* 
*/
class Register_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}


	public function createUser( $email, $pass ){

		$results = array();

		$salt = uniqid( rand(), true );

		$hashedPassword	= hash( 'sha512', $salt.$pass );

		$queryStr = 'INSERT INTO users ( email, password, salt, last_login_time )
                     VALUES ( :email, :password, :salt, NOW() )';

        $valToBind = array( ':email' => $email, ':password' => $hashedPassword, ':salt' => $salt );

        //__SETTING A COOKIE __//
        $cookie  = self::setCookie( $salt, $email );

        //__RESULTS__//
        $results['results'] = $this->query( $queryStr, $valToBind );
        $results['cookie'] = $cookie;

        header('location: ../dashboard');

        return $results;

	}

	public static function setCookie( $salt, $email ){

		$time = (60*60*24*30);

		$hashedEmail = hash( 'sha512', $salt.$email );

		$val = $email.'##'.$hashedEmail;

		Cookies::set('login', $val, $time);

	}

	public function message(){

		return "i'm a register page";
		
	}
}

 ?>