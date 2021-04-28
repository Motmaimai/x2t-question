<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function dashboard(){
        return view('admin.pages.dashboard');
    }
    public function loadView(Request $request){
        $view = $request->view;
        return view('admin.data.'.$view);
    }
    public function textToSpeech(){
        return view('admin.pages.text_to_speech.index');
    }

    public function login(){
        return view('admin.pages.login');
    }

    public function postLogin(Request $request){
        try {
            $email = $request->email;
            $password = $request->password;
            if (Auth::attempt(['email' => $email, 'password' => $password, 'is_staff' => 1])) {
                return redirect()->route('admin.dashboard');
            }
            return  back();
        }catch (ServerException $e){
            abort(500);
        }
    }
}
