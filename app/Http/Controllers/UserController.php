<?php namespace App\Http\Controllers;
use Request;
use Mail;
use Session;
use Input;
use DB;
use App\Http\Controllers\Controller;
use App\QCache;
use App\Authentication\Service as Auth;
use App\Models\User as UserDBModel;
use App\Models\AclRoles as RoleDBModel;
use Config;

class UserController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| User Controller
	|--------------------------------------------------------------------------
	|
	| This controller handle all process related to user like login, logout, reset password
	|
	*/

    protected  static $_user_infor;

    /**
     * Constructor function
     * Set current user information
     */
    public function __construct() {
        self::$_user_infor = Auth::getAuthInfo();
    }

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}


    public function login()
    {
        return view('user.login');
    }

    public function doLogin(\Illuminate\Http\Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $authService = new Auth();

        $isAuthVerify = $authService->authenticate(
            new \App\Authentication\DbAdapter($email, $password)
        );

        if(!$isAuthVerify) {
            Session::flash('flash_error',trans('messages.wrong_pass_or_email'));
            return redirect('/login');
        }
        if(!Auth::getAuthInfo()->confirmation) {
            Auth::clearAuthInfo();
            Session::flash('flash_error',trans('messages.email_have_not_confirm'));
            return redirect('/login');
        }
        if(!Auth::getAuthInfo()->active) {
            Auth::clearAuthInfo();
            Session::flash('flash_error',trans('messages.user_was_blocked'));
            return redirect('/login');
        }
        return redirect('/dash');
    }

}
