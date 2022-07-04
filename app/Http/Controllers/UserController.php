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
        abort_unless( auth()->user()->email == "edibtahirovic@gmail.com" || auth()->user()->id == 1,403);

        $data['users'] =  User::select('id','name','email','role','email_verified_at')->where('id','!=',1)->orderBy('id','desc')->paginate(20);

        return view('user.index',$data);
    }




    public function update(Request $request, User $user)
    {
        abort_unless( auth()->user()->role == "admin",403);

        $request->validate([
            'role' => ['nullable','in:admin,user,editor'],
            'active' => ['nullable','in:0,1'],
        ]);

        dd($request->get('active'));

        $user->role = $request->get('role') ?? $user->role;
        $user->active = $request->get('active') ?? $user->active;
        $user->save();

        return Redirect::to('users')
        ->with('success','Great! User updated successfully');
    }



}
