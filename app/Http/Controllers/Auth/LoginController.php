<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected function redirectTo(){
        if(Auth::user()->typ_id == 1){
            return 'admin/dashboard';
        }
        else if(Auth::user()->typ_id == 2){
            if(Auth::user()->us_id == 1){
                return 'adviser/dashboard';
            }
            else{
                return 'account/conflictAccount';
            }
        }
        else if(Auth::user()->typ_id == 3){
            if(Auth::user()->us_id == 1){
                return 'student/dashboard';
            }
            else{
                return 'account/conflictAccount';
            }
        }
        else if(Auth::user()->typ_id == 4){
            if(Auth::user()->us_id == 1){
                return 'subjectteacher/dashboard';
            }
            else{
                return 'account/conflictAccount';
            }
        }
        else if(Auth::user()->typ_id == 5){
            if(Auth::user()->us_id == 1){
                return 'panel/dashboard';
            }
            else{
                return 'account/conflictAccount';
            }
        }
        else if(Auth::user()->typ_id == 6){
            if(Auth::user()->us_id == 1){
                return 'adviser/dashboard';
            }
            else{
                return 'account/conflictAccount';
            }
        }
        else{
            return '/home';
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
