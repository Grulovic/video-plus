<?php

namespace App\Http\Controllers;

use App\Models\GalleryView;
use App\Models\History;
use App\Models\VideoView;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
            public function __construct(){
            $this->middleware('auth');
        }

    public function index()
    {
        abort_unless( auth()->user()->role == "admin",403);
        abort_unless( auth()->user()->id == 14 || auth()->user()->id == 1,403);

        if( auth()->user()->role == "admin" ){
            $data['histories'] = History::orderBy('id','desc')->paginate(20);
        }else{
            $data['histories'] = History::orderBy('id','desc')->where('user_id','=',auth()->user()->id)->paginate(10);
        }

        $data['video_downloads'] = History::whereNotNull('video_id')->where('action','Video Downloaded')->count();
        $data['photo_downloads'] = History::whereNotNull('gallery_id')->where('action','Gallery Downloaded')->count();

        $data['video_uploads'] = History::whereNotNull('video_id')->where('action','Video Uploaded')->count();
        $data['photo_uploads'] = History::whereNotNull('gallery_id')->where('action','Gallery Uploaded')->count();

        $data['video_average'] = round($data['video_downloads'] / $data['video_uploads']);
        $data['photo_average'] = round($data['photo_downloads'] / $data['photo_uploads']);

        $data['video_views'] = VideoView::count();
        $data['photo_views'] = GalleryView::count();

        $data['video_views_average'] = round($data['video_views'] / $data['video_uploads']);
        $data['photo_views_average'] = round($data['photo_views'] / $data['photo_average']);


        return view('history.list',$data);
    }
}
