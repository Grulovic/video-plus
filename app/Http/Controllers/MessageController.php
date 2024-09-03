<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Redirect;

class MessageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        $data['messages'] = Message::orderBy('id','desc')->paginate(5);
        
        return view('dashboard',$data);
    }


    public function store(Request $request)
    {
        abort_unless( auth()->user()->role == "admin",403);
        

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        
        $request = $request->all();
        unset($request['_token']);
        unset($request['_method']);
        $request['user_id'] = auth()->user()->id;
        

        Message::create($request);
    
        return Redirect::to('dashboard')
       ->with('success','Greate! Message created successfully.');
    }
   

    public function update(Request $request, $id)
    {
        abort_unless( auth()->user()->role == "admin",403);
        
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        
        $request = $request->all();
        unset($request['_token']);
        unset($request['_method']);
        // $update = ['title' => $request->title, 'description' => $request->description];
        $message = Message::where('id',$id);


        $message->update($request);
    
        return Redirect::to('dashboard')
       ->with('success','Great! Message updated successfully');
    }
   

    public function destroy($id)
    {
        abort_unless( auth()->user()->role == "admin",403);
        
        $message = Message::where('id',$id);

        $message->delete();
   
        return Redirect::to('dashboard')->with('success','Message deleted successfully');
    }
    
    
}