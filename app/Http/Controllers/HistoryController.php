<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
            public function __construct(){
            $this->middleware('auth');
        }
        
    public function index()
    {
    
        if( auth()->user()->role == "admin" ){
            $data['histories'] = History::orderBy('id','desc')->paginate(20);
        }else{
            $data['histories'] = History::orderBy('id','desc')->where('user_id','=',auth()->user()->id)->paginate(10);
        }

        return view('history.list',$data);
    }
}
