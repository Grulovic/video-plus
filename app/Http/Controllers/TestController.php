<?php

namespace App\Http\Controllers;

use App\Jobs\SendQueueEmail;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function sendTestEmail(){
        $data['data'] = Video::all()->first();
        $data['mail'] = 'App\Mail\VideoUploaded';
        $data['users'] = [Auth::user()];
        $job = (new SendQueueEmail($data))->delay(now()->addSeconds(2));
        dispatch($job);
    }
}
