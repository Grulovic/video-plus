<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Photo;
use App\Models\Gallery;
use App\Models\GalleryCategory;

use App\Models\Video;
use App\Models\VideoCategory;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleView;

use App\Models\History;
use App\Models\Live;
use DB;
use \stdClass;




class HomeController extends Controller
{
    public function index(){

        $list_of_files = scandir(public_path()."/uploads/videos/");
        // ->whereIn('file_name', $list_of_files);

    	$videos_carausel = Video::orderBy('id', 'desc')->whereIn('file_name', $list_of_files)->take(3)->get();
    	$photos_carausel = Gallery::orderBy('id', 'desc')->has('photos', '>' , 0)->take(3)->get();
    	$merged = $videos_carausel->merge($photos_carausel);
        $data['carausel'] = $merged->shuffle();

        // dd(class_basename($data['carausel'][0]->photos[0]->file_name));


        $data['latest_videos'] = Video::orderBy('id', 'desc')->whereIn('file_name', $list_of_files)->take(4)->get();
        $data['latest_photos'] = Gallery::orderBy('id', 'desc')->has('photos', '>' , 0)->take(4)->get();
        $data['latest_articles'] = Article::orderBy('id', 'desc')->take(4)->get();

        $data['lives'] = Live::where('featured',1)->orderBy('id', 'desc')->get();


        $most_articles_id = ArticleCategory::groupBy('category_id')->select('category_id', DB::raw('count(*) as total'))->orderBy('total','desc')->get()->first();
        if($most_articles_id != null ){
            $most_articles_id = $most_articles_id->category_id;

            $data['most_articles_category'] = Category::where('id', $most_articles_id)->get()->first();

            $data['most_articles'] = Article::orderBy('id', 'desc')
                ->where(function($query) use ($most_articles_id){
                    $query
                        ->whereHas('categories', function($query) use ($most_articles_id){
                            $query->where('category_id', $most_articles_id);
                        });
                })
                ->take(4)->get();
        }else{
            $most_articles_category = new stdClass();
            $most_articles_category->title = 'No Category at the moment.';
            $data['most_articles_category'] = $most_articles_category;
            $data['most_articles'] = null;
        }



        $most_videos_id = VideoCategory::groupBy('category_id')->select('category_id', DB::raw('count(*) as total'))->orderBy('total','desc')->get()->first();

        if($most_videos_id != null){
            $most_videos_id = $most_videos_id->category_id;

            $data['most_videos_category'] = Category::where('id', $most_videos_id)->get()->first();

            $data['most_videos'] = Video::orderBy('id', 'desc')
                ->where(function($query) use ($most_videos_id){
                    $query
                        ->whereHas('categories', function($query) use ($most_videos_id){
                            $query->where('category_id', $most_videos_id);
                        });
                })
                ->take(4)->get();
        }else{
            $most_videos_category = new stdClass();
            $most_videos_category->title = 'No Category at the moment.';
            $data['most_videos_category'] = $most_videos_category;
            $data['most_videos'] = null;
        }


        $most_photos_id = GalleryCategory::groupBy('category_id')->select('category_id', DB::raw('count(*) as total'))->orderBy('total','desc')->get()->first();
        if( $most_photos_id != null ){
            $most_photos_id = $most_photos_id->category_id;

            $data['most_photos_category'] = Category::where('id', $most_photos_id)->get()->first();
            $data['most_photos'] = Gallery::orderBy('id', 'desc')
                ->where(function($query) use ($most_photos_id){
                    $query
                        ->whereHas('categories', function($query) use ($most_photos_id){
                            $query->where('category_id', $most_photos_id);
                        });
                })
                ->take(4)->get();
        }else{
            $most_photos_category = new stdClass();
            $most_photos_category->title = 'No Category at the moment.';
            $data['most_photos_category'] = $most_photos_category;
            $data['most_photos'] = null;
        }





        $video_id_available = Video::where('id' ,'>' ,0)->pluck('id')->toArray();
        $most_downloaded_videos = History::whereNull('gallery_id')->where('action','Video Downloaded')->whereIn('video_id',$video_id_available)->groupBy('video_id')->select('video_id', DB::raw('count(*) as total'))->orderBy('total','desc')->take(4)->get();

        foreach($most_downloaded_videos as $key => $video){
            $data['most_downloaded_videos'][$key] = $video->video;
        }


        $photo_id_available = Gallery::where('id' ,'>' ,0)->pluck('id')->toArray();
        $most_downloaded_photos = History::whereNull('video_id')->where('action','Gallery Downloaded')->whereIn('gallery_id',$photo_id_available)->groupBy('gallery_id')->select('gallery_id', DB::raw('count(*) as total'))->orderBy('total','desc')->take(4)->get();

        foreach($most_downloaded_photos as $key => $photo){
            $data['most_downloaded_photos'][$key] = $photo->gallery;
        }


        $most_viewed_articles = ArticleView::groupBy('article_id')->select('article_id', DB::raw('count(*) as total'))->orderBy('total','desc')->take(4)->get();

        foreach($most_viewed_articles as $key => $article){
            $data['most_viewed_articles'][$key] = $article->article;
        }

		// $merged_latest = $data['latest_videos']->merge($data['latest_photos']);
		// $merged_latest = $merged_latest->merge($data['latest_articles']);
		// $data['latest'] = $merged_latest->sortBy('created_at');

    	return view('home.index',$data);
    }
}
