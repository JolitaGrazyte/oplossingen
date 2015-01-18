<?php


class LoginController extends BaseController {

	
	public function getLogin(){

		return View::make("login")->with( 'title', 'LOGIN' );
	}

	public function postLogin(){

		$validator = Validator::make( Input::all(), array(

			'email' 	=> 'required|email',
			'password' 	=> 'required'

		));

		if ( $validator->fails() ) {
			//die('Failed!');
			return Redirect::route('login')
			// ->withErrors( $validator )
			->with( 
				Session::flash('inputerror', 'Er ging iets mis. Email en/of password zijn niet geldig of leeg.'),
				Session::flash( 'message-class', 'inputerror'))
			->withInput();
		}
		else{

			$remember = ( Input::has('remember')) ? true : false;

			$userAuth = Auth::attempt( array(

				'email' 	=> Input::get('email'),
				'password' 	=> Input::get('password'),
				'active' 	=> 1

				), $remember );

			if ($userAuth) {
				return Redirect::intended( '/dashboard' );
			}
		}
	}

	
	public function getActivate( $activateCode ){

		$user = User::where( 'activateCode', '=', $activateCode )->where('active', '=', 0 );

		if ( $user->count() ) {
			$user = $user->first();

			$user->active = 1;
			$user->activateCode = '';

			if ( $user->save() ) {

				Auth::loginUsingId($user->id);

				return Redirect::intended( '/dashboard' )
					->with(
						Session::flash( 'message', 'Pfieuw, het registreren is gelukt. Welkom!' ),
						Session::flash( 'message-class', 'success' )

					);
			}
		}


		return Redirect::route( 'home' )
			->with(
					Session::flash( 'message', 'Er is iets mis gegaan!' ),
					Session::flash( 'message-class', 'error' )

					);	

	}

}
