<?php


class LogoutController extends BaseController {


	public function getLogout(){

		Auth::logout();
		return Redirect::route('home')->with(

				Session::flash('message', 'Je bent afgemeld. Tot de volgende keer!'),
				Session::flash('message-class', 'success')
			);
	}

	

}
