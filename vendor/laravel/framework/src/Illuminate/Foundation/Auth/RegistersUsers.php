<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $all = $request->all();
        $captcha = $all['g-recaptcha-response'];
        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeRyCcUAAAAABLAVR27aE_ghOr8oaLxCBakoHEu&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
    //echo "<PRE>".print_r($response,true)."</pre>";exit;
        if ($response['success'] == '1') {
          Auth::login($this->create($request->all()));
          return redirect($this->redirectPath());
        }
        return redirect('/');
    }
}
