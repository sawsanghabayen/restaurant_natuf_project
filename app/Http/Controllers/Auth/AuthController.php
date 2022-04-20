<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    protected $guard = 'user';
    
    public function __construct(Request $request){
        if($request->is('cms/admin/*')){
            $this->guard='admin';
        }

    }


    public function showLoginView(Request $request)
    {
        // dd($this->guard);
        return response()->view('cms.auth.login',[
            'guard'=>$this->guard =='admin' ? 'admin.' : '',
        ]);
    }



    public function login(Request $request )
    {

        $validator = Validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:3',
            'remember' => 'required|boolean',
        ]);

        if (!$validator->fails()) {
            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            if (Auth::guard($this->guard)->attempt($credentials, $request->input('remember'))) {
                return response()->json(['message' => 'Logged in successfully']);
            } else {
                return response()->json(['message' => 'Login failed, check credentials'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }



    public function logout(Request $request)
    {
        // dd($this->guard);

        Auth::guard($this->guard)->logout();
        $request->session()->invalidate();
        return redirect()->route($this->guard =='admin' ? 'cms.admin.login' : 'cms.login');

        
    }


}
