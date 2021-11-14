<?php

namespace App\Http\Controllers;

use App\Models\Live;
use App\Models\Settings;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Spatie\Valuestore\Valuestore;

class SettingsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('settings.index');
    }

    public function update(Request $request)
    {
        $settings = settings();

//        $request->validate([
//            'hide_videos' => 'required',
//            'hide_articles' => 'required',
//            'hide_photos' => 'required',
//            'hide_live' => 'required',
//            'logo' => 'required',
//            'logo_footer' => 'required',
//        ]);

        $request = $request->all();
        dd($request);

        $settings->put('hide_videos', $request['hide_videos']);
        $settings->put('hide_articles', $request['hide_articles']);
        $settings->put('hide_photos', $request['hide_photos']);
        $settings->put('hide_live', $request['hide_live']);
        $settings->put('logo', $request['logo']);
        $settings->put('logo_footer', $request['logo_footer']);



        return Redirect::to('settings')
            ->with('success','Great! Settings updated successfully');
    }
}
