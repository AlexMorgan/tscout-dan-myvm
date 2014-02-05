<?php

class WebserviceController extends BaseController {

	public function divein()
	{
		return View::make('education.divein');
	}

	public function demosignin()
	{
		return View::make('education.demosignin');
	}

	public function loginWithGoogle() {

    	// get data from input
    	$code = Input::get( 'code' );

    	// get google service
    	$googleService = OAuth::consumer( 'Google' );

    	// check if code is valid

    	// if code is provided get user data and sign in
    	if ( !empty( $code ) ) {

        	// This was a callback request from google, get the token
        	$token = $googleService->requestAccessToken( $code );

        	// Send a request with it
        	$result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );

        	$message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
        	echo $message. "<br/>";

            $email = User::where("email", "==", $result["email"]);

            if ( $result['email'] != $email ) {

                $user           = new User();
                $user->email    = $result["email"];
                $user->username = $result["name"];
                $user->save();
                dd($result);

            }

            else {


                //Var_dump
                //display whole array().
                dd('user exists');
            }
        	

    	}
    	// if not ask for permission first
    	else {
        	// get googleService authorization
        	$url = $googleService->getAuthorizationUri();

        	// return to facebook login url
        	return Response::make()->header( 'Location', (string)$url );
    	}
	}

    public function loginWithFacebook() {

        // get data from input
        $code = Input::get( 'code' );

        // get fb service
        $fb = OAuth::consumer( 'Facebook' );

        // check if code is valid

        // if code is provided get user data and sign in
        if ( !empty( $code ) ) {

            // This was a callback request from google, get the token
            $token = $fb->requestAccessToken( $code );

            // Send a request with it
            $result = json_decode( $fb->request( '/me' ), true );

            $message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
            echo $message. "<br/>";

            //Var_dump
            //display whole array().
            dd($result);

        }
        // if not ask for permission first
        else {
            // get fb authorization
            $url = $fb->getAuthorizationUri();

            // return to facebook login url
            return Response::make()->header( 'Location', (string)$url );
        }

    }    

}