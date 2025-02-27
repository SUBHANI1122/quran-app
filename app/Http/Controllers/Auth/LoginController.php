<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
  protected $redirectTo = '/home';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
    $this->middleware('auth')->only('logout');
  }

  public function showLoginForm()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('auth.login', ['pageConfigs' => $pageConfigs]);
  }

  /**
   * Override the credentials method to include status check.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  protected function credentials(Request $request)
  {
    return array_merge($request->only($this->username(), 'password'), ['status' => 1]);
  }

  /**
   * Customize the failed login response.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
   */
  protected function sendFailedLoginResponse(Request $request)
  {
    if (!\App\Models\User::where($this->username(), $request->{$this->username()})->where('status', 1)->exists()) {
      return redirect()->back()->withErrors([
        $this->username() => 'Your account is inactive. Please contact support.',
      ]);
    }

    return redirect()->back()->withErrors([
      $this->username() => trans('auth.failed'),
    ]);
  }
}
