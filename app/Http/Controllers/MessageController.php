<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ReplyMail;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    public function getMessage(){
        $data=Message::where('re_email',Auth::user()->email)->where('status',0)->get();
        return response()->json($data, 200);
    }

    public function getReport(){
        $data=Message::where('type',1)->where('status',0)->get();
        return response()->json($data, 200);
    }

    public function list_admin($status='inbox'){
        if ($status=='inbox') {
            $message=Message::where('type',0)->where('re_email',Auth::user()->email)->get();
        }elseif($status=='send'){
            $message=Message::where('type',0)->where('se_email',Auth::user()->email)->where('reply_id','normal')->get();
        }else{
            $message=Message::where('type',1)->get();
        }
        return view('main.admin.message.list',compact('message','status'));
    }

    public function addPage_admin($reply_id='normal'){
        $data=[];
        if ($reply_id=='normal') {
            $admin=User::where('role','admin')->get()->toArray();
            $user=User::where('role','user')->get()->toArray();
            $data=array_merge($admin,$user);
        }else{

            $message=Message::where('id',$reply_id)->first();
            $data=[
                [
                    'id'=>0,
                    'email'=>$message->se_email,
                    'name'=>$message->se_email,
                ],
            ];
        }
        return view('main.admin.message.add',compact('data','reply_id'));
    }

    public function add_admin(Request $req){
        Validator::make($req->all(),[
            'se_email'=>'required',
            're_email'=>'required',
            'title'=>'required',
            'message'=>'required',
        ])->validate();
        $data=[
            'se_email'=>$req->se_email,
            're_email'=>$req->re_email,
            'title'=>$req->title,
            'message'=>$req->message,
            'type'=>0,
            'reply_id'=>$req->reply_id
        ];
        // dd($data);
        Message::create($data);

        if ($req->reply_id=='normal') {
            return redirect()->route('admin#messageList','send')->with(['success'=>'Message send successful.']);
        }else{
            return redirect()->route('admin#viewMessage',$req->reply_id)->with(['success'=>'Message send successful.']);

        }

    }

    public function view_admin($id){
        $message=Message::where('id',$id)->first();
        $reply_id=$message->reply_id;

        if ($message->reply_id==0) {
            if ($message->re_email==Auth::user()->email) {
                Message::where('id',$id)->update(['status'=>1]);
            }elseif ($message->type==1) {
                Message::where('id',$id)->update(['status'=>1]);
            }
            $replyMessage=Message::where('reply_id',$id)->get();
        } else {
            $message=Message::where('id',$reply_id)->first();
            Message::where('id',$id)->update(['status'=>1]);
            $replyMessage=Message::where('reply_id',$message->id)->get();
        }

        return view('main.admin.message.view',compact('message','replyMessage'));
    }

    public function sendAllPage(){
        return view('main.admin.message.allRoleSend');
    }

    public function sendAll(Request $req){
        Validator::make($req->all(),[
            'se_email'=>'required',
            'title'=>'required',
            'message'=>'required',
        ])->validate();
        $data=[
            'se_email'=>$req->se_email,
            'title'=>$req->title,
            'message'=>$req->message,
            'reply_id'=>'normal',
            'type'=>0,
        ];
        if ($req->role!='supplier') {
            $user=User::where('role',$req->role)->get();
        } else {
            $user=User::where('position',$req->role)->get();
        }
        foreach ($user as $item) {
            $data['re_email']=$item->email;
            Message::create($data);
        }
        return redirect()->route('admin#messageList','send')->with(['success'=>'Message send successful.']);

    }

    public function sendUser_admin($id){
        $data=User::where('id',$id)->get();
        $reply_id='normal';
        return view('main.admin.message.add',compact('data','reply_id'));
    }

    public function replyReportPage($id){
        $message=Message::where('id',$id)->first();
        return view('main.admin.message.replyReport',compact('message'));
    }

    public function replyReport(Request $req){
        Validator::make($req->all(),[
            'email'=>'required',
            'title'=>'required',
            'message'=>'required',
        ])->validate();
        $data=[
            'se_email'=>Auth::user()->email,
            're_email'=>$req->email,
            'title'=>$req->title,
            'message'=>$req->message,
            'type'=>0,
            'reply_id'=>$req->reply_id
        ];
        Message::create($data);
        $mailData=[
            'title'=>$req->title,
            'body'=>$req->message,
        ];
        Mail::to($req->email)->send(new ReplyMail($mailData));
        return redirect()->route('admin#viewMessage',$req->reply_id)->with(['success'=>'Reply mail sent successful']);

    }

    // user

    public function list_user($status='inbox'){
        if ($status=='inbox') {
            $message=Message::where('type',0)->where('re_email',Auth::user()->email)->get();
        }elseif($status=='send'){
            $message=Message::where('type',0)->where('se_email',Auth::user()->email)->where('reply_id','normal')->get();
        }else{
            $message=Message::where('type',1)->get();
        }
        return view('main.user.message.list',compact('message','status'));
    }

    public function addPage_user($reply_id='normal'){
        $data=[];
        if ($reply_id=='normal') {
            $admin=User::where('role','admin')->get()->toArray();
            $user=User::where('role','user')->get()->toArray();
            $data=array_merge($admin,$user);
        }else{
            $message=Message::where('id',$reply_id)->first();
            $data=[
                [
                    'id'=>0,
                    'email'=>$message->se_email,
                    'name'=>$message->se_email,
                ],
            ];
        }
        return view('main.user.message.add',compact('data','reply_id'));
    }

    public function add_user(Request $req){
        Validator::make($req->all(),[
            'se_email'=>'required',
            're_email'=>'required',
            'title'=>'required',
            'message'=>'required',
        ])->validate();
        $data=[
            'se_email'=>$req->se_email,
            're_email'=>$req->re_email,
            'title'=>$req->title,
            'message'=>$req->message,
            'type'=>0,
            'reply_id'=>$req->reply_id
        ];
        Message::create($data);
        if ($req->reply_id=='normal') {
            return redirect()->route('user#messageList','send')->with(['success'=>'Message send successful.']);
        }else{
            return redirect()->route('user#viewMessage',$req->reply_id)->with(['success'=>'Message send successful.']);
        }
    }

    public function view_user($id){
        $message=Message::where('id',$id)->first();
        $reply_id=$message->reply_id;

        if ($message->reply_id==0) {
            if ($message->re_email==Auth::user()->email) {
                Message::where('id',$id)->update(['status'=>1]);
            }
            $replyMessage=Message::where('reply_id',$id)->get();
        } else {
            $message=Message::where('id',$reply_id)->first();
            Message::where('id',$id)->update(['status'=>1]);
            $replyMessage=Message::where('reply_id',$message->id)->get();
        }
        return view('main.user.message.view',compact('message','replyMessage'));
    }

    public function sendUser_user($id){
        $data=User::where('id',$id)->get();
        $reply_id='normal';
        return view('main.user.message.add',compact('data','reply_id'));
    }

    public function sendContact_customer(Request $req){
        $data=[
            'se_email'=>$req->email,
            'title'=>$req->subject,
            'message'=>$req->message,
            'type'=>1,
            'reply_id'=>'normal'
        ];
        Message::create($data);
        return back()->with(['success'=>'Customer report successful. We will contact you soon.']);
    }


}
