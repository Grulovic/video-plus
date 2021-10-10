<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Redirect;

class UserController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        abort_unless( auth()->user()->role == "admin",403);
        abort_unless( auth()->user()->id == 14 || auth()->user()->id == 1,403);

        $data['users'] =  User::select('id','name','email','role','email_verified_at')->where('id','!=',1)->orderBy('id','desc')->paginate(20);

        return view('user.index',$data);
    }




    public function update(Request $request, $id)
    {



        abort_unless( auth()->user()->role == "admin",403);

        $request->validate([
            'role' => 'required'
        ]);

        $request = $request->all();

        // dd($request);

        $roles = array("admin","user");
        if (!in_array($request['role'], $roles )) {
           abort(403);
        }


        unset($request['_token']);
        unset($request['_method']);

        $user = User::where('id',$id);

        $user->update($request);

        return Redirect::to('users')
        ->with('success','Great! User role updated successfully');
    }



}
