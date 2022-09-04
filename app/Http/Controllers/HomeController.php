<?php

namespace App\Http\Controllers;

use App\Mail\PlanUpdated;
use App\Models\BlockedUser;
use App\Models\Plan;
use App\Models\SupportMessage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\ContactUs;

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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use \stdClass;




class HomeController extends Controller
{
    public function index(){

        $date = Carbon::now();

        $data['plans'] = Plan::
            where('date',"<=",$date)->where('end_date',">=",$date)
            ->orderBy('date','asc')
            ->take(4)->get();


//        $list_of_files = scandir(public_path()."/uploads/videos/");


        $latest_videos = Video::with(['history','categories','categories.category','user','views'])->orderBy('id', 'desc')
//            ->whereIn('file_name', $list_of_files)
            ->take(5)->get();



    	$videos_carausel = $latest_videos;
//    	$photos_carausel = Gallery::orderBy('id', 'desc')->has('photos', '>' , 0)->take(3)->get();
//    	$merged = $videos_carausel->merge($photos_carausel);
//        $data['carausel'] = $merged->shuffle();
        $data['carausel'] = $videos_carausel->shuffle();

        // dd(class_basename($data['carausel'][0]->photos[0]->file_name));


        $data['latest_videos'] = $latest_videos->take(4);
        $data['latest_photos'] = Gallery::orderBy('id', 'desc')->has('photos', '>' , 0)->take(4)->get();
        $data['latest_articles'] = Article::orderBy('id', 'desc')->take(4)->get();

        $data['lives'] = Live::where('featured',1)->orderBy('id', 'desc')->get();



        $data['categories'] = Category::all();

        foreach ($data['categories'] as $category){
            $data['category_videos'][$category->id] =

                Video::with(['history','categories','categories.category','user','views'])
                    ->whereHas('categories', function($q) use ($category){
                        $q->where('category_id',  $category->id);
                    })
//                ->whereIn('file_name', $list_of_files)
                    ->orderBy('id','desc')->limit(4)->get();
        }




//        $most_articles_id = ArticleCategory::groupBy('category_id')->select('category_id', DB::raw('count(*) as total'))->orderBy('total','desc')->get()->first();
//        if($most_articles_id != null ){
//            $most_articles_id = $most_articles_id->category_id;
//
//            $data['most_articles_category'] = Category::where('id', $most_articles_id)->get()->first();
//
//            $data['most_articles'] = Article::orderBy('id', 'desc')
//                ->where(function($query) use ($most_articles_id){
//                    $query
//                        ->whereHas('categories', function($query) use ($most_articles_id){
//                            $query->where('category_id', $most_articles_id);
//                        });
//                })
//                ->take(4)->get();
//        }else{
//            $most_articles_category = new stdClass();
//            $most_articles_category->title = 'No Category at the moment.';
//            $most_articles_category->id = 0;
//            $data['most_articles_category'] = $most_articles_category;
//            $data['most_articles'] = null;
//        }
//
//
//
//        $most_videos_id = VideoCategory::groupBy('category_id')->select('category_id', DB::raw('count(*) as total'))->orderBy('total','desc')->get()->first();
//
//        if($most_videos_id != null){
//            $most_videos_id = $most_videos_id->category_id;
//
//            $data['most_videos_category'] = Category::where('id', $most_videos_id)->get()->first();
//
//            $data['most_videos'] = Video::orderBy('id', 'desc')
//                ->where(function($query) use ($most_videos_id){
//                    $query
//                        ->whereHas('categories', function($query) use ($most_videos_id){
//                            $query->where('category_id', $most_videos_id);
//                        });
//                })
//                ->take(4)->get();
//        }else{
//            $most_videos_category = new stdClass();
//            $most_videos_category->title = 'No Category at the moment.';
//            $most_videos_category->id = 0;
//            $data['most_videos_category'] = $most_videos_category;
//            $data['most_videos'] = null;
//        }
//
//
//        $most_photos_id = GalleryCategory::groupBy('category_id')->select('category_id', DB::raw('count(*) as total'))->orderBy('total','desc')->get()->first();
//        if( $most_photos_id != null ){
//            $most_photos_id = $most_photos_id->category_id;
//
//            $data['most_photos_category'] = Category::where('id', $most_photos_id)->get()->first();
//            $data['most_photos'] = Gallery::orderBy('id', 'desc')
//                ->where(function($query) use ($most_photos_id){
//                    $query
//                        ->whereHas('categories', function($query) use ($most_photos_id){
//                            $query->where('category_id', $most_photos_id);
//                        });
//                })
//                ->take(4)->get();
//        }else{
//            $most_photos_category = new stdClass();
//            $most_photos_category->title = 'No Category at the moment.';
//            $most_photos_category->id = 0;
//
//            $data['most_photos_category'] = $most_photos_category;
//            $data['most_photos'] = null;
//        }





//        $video_id_available = Video::where('id' ,'>' ,0)->pluck('id')->toArray();
//        $most_downloaded_videos = History::whereNull('gallery_id')->where('action','Video Downloaded')->whereIn('video_id',$video_id_available)->groupBy('video_id')->select('video_id', DB::raw('count(*) as total'))->orderBy('total','desc')->take(4)->get();
//        $data['most_downloaded_videos'] = null;
//        foreach($most_downloaded_videos as $key => $video){
//            $data['most_downloaded_videos'][$key] = $video->video;
//        }
//
//
//        $photo_id_available = Gallery::where('id' ,'>' ,0)->pluck('id')->toArray();
//        $most_downloaded_photos = History::whereNull('video_id')->where('action','Gallery Downloaded')->whereIn('gallery_id',$photo_id_available)->groupBy('gallery_id')->select('gallery_id', DB::raw('count(*) as total'))->orderBy('total','desc')->take(4)->get();
//        $data['most_downloaded_photos'] = null;
//        foreach($most_downloaded_photos as $key => $photo){
//            $data['most_downloaded_photos'][$key] = $photo->gallery;
//        }


//        $most_viewed_articles = ArticleView::groupBy('article_id')->select('article_id', DB::raw('count(*) as total'))->orderBy('total','desc')->take(4)->get();
//        $data['most_viewed_articles'] = null;
//        foreach($most_viewed_articles as $key => $article){
//            $data['most_viewed_articles'][$key] = $article->article;
//        }

		// $merged_latest = $data['latest_videos']->merge($data['latest_photos']);
		// $merged_latest = $merged_latest->merge($data['latest_articles']);
		// $data['latest'] = $merged_latest->sortBy('created_at');

    	return view('home.index',$data);
    }




    public function contactUs(Request $request){


        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'message' => 'required|max:5000'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->with('error',$validator->messages()->first());
        }




        $email_is_blocked = BlockedUser::where('email',$request->get('email'))->first();
        if($email_is_blocked){
            $block_user = new BlockedUser();
            $block_user->ip_address = $request->ip();
            $block_user->email = $request->get('email');
            $block_user->save();
        }else{
            $support_message = new SupportMessage();
            $support_message->email = $request->get('email');
            $support_message->message = $request->get('message');
            $support_message->ip_address = $request->ip();
            $support_message->save();

            $users = User::whereIn('id',[1,4])->orderBy('id','asc')->get();
            foreach($users as $user){
                Mail::to( $user )->send(new ContactUs( $support_message ));
            }
        }



        return Redirect::back()->with('success','Message sent successfully!');
    }

}
