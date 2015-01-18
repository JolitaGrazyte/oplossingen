<?php 

/**
* 
*/
class Login_Model extends Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function login( $email ){

			$pass  = $_POST['pass'];

			$bindValues	=	false;

			$query 		=	'SELECT * FROM users';

			if ( $email !== false ){
				
				$query .= ' WHERE email = :email';

				$bindValues	=	array( ':email' => $email );
			}

		$user = $this->query( $query, $bindValues );

		if( isset( $user['data'][0] ) ){

			var_dump( $user['data'] );	

			$email = $user['data'][0]['email'];

			$salt  = $user['data'][0]['salt'];

			$dbPass = $user['data'][0]['password'];

			$newHashedPass = hash( 'sha512', $salt . $pass );


			if ( $newHashedPass == $dbPass ){

				$query 		=	'UPDATE users 
								 SET last_login_time = NOW()
								 WHERE email = :email';

				$bindValues	=	array( ':email' => $email );

				$this->query( $query, $bindValues );
				
				$cookie = self::setCookie( $salt, $email );

				Session::set( 'login', $email, $user['data'][0]['id'] );

				header('location: ../dashboard');

			} else {
				
				header('location: ../login');
			}

		}

		else header('location: ../login');

		}


	public static function setCookie( $salt, $email ){

		$time = (60*60*24*30);

		$hashedEmail = hash( 'sha512', $salt.$email );

		$val = $email.'##'.$hashedEmail;

		Cookies::set('login', $val, $time);

	}

	public function authenticate(){

		$cookie = Cookies::get('login');

		if ( isset( $cookie ) ) {

			$cookieData  = explode('##', $cookie );

			$email 		 = $cookieData[0];

			$hashedEmail = $cookieData[1];

			$queryStr = 'SELECT *
					 	 FROM 	users
	                	 WHERE 	email = :email';

	        $valToBind = array(':email' => $email);

	        $user = $this->query( $queryStr, $valToBind );

	       
				if( isset( $user['data'][0] ) ){

					$salt = $user['data'][0]['salt'];

					$newHashedEmail = hash( 'sha512' , $salt . $email );

					if ( $newHashedEmail == $hashedEmail )
					{
						return true;
					}
					else
					{
						return 'wrong password';
					}
				}
				else
				{
					return 'no user';
				}
			}
			else
			{
				return 'no cookie';
			}
		
	}
	public function message(){

		return "i'm a login page";
		
	}

}

 ?>