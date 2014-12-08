<?php 

class User{

	public static function createUser( $msqlConn, $email, $pass ){

		$results = array();

		$salt = uniqid( rand(), true );

		$hashedPassword	= hash( 'sha512', $salt.$pass );

		$queryStr = 'INSERT INTO users ( email, hashed_password, salt, last_login_time )
                     VALUES ( :email, :password, :salt, NOW() )';

        $valToBind = array( ':email' => $email, ':password' => $hashedPassword, ':salt' => $salt );

        //__SETTING COOKIE WITH setCookie function__//
        $cookie  = self::setCookie( $salt, $email );

        //__send results to registratie process__//
        $results['results'] = $msqlConn->update( $queryStr, $valToBind );
        $results['cookie'] = $cookie;

        return $results;

	}

	public static function setCookie( $salt, $email ){

		$time = (60*60*24*30);

		$hashedEmail = hash( 'sha512', $salt.$email );

		$val = $email.'##'.$hashedEmail;

       	$cookie = setCookie('login', $val, time()+$time);

       	return $cookie;

	}

	public static function authenticate( $msqlConn ){

		if ( isset( $_COOKIE['login'] ) ) {

			$cookieData  = explode('##', $_COOKIE['login'] );

			$email 		 = $cookieData[0];

			$hashedEmail = $cookieData[1];

			$queryStr = 'SELECT *
					 	 FROM 	users
	                	 WHERE 	email = :email';

	        $valToBind = array(':email' => $email);

	        $userData = $msqlConn->query( $queryStr, $valToBind );

	       
				if( isset( $userData['data'][0] ) )
				{
					$salt = $userData['data'][0]['salt'];

					$newHashedEmail 	= hash( 'sha512' , $salt . $email );

					if ( $newHashedEmail == $hashedEmail )
					{
						return true;
					}
					else
					{
						return var_dump('wrong password');
					}
				}
				else
				{
					return var_dump('no user');
				}
			}
			else
			{
				return var_dump('no cookie');
			}

		
	}

	public static function validateLogin( $msqlConn, $email, $password ){

		$queryStr = 'SELECT *
		 		 	 FROM 	users
	                 WHERE 	email = :email';

       $valToBind = array(':email' => $email);

       $userData = $msqlConn->query( $queryStr, $valToBind );

		if( isset( $userData['data'][0] ) )
			{
				var_dump( $_POST );
				var_dump( $userData['data'][0] );

				$salt = 	$userData['data'][0]['salt'];
				$dbPass = 	$userData['data'][0]['hashed_password'];

				$newHashedPass = hash( 'sha512', $salt . $password );

				if ($newHashedPass == $dbPass)
				{
					$cookie = self::setCookie( $salt, $email );
				}

				return $cookie;
			}

	}


	public static function logout(){

		unset( $_SESSION['login'] );

		$unsetCookie = setCookie('login', '', 0);

		return $unsetCookie;

	}

}

 ?>