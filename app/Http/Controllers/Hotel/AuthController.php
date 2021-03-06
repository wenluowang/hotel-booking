<?php

namespace HotelBooking\Http\Controllers\Hotel;

use HotelBooking\Http\Controllers\Controller;
use HotelBooking\Http\Requests\Hotel\LoginRequest;
use Auth;
use Session;
use Route;

/**
 * Controller for hotel admin.
 */
class AuthController extends HotelBaseController
{
    /**
     * Authenticate object.
     */
    protected $auth;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->auth = Auth::hotel();
        $this->middleware('hotel.guest', ['except' => 'getLogout']);
    }

    /**
     * Get the login form for hotel admin.
     */
    public function getLogin()
    {
        return view('hotel.auth.login');
    }

    /**
     * Check log in data.
     */
    public function postLogin(LoginRequest $request)
    {
        $data = $request->only('username', 'password');
        $login = $this->auth->attempt($data, $request->has('remember'));
        if ($login) {
            return redirect()->route('hotel.profile');
        } else {
            Session::flash('flash_error', trans('messages.login_fail'));

            return redirect()->route('hotel.login');
        }
    }

    /**
     * Log out current hotel admin account.
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect()->route('hotel.login');
    }
}
