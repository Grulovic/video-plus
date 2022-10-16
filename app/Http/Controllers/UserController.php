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

        $data['users'] =  User::where('id','!=',1)->orderBy('id','desc')->paginate(20);

        return view('user.index',$data);
    }




    public function update(Request $request, User $user)
    {
        abort_unless( auth()->user()->role == "admin",403);

        $request->validate([
            'role' => ['nullable','in:admin,user,editor'],
            'active' => ['nullable','in:0,1'],
            'mail_notifications' => ['nullable','in:0,1'],
            'receive_only_breaking' => ['nullable','in:0,1'],
        ]);

        $user->role = $request->get('role') ?? $user->role;
        $user->mail_notifications = $request->get('mail_notifications') ?? $user->mail_notifications;
        $user->receive_only_breaking = $request->get('receive_only_breaking') ?? $user->receive_only_breaking;
        if($request->get('role') == 'admin' || $request->get('role') == 'editor'){
            $user->active = 1;
        }else{
            $user->active = $request->get('active') ?? $user->active;
        }
        $user->save();

        return Redirect::to('users')
        ->with('success','Great! User updated successfully');
    }



}
