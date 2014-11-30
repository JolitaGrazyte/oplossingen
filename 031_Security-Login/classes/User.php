<?php 

class User{

	public static function createUser($email, $pass){

		$salt = uniqid(rand(), true);

		$hashedPassword	=	hash( 'sha512', $salt.$pass );

		$queryStr = 'INSERT INTO users (email, hashed_password, salt, last_login_time)
                     VALUES (:email, :password, :salt, NOW())';

        $valToBind = array(':email' => $email, ':password' => $hashedPassword, ':salt' => $salt);

        $cookie 	= 	self::setCookie( $salt, $email );

        $results = array('queryStr' => $queryStr, 'valuesToBind' => $valToBind, 'cookie' => $cookie); 

        return $results;

	}

	public static function setCookie( $salt, $email ){

		$time = (60*60*24*30);

		$val = $email.','.hash( 'sha512', $salt.$email );

       	$cookie = setCookie('login', $val, time()+$time);

       	return $cookie;

	}

	public static function authenticate( $authenticated = false ){

		if (isset($_COOKIE['login'])) {

            $authenticated = true;

		}
		else {
			
			$authenticated = false;
		}
		return $authenticated;
		
	}


	public static function logout(){

		unset($_SESSION['login']);

		$unsetCookie = setCookie('login', '', 0);

		return $unsetCookie;

	}

}

 ?>