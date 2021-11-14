<?php

namespace App\Http\Controllers;

use App\Models\Live;
use App\Models\Photo;
use App\Models\Settings;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
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
//            'logo' => 'required',
//            'logo_footer' => 'required',
            'logo' => 'nullable|file|max:500000|mimes:jpeg,png,jpg,gif,svg',
            'logo_footer' => 'nullable|file|max:500000|mimes:jpeg,png,jpg,gif,svg',

            'dashboard_description' => 'present|nullable',
        ]);

        $request = $request->all();



        if(request()->file('logo')){

                $image = request()->file('logo');

                //store the images
                $file_name = date('Y-m-d-H-i-s')."-".str_replace(" ","-",$image->getClientOriginalName());

                dd($file_name);

                Storage::disk('settings')->put( $file_name,  File::get($image));

                $imagePath = Storage::disk('settings')->path($file_name);


                $settings->put('logo', $file_name);
        }

        if(request()->file('logo_footer')){

            $image = request()->file('logo_footer');

            //store the images
            $file_name = date('Y-m-d-H-i-s')."-".str_replace(" ","-",$image->getClientOriginalName());

            Storage::disk('settings')->put( $file_name,  File::get($image));

            $imagePath = Storage::disk('settings')->path($file_name);


            $settings->put('logo_footer', $file_name);
        }

        $settings->put('hide_videos', $request['hide_videos']);
        $settings->put('hide_articles', $request['hide_articles']);
        $settings->put('hide_photos', $request['hide_photos']);
        $settings->put('hide_lives', $request['hide_lives']);
        $settings->put('hide_planner', $request['hide_planner']);
//        $settings->put('logo', $request['logo']);
//        $settings->put('logo_footer', $request['logo_footer']);
        $settings->put('dashboard_description', $request['dashboard_description']);



        return Redirect::to('settings')
            ->with('success','Great! Settings updated successfully');
    }
}
