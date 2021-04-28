<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Repositories\AnswerRepository;
use App\Repositories\UnitRepository;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    private $unitRepository;
    private $answerRepository;
    public function __construct(AnswerRepository $answerRepository,UnitRepository $unitRepository)
    {
        $this->answerRepository = $answerRepository;
        $this->unitRepository = $unitRepository;
    }

    public function question($id){
        $unit = $this->unitRepository->find($id);
        return view('customer.pages.question', compact('unit', 'id'));
    }

    public function answer($id,Request $request){
        foreach ($request->question as $key => $value){
            foreach ($value as $val){
                $this->answerRepository->create([
                    'question_id'=> $val,
                    'answer'=>json_encode($request[$key][$val]),
                    'unit_id'=>$id,
                    'user_id'=>Auth::guard('customer')->user()->id
                ]);
            }
        }
        return redirect()->route('customer.unit-answer',['id'=>$id]);
    }

    public function unitAnswer($id){
        $answer = $this->answerRepository->findByField('unit_id',$id);
        $unit = $this->unitRepository->find($id);
        return view('customer.pages.unit-answer', compact('answer','unit'));
    }

    public function home(){
        $unit = $this->unitRepository->all();
        return view('customer.pages.home', compact('unit'));
    }

    public function login(){
        return view('customer.pages.login');
    }

    public function postLogin(Request $request){
        try {
            $email = $request->email;
            $password = $request->password;
            if (Auth::guard('customer')->attempt(['email' => $email, 'password' => $password, 'is_staff' => 0])) {
                return redirect()->route('customer.home');
            }
            return  back();
        }catch (ServerException $e){
            abort(500);
        }
    }
}
