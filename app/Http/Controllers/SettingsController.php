<?php

namespace App\Http\Controllers;

use App\Models\Live;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('settings.index');
    }

    public function update(Request $request, Live $live)
    {

        $request->validate([
            'hide_videos' => 'required',
            'hide_articles' => 'required',
            'hide_photos' => 'required',
            'hide_live' => 'required',
            'logo' => 'required',
            'logo_footer' => 'required',
        ]);




        return Redirect::to('settings')
            ->with('success','Great! Settings updated successfully');
    }
}
