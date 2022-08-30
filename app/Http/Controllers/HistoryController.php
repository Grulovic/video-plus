<?php

namespace App\Http\Controllers;

use App\Models\GalleryView;
use App\Models\History;
use App\Models\User;
use App\Models\VideoView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
            public function __construct(){
            $this->middleware('auth');
        }

    public function index()
    {
        abort_unless( auth()->user()->role == "admin",403);
        abort_unless( auth()->user()->email == "edibtahirovic@gmail.com" || auth()->user()->id == 1,403);

        if( auth()->user()->role == "admin" ){
            $data['histories'] = History::orderBy('id','desc')->paginate(20);
        }else{
            $data['histories'] = History::orderBy('id','desc')->where('user_id','=',auth()->user()->id)->paginate(10);
        }

        $data['video_downloads'] = History::whereNotNull('video_id')->where('action','Video Downloaded')->count();
        $data['photo_downloads'] = History::whereNotNull('gallery_id')->where('action','Gallery Downloaded')->count();

        $data['video_uploads'] = History::whereNotNull('video_id')->where('action','Video Uploaded')->count();
        $data['photo_uploads'] = History::whereNotNull('gallery_id')->where('action','Gallery Uploaded')->count();

        $data['video_views'] = VideoView::count();
        $data['photo_views'] = GalleryView::count();

        //VIDEO STATS
        if( isset($data['video_downloads']) && isset($data['video_uploads'])){
            $data['video_average'] = round($data['video_downloads'] / $data['video_uploads']);
            $data['video_views_average'] = round($data['video_views'] / $data['video_uploads']);

        }else{
            $data['video_average'] = 0;
            $data['video_views_average'] = 0;
        }

        //PHOTO STATS
        if(  isset($data['photo_downloads']) && isset($data['photo_uploads']) && isset($data['photo_average']) ){
            $data['photo_average'] = round($data['photo_downloads'] / $data['photo_uploads']);
            $data['photo_views_average'] = round($data['photo_views'] / $data['photo_average']);

        }else{
            $data['photo_average'] = 0;
            $data['photo_views_average'] = 0;
        }

        //DOWLOAD PER USER
        $data['user_downloads_count'] = DB::select('
        SELECT * FROM (SELECT users.email as email, users.name as name,histories.user_id as user_id, count(histories.id) as num_of_downloads
        FROM histories
        LEFT JOIN users ON histories.user_id = users.id
        GROUP BY user_id) c
        WHERE c.num_of_downloads > 0
        ORDER BY c.num_of_downloads DESC
        ');


        $data['user_count'] = User::count();


        return view('history.list',$data);
    }
}
