<?php

/**
* 
*/
class RegisterController extends BaseController {

	public function getAccount(){

		return View::make("register");
		
	}

	public function postAccount(){

		$validator = Validator::make( Input::all(),

			array(
				'email' 			=> 'required|email|unique:users',
				'password' 			=> 'required|min:8',
				'retype-password' 	=> 'required|same:password'

				)
		);


		if ( $validator->fails() ) {
			//die('Failed!');
			return Redirect::route('register')
			->withErrors($validator)
			->withInput();
		}
		else{
			
			//Register
			$email 		= Input::get('email');
			$password 	= Input::get('password');

			//Activate
			$activateCode = str_random(60);

			$user = User::create(array(
				'email' 		=> $email,
				'password' 		=> Hash::make( $password ),
				'activateCode' 	=> $activateCode,
				'active' 		=> 0

				));

			if ( $user ) {


				return Redirect::route('activate', $activateCode);



//_________________IF EMAIL ACTIVATION________________________________//

				//send account activation email
				// Mail::send( 'emails.auth.confirm', 
				// 	array( 'link' => URL::route('activate', $activateCode), 'email' => $email), 
				// 		function( $message ) use ( $user ) {
				// 		$message->to( $user->email )->subject('Activation mail');
				// });
				
				// return Redirect::route( 'home' )
				// 		->with( 
				// 				Session::flash('message', 'Account is successfully created! We have send You an activation email.'), 
				// 				Session::flash('message-class', 'success') 
				// 		);

				

				//return Redirect::route('activate', $activateCode)->with(

						// Session::flash( 'message', 'Pfieuw, het registreren is gelukt. Welkom!' ),
						// Session::flash( 'message-class', 'success' )

					//);

		//die('success!');

			}

			
		}

		
	}

}