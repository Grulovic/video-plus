<?php

namespace App\Http\Controllers;

use App\Models\Live;
use App\Models\Settings;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Valuestore\Valuestore;

class SettingsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('settings.index');
    }

    public function update(Request $request, Settings $settings)
    {

        $request->validate([
            'hide_videos' => 'required|integer',
            'hide_articles' => 'required|integer',
            'hide_photos' => 'required|integer',
            'hide_lives' => 'required|integer',
            'hide_planner' => 'required|integer',
            'logo' => 'required',
            'logo_footer' => 'required',
        ]);

        $request = $request->all();

        $settings->put('hide_videos', $request['hide_videos']);
        $settings->put('hide_articles', $request['hide_articles']);
        $settings->put('hide_photos', $request['hide_photos']);
        $settings->put('hide_lives', $request['hide_lives']);
        $settings->put('hide_planner', $request['hide_planner']);
        $settings->put('logo', $request['logo']);
        $settings->put('logo_footer', $request['logo_footer']);



        return Redirect::to('settings')
            ->with('success','Great! Settings updated successfully');
    }
}
