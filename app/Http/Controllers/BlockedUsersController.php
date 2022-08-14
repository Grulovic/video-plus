<?php

namespace App\Http\Controllers;

use App\Models\BlockedUser;
use App\Models\SupportMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BlockedUsersController extends Controller
{
    public function getBlockedUsers(){

        $data['blocked_users'] = BlockedUser::with(['user'])->get();

        return view('block.index',$data);
    }

    public function blockUser(Request $request){

        $validator = Validator::make($request->all(), [
            'support_message_id' => ['nullable'],
            'user_id' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->with('error',$validator->messages()->first());
        }

        $support_message_id = $request->get('support_message_id');
        $user_id = $request->get('user_id');

        //BLOCK CASE ITS FROM SUPPORT MESSAGE
        if($support_message_id){
            $support_message = SupportMessage::where('id',$support_message_id)->first();
            if($support_message){
                $ip_address = $support_message->ip_address;
                $email = $support_message->email;

                if($email){
                    $user = User::where('id',$email)->first();
                    if($user){
                        $user_id = $user->id;
                    }
                }
            }

            $block_user = new BlockedUser();
            $block_user->ip_address = $ip_address;
            $block_user->email = $email;
            $block_user->user_id = $user_id;
            $block_user->save();

            $support_message->delete();
        }

        //BLOCK CASE ITS FROM USERS LIST
        if($user_id){
            $user = User::where('id',$user_id)->first();
            if($user){
                if($user_ip_addresses = $user->ip_addresses){
                    $user_ip_addresses = json_decode($user_ip_addresses,true);
                    foreach ($user_ip_addresses as $user_ip_address){
                        $block_user = new BlockedUser();
                        $block_user->ip_address = $user_ip_address;
                        $block_user->email = $user->email;
                        $block_user->user_id = $user_id;
                        $block_user->save();
                    }
                }

            }
        }


        return Redirect::back()->with('success','User blocked successfully');
    }


    public function unblockUser(BlockedUser $block){

        $ip_address = $block->ip_address;
        $email = $block->email;
        $user_id = $block->user_id;

        BlockedUser::where('ip_address',$ip_address)
            ->orWhere('email',$email)
            ->orWhere('user_id',$user_id)
            ->delete();

        return Redirect::back()->with('success','User unblocked successfully');
    }


}
