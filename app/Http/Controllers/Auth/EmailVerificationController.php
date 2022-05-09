<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmailVerificationController extends Controller
{
    //
    public function notice()
    {
        
        return response()->view('cms.auth.verify-email');
    }

    public function send(Request $request)
    {
        if (!$request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
            return response()->json(['message' => 'Verification email sent successfully'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Your account has been verified!'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function verify(EmailVerificationRequest $emailVerificationRequest)
    {
        // dd(Auth::guard('admin')->check());
        $emailVerificationRequest->fulfill();
        if(Auth::guard('admin')->check()) 
        return redirect()->route('dashboards.index');
        else
         return redirect()->route('resturants.index');
    }
}
