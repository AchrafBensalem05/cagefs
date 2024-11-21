<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function auth_google()
    {
        return Socialite::driver('google')->redirect();
    }


    public function auth_google_callback()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $patient = Patient::where('auth0_google', $google_user->id)->orWhere('email' , $google_user->getEmail())->first();
            if($patient)
            {
                Auth::guard('patient')->login($patient);
                flash("Patient is connected with " . $patient->email , ['alert alert-success alert-dismissible']);
                return redirect()->route('patient.dashboard');
            }
            else{
                $patient = Patient::create([
                    "name"          => $google_user->getName(),
                    "fname"         => $google_user->user['given_name'],
                    'lname'         => $google_user->user['family_name'],
                    "email"         => $google_user->getEmail(),
                    "password"      => bcrypt($google_user->getId()),
                    "auth0_google"  => $google_user->getId(),
                    'birth_date'    => now()->format("Y-m-d"),
                    'blood'         => 'o+',
                    'blocked'       => 'no'
                ]);
                $patient->addMediaFromUrl($google_user->avatar)->toMediaCollection('avatar');
                flash("Account Created successfully" , ['alert alert-success alert-dismissible']);
                Auth::login($patient);
                flash("your connected with this email " . $patient->email , ['alert alert-success alert-dismissible']);
                return redirect()->route('patient.dashboard');
            }

        } catch (Exception $e) {
            flash("Authentication problem" , ['alert alert-warning alert-dismissible']);
        }
    }


    public function attempt_login_patient(Request $request)
    {
        if(Auth::guard("patient")->attempt($request->only(['email' , 'password'])))
        {
            $request->session()->regenerate();
           return redirect()->route('patient.dashboard');
        }else
        {
            flash("Vérifiez vos Champs" , ['alert alert-warning alert-dismissible']);
            return  redirect()->back();
        }
    }

    public function attempt_login_healthcare(Request $request)
    {
        if(Auth::guard("healthcare")->attempt($request->only(['email' , 'password'])))
        {
            $request->session()->regenerate();
            return redirect()->route('healthcare.dashboard');
        }else
        {
            flash("Vérifiez vos Champs" , ['alert alert-warning alert-dismissible']);
            return  redirect()->back();
        }
    }


    public function logout_healthcare()
    {
        Auth::guard('healthcare')->logout();
        return redirect()->route('front.home');
    }

    public function logout_patient()
    {
        Auth::guard('patient')->logout();
        return redirect()->route('front.home');
    }

}


