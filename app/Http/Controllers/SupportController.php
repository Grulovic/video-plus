<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use App\Models\SupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactUsReply;

class SupportController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        abort_unless( auth()->user()->role == "admin",403);

        $data['messages'] = SupportMessage::orderBy('id','desc')->get();

        return view('support.index',$data);
    }

    public function create(SupportMessage $supportMessage)
    {
        Log::debug($supportMessage);
        abort_unless( auth()->user()->role == "admin",403);

        $data['support'] = $supportMessage;

        return view('support.create',$data);
    }


    public function reply(Request $request)
    {
        abort_unless( auth()->user()->role == "admin",403);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'message_id' => 'required|integer',
            'message' => 'required|max:5000'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->with('error',$validator->messages()->first());
        }



        $request = $request->all();

        $supportMessage = SupportMessage::where('id',$request['message_id'])->first();
        $supportMessage->replied = true;
        $supportMessage->save();

        $to = [
            [
                'email' => $request['email'],
                'name' => $request['email'],
            ]
        ];


        Mail::to( $to )->send(new ContactUsReply( $request['email'],$request['message'] ));

        return Redirect::to('support.index')->with('success','Message sent successfully!');
    }
}
