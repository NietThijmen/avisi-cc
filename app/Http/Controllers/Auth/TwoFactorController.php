<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorController extends Controller
{
    /**
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws SecretKeyTooShortException
     * @throws InvalidCharactersException
     */
    public function store(Request $request)
    {
        $google2fa = new Google2FA();

        // retrieve secret from the session
        $secret = session('2fa_secret');
        $user = \Auth::user();

        if ($google2fa->verify($request->input('otp'), $secret)) {
            // store the secret in the user profile
            // this will enable 2FA for this user
            $user->twofa_secret = $secret;
            $user->save();

            // avoid double OTP check
            session(['2fa_checked' => true]);

            return redirect()->back();
        }

        throw ValidationException::withMessages([
            'otp' => 'Incorrect value. Please try again...']);
    }

    public function delete()
    {
        $user = \Auth::user();
        $user->twofa_secret = null;
        $user->save();

        return redirect()->back();
    }
}

