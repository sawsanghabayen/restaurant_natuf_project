<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    //
    public function showForgotPassword(Request $request)
    {
        return view('cms.auth.forgot-password');
    }

    public function sendResetEmail(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email',
        ]);

        if (!$validator->fails()) {
            // ['email'=>'emailvalue']
            $status = Password::sendResetLink($request->only('email'));
            return $status === Password::RESET_LINK_SENT
                ? response()->json(['message' => __($status)], Response::HTTP_OK)
                : response()->json(['message' => __($status)], Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function showResetPasswordView(Request $request, $token)
    {
        return view('cms.auth.reset-password', ['token' => $token, 'email' => $request->input('email')]);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ]);

        if (!$validator->fails()) {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
                    $user->save();
                    event(new PasswordReset($user));
                }
            );

            return $status === Password::PASSWORD_RESET
                ? response()->json(['message' => __($status)], Response::HTTP_OK)
                : response()->json(['message' => __($status)], Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
