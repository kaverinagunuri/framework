<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Translation\FileLoader;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Support\Str;
use App\User;
Use Illuminate\Support\Facades\Hash;
use DateTime;
use Mail;
use Illuminate\Http\Request;
use App\Gender;
use Auth;

class FrameworkController extends BaseController {

    use AuthorizesRequests,
        AuthorizesResources,
        DispatchesJobs,
        ValidatesRequests;

    //------------------------------Registration----------------------//


    public function index() {
        if (Auth::check()) {
            return Redirect::route('Dashboard');
        } else {

            return view('Layouts/register');
        }
    }

    public function Register() {
        $FirstName = Input::get('FirstName');
        $lastName = Input::get('LastName');
        $Gender = Input::get('gender');
        $Date = new DateTime;
        $Email = Input::get('UserName');

        $Password = Input::get('Password');
        $ValidationToken = md5($Email);
        $body = "Dear $FirstName Please click on the below link to validate your email."
                . "http://framework.karmanya.co.in/verifyEmail/$ValidationToken";

        $validator = Validator::make(Input::all(), array(
                    'UserName' => 'required|max:50|email',
                    'FirstName' => 'required|max:50|min:3',
                    'LastName' => 'required|max:50|min:3',
                    'Password' => 'required|min:6',
                        )
        );
        if ($validator->fails()) {
            return Redirect::route('index')
                            ->withErrors($validator)
                            ->withInput();
        } else {


            $info = null;
            $ExhistEmail = User::select('UserName')->where('UserName', $Email)->count();
            if ($ExhistEmail == 0) {
                $val = Mail::raw($body, function ($ValidationToken)use($Email) {

                            $ValidationToken->from('kaveri.nagunuri@karmanya.co.in', 'kaveri');
                            $ValidationToken->to($Email)->subject('Generated ');
                        });
                $GenderId = Gender::select('GenderId')->where('Name', $Gender)->get();
                $GenderId = json_decode($GenderId);
                foreach ($GenderId as $key) {
                    $Retrive_Id = $key->GenderId;
                }
                $user = User::create(['FirstName' => $FirstName,
                            'LastName' => $lastName,
                            'GenderId' => $Retrive_Id,
                            'UserName' => $Email,
                            'Password' => $Password,
                            'ValidationToken' => $ValidationToken,
                            'IsValidated' => 0,
                            'CreatedAt' => $Date]);

                $info.="successfully registered";
            } else {
                $info.="Entered Username is already Registered.";
            }
        }
        return view('Layouts.register', ['message' => $info]);
    }

    //------------------------------Login USing Validation Token ----------------------//

    public function ValidationToken($ValidationToken) {

        $Check = User::select('FirstName')->where('ValidationToken', $ValidationToken)->get();
        $Check = json_decode($Check);

        if (count($Check) > 0) {
            $user = User::where('ValidationToken', $ValidationToken)->first();
            Auth::login($user);

            User::where('ValidationToken', $ValidationToken)->update(['IsValidated' => 1]);
            return Redirect::route('Dashboard');
        } else {

            $validate = "Invalid Token";
            return Redirect::route('index')
                            ->withErrors($validate)
                            ->withInput();
        }
    }

    //------------------------------Login----------------------//
    public function Login() {
        if (Auth::check()) {
            return Redirect::route('Dashboard');
        } else {

            return view('Layouts/login');
        }
    }

    public function loggedIn() {
        $Email = Input::get('UserName');
        $Password = Input::get('Password');
        $validate = User::select('UserName', 'FirstName')->where('UserName', $Email)->where('Password', $Password)->get();
        if (count($validate) > 0) {
            $user = User::where('UserName', $Email)->where('Password', $Password)->first();
            Auth::login($user);
            //dd(Auth::user()->Id);

            $validate = json_decode($validate);
            return Redirect::route('Dashboard');
        } else {
            $validate = "Invalid Crendentials";
            return Redirect::route('login')
                            ->withErrors($validate)
                            ->withInput();
        }
    }

    public function Dashboard() {
        $name = Auth::user()->FirstName;
        return view('Login/Dashboard', ['name' => $name]);
    }

    //------------------------------Forgot Password----------------------//
    public function forgotpassword() {
        if (Auth::check()) {
            return Redirect::route('Dashboard');
        } else {

            return view('Layouts/Forgot');
        }
    }

    public function retrivepassword() {
        $Email = Input::get('UserName');
        $validate = User::select('Password')->where('UserName', $Email)->get();
        if (count($validate) > 0) {
            $validate = json_decode($validate);
            foreach ($validate as $key)
                $password = $key->Password;
            $body = "Dear User Registered Password of your respective email Id.
                    $password";
            Mail::raw($body, function ($password)use($Email) {
                $password->from('kaveri.nagunuri@karmanya.co.in', 'kaveri');
                $password->to($Email)->subject('Retrived Password');
            });
            $alert = "Password is send to your email Id";
        } else
            $alert = "Your Email Id is not registered.Please Registered to access";
        return Redirect::route('forgotpassword')
                        ->with('password_message', $alert);
    }

    //--------------------------Change Password----------------------//

    public function changepassword() {
        $UserName = Auth::user()->UserName;
        $name = Auth::user()->FirstName;

        return view('Login.changepassword', ['UserName' => $UserName, 'name' => $name]);
    }

    public function resetpassword() {
        $Email = Input::get('UserName');
        $Password = Input::get('Password');
        $reset = User::where('UserName', $Email)->update(['Password' => $Password]);
        return Redirect::route('changepassword')
                        ->with('changepassword', 'Password successfully changed');
    }

    //------------------------Logout---------------------------//

    public function logout() {
        Auth::logout();
         return redirect(\URL::previous());
//        return Redirect::route('login')
//                        ->with('logout', 'successfully logged out');
    }

}
