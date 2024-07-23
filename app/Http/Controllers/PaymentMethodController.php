<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    public function paymentList_user(){
        $payment=PaymentMethod::where('user_id',Auth::user()->id)->get();
        return view('main.user.payment.list',compact('payment'));
    }

    public function paymentAddPage_user(){
        return view('main.user.payment.add');
    }

    public function paymentAdd_user(Request $req){
        $this->validation($req);
        $data=$this->changeFormat($req);
        PaymentMethod::create($data);
        return redirect()->route('user#paymentList')->with(['success'=>'Payment create successful.']);
    }

    public function paymentEdit_user($id){
        $payment=PaymentMethod::where('id',$id)->first();
        return view('main.user.payment.edit',compact('payment'));
    }

    public function paymentUpdate_user(Request $req){
        $this->validation($req);
        $data=$this->changeFormat($req);
        PaymentMethod::where('id',$req->id)->update($data);
        return redirect()->route('user#paymentList')->with(['success'=>'Payment update successful.']);
    }

    public function paymentDelete_user($id){
        PaymentMethod::where('id',$id)->delete();
        return redirect()->route('user#paymentList')->with(['danger'=>'Payment delete successful.']);

    }

    public function getPayment($id){
        $data=PaymentMethod::where('id',$id)->first();
        return response()->json($data, 200);
    }

    public function getUserPayment($id){
        $data=PaymentMethod::where('user_id',$id)->get();
        return response()->json($data, 200);
    }

    private function validation($req){
        Validator::make($req->all(),[
            'name'=>'required',
            'number'=>'required',
            'user_name'=>'required'
        ])->validate();
    }

    private function changeFormat($req){
        return [
            'name'=>$req->name,
            'number'=>$req->number,
            'user_name'=>$req->user_name,
            'user_id'=>Auth::user()->id,
        ];
    }
}
