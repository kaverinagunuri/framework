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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\RegisterUser;
Use Illuminate\Support\Facades\Hash;
use DateTime;
use Mail;
use Illuminate\Http\Request;
use App\Gender;

class FrameworkController extends BaseController {

    use AuthorizesRequests,
        AuthorizesResources,
        DispatchesJobs,
        ValidatesRequests;

    //------------------------------Registration----------------------//

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
            $ExhistEmail = RegisterUser::select('UserName')->where('UserName', $Email)->count();
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
                $user = RegisterUser::create(['FirstName' => $FirstName,
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

    public function Login($ValidationToken) {
        $Check = RegisterUser::select('FirstName')->where('ValidationToken', $ValidationToken)->get();
        $Check = json_decode($Check);
        foreach ($Check as $key)
            $name = $key->FirstName;
        if (count($Check) > 0) {

            RegisterUser::where('ValidationToken', $ValidationToken)->update(['IsValidated' => 1]);
            return Redirect::route('Dashboard')
                            ->with('Login', $name);
        } else {

            $validate = "Invalid Token";
            return Redirect::route('index')
                            ->withErrors($validate)
                            ->withInput();
        }
    }

    //------------------------------Login----------------------//

    public function loggedIn() {
        $Email = Input::get('UserName');

        $Password = Input::get('Password');
        $validate = RegisterUser::select('UserName', 'FirstName')->where('UserName', $Email)->where('Password', $Password)->get();

        if (count($validate) > 0) {
            $validate = json_decode($validate);
            foreach ($validate as $key) {
                session(['UserName' => $key->UserName]);
                $name = $key->FirstName;
            }
            return Redirect::route('Dashboard')
                            ->with('Login', $name);
        } else {

            $validate = "Invalid Crendentials";
            return Redirect::route('Login')
                            ->withErrors($name)
                            ->withInput();
        }
    }

    //------------------------------Forgot Password----------------------//

    public function retrivepassword() {
        $Email = Input::get('UserName');
        $validate = RegisterUser::select('Password')->where('UserName', $Email)->get();

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

}
