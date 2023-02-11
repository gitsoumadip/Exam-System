<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    function registeration()
    {
        return view('pages.auth.registration');
    }

    function user_register_data(Request $req)
    {
        // return $req;

        try {
            $validator = Validator::make($req->all(), [
                'username' => 'required',
                'useremail' => 'required|email',
                'userpassword' => 'required|min:6'
            ]);
            if ($validator->fails()) {
                return back()->with('error', $validator->errors());
            }

            $rand_otp_genareted = rand(111111, 999999);
            $user = User::create([
                'name' => $req->username,
                'email' => $req->useremail,
                'password' => Hash::make($req->userpassword),
                'email_verified_code' => $rand_otp_genareted,
                'is_verified' => 0,
                'status' => 0,
                'token' => $req->_token,
            ]);
            $name = $req->username;
            $email = $req->useremail;
            $data = ['name' => $name, 'rand_id' => $rand_otp_genareted, 'email' => $email];
            $user['to'] = $email;
            Mail::send('pages.auth.mailtemp', $data, function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->subject('Email Id VerifyCsrfToken');
            });
            return view('pages.auth.otpverify', compact('email'));
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }

    // **********************************************************************************************
    function email_link_verification(Request $req, $email, $id)
    {
        // return $req;
        $validator = Validator::make($email, $id, [
            'id' => 'required',
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }
        $otp = $id;
        $email = $email;
        $user = User::where(['email_verified_code' => $otp])
            ->where(['email' => $email])
            ->get();
        if (isset($user[0])) {
            $verify_user = User::where(['id' => $user[0]->id])
                ->update(['is_verified' => 1, 'email_verified_code' => '', 'status' => 1]);
            // return "Thank you ";
            // $data;
            // echo $email;
            $req->session()->put('username', $user);

            $user['to'] = $email;
            Mail::raw('Your Account Is verified', function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->subject('Email Id Verified');
            });
            return redirect('/dashboard');
        } else {
            return view('pages.auth.otpverify', compact('email'));
        }
    }

    function email_otp_verify(Request $req)
    {
        // return $email;
        $validator = Validator::make($req->all(), [
            'otpVerify' => 'required',
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }
        $otp = $req->input('otpVerify');
        $email = $req->input('email');
        $user = User::where(['email_verified_code' => $otp])
            ->where(['email' => $email])
            ->get();
        if (isset($user[0])) {
            $verify_user = User::where(['id' => $user[0]->id])
                ->update(['is_verified' => 1, 'email_verified_code' => '', 'status' => 1]);
            // return "Thank you ";
            // $data;
            // echo $email;
            $req->session()->put('username', $user);

            $user['to'] = $email;
            Mail::raw('Your Account Is verified', function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->subject('Email Id Verified');
            });

            return redirect('/dashboard');
        } else {
            return view('pages.auth.otpverify', compact('email'));
        }
    }

    // function verifysuccess()
    // {
    //     // return $req;
    //     // return View::make('user.au

    // }
    function user_otp_verify()
    {
        return view('pages.auth.otpverify');
    }
    function resend_otp(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }
        $email = $req->email;
        // $name = $req->name;
        $rand_otp_genareted = rand(111111, 999999);
        $user = User::where(['email' => $email])->get();
        // dd($user);
        $name = $user[0]->name;
        if (isset($user[0])) {
            $verify_user = User::where(['id' => $user[0]->id])
                ->update(['is_verified' => 0, 'email_verified_code' => $rand_otp_genareted, 'status' => 0]);

            $data = ['name' => $name, 'rand_id' => $rand_otp_genareted, 'email' => $email];
            $user['to'] = $email;
            Mail::send('pages.auth.mailtemp', $data, function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->subject('Email Id VerifyCsrfToken');
            });
            //     // return view('user.auth.otpverify', compact('email'));
            //     // echo "Email verified";
            return true;
        } else {
            return false;
        }
    }
    // **********************************************************************************************

    function login()
    {
        return view('pages.auth.login');
    }
    function user_login_data(Request $req)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            '_token' => 'required',

        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }
        $logToken = $req->_token;
        $user_log = User::where('email', $req->username)->first();
        $email = $req->username;
        if ($user_log) {
            if (($user_log->is_verified == 1) && ($user_log->status == 1)) {
                if (Auth::attempt(['email' => $req->username, 'password' => $req->userpassword])) {
                    $req->session()->put('username', $user_log->id);
                    if ($user_log->is_admin == 1) {

                        return redirect('/admin');
                    } elseif ($user_log->is_admin == 0) {
                        return redirect('/student');
                    }
                    return redirect()->route('login');
                } else {
                    return redirect()->route('login');
                }
            } else {
                return view('pages.auth.otpverify', compact('email'));
            }
        } else {
            // $req->session()->put('username', $); 
            return back()->with('error', "user name worng");
        }
    }

    function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('login');
    }
    // ***********************************************************************

    // **********************************************************************************************
    function forgetPassword(Request $req)
    {
        // return view('user.auth.forgot_Insert_Mail');
        // return $req;
        $validator = Validator::make($req->all(), [
            'forgot_verify_email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }
        $email = $req->forgot_verify_email;
        $rand_otp_genareted = rand(111111, 999999);
        $userMail = User::where(['email' => $req->forgot_verify_email])->first();
        // return $userMail->name;
        if ($userMail) {
            // return "yes";
            $verify_user = User::where(['id' => $userMail->id])
                ->update(['is_verified' => 0, 'email_verified_code' => $rand_otp_genareted, 'status' => 0]);

            $data = ['name' => $userMail->name, 'rand_id' => $rand_otp_genareted, 'email' =>  $email];
            // return $data;
            $user['to'] = $email;
            Mail::send('pages.auth.mailtemp', $data, function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->subject('Email Id VerifyCsrfToken');
            });
            return view('pages.auth.otp_reset_password', compact('email'));
        } else {
            return "no";
        }
    }

    function otp_verify_password(Request $req)
    {
        // return view('user.auth.otp_verify_password');
        // return $req;
        $validator = Validator::make($req->all(), [
            'otpVerify' => 'required',
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }
        $otp = $req->input('otpVerify');
        $email = $req->input('email');
        $user = User::where(['email_verified_code' => $otp])
            ->where(['email' => $email])
            ->get();
        if (isset($user[0])) {
            $verify_user = User::where(['id' => $user[0]->id])
                ->update(['is_verified' => 1, 'email_verified_code' => '', 'status' => 1]);

            $req->session()->put('username', $user);

            $user['to'] = $email;
            Mail::raw('Your Account Is verified', function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->subject('Email Id Verified');
            });

            return view('pages.auth.reset_new_password', compact('email'));
        } else {
            return view('pages.auth.otpverify', compact('email'));
        }
    }

    // manual-testing for reset_new_password
    // function newpassword()
    // {
    //     $email = "soumadiphazra00@gmail.com";
    //     return view('user.auth.reset_new_password', compact('email'));
    // }


    function resetPassword(request $req)
    {
        // return $req;
        $validator = Validator::make($req->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }
        $email = $req->email;
        $userMail = User::where(['email' => $email])->first();
        $newpassword = $req->newpassword;
        $confarmPassword = $req->confarmPassword;
        if ($newpassword != $confarmPassword) {
            return view('pages.auth.reset_new_password', compact('email'));
        } else {
            // Hash::make
            $verify_user = User::where(['id' => $userMail->id])
                ->update(['password' => Hash::make($req->newpassword)]);
            return redirect('login');
        }
    }
}
