<?php

namespace App\Http\Controllers;

use App\Jobs\SendQueueEmail;
use App\Models\Plan;
use App\Models\PlanItem;
use App\Models\Video;
use App\Models\VideoView;
use App\Models\User;
use App\Models\Category;
use App\Models\VideoCategory;
use App\Models\History;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\VideoUploaded;

use FFMpeg;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use ProtoneMedia\LaravelFFMpeg\Filters\WatermarkFactory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Builder;
use Response;
use Redirect;
use Session;
use URL;

class VideoController extends Controller
{
    public function __construct(){
        $this->middleware('auth',['except' => [
            'create_view'
        ]]);
    }

    public function index()
    {

        $data['videos'] = $this->search()->paginate(12);

        $data['users'] =  User::select('id','name')->orderBy('id','asc')->get();
        $data['categories'] =  Category::select('id','title')->orderBy('title','asc')->get();

        return view('video.grid',$data);
    }

    public function list()
    {
        $data['videos'] = $this->search()->paginate(12);
        $data['users'] =  User::select('id','name')->orderBy('id','asc')->get();
        $data['categories'] =  Category::select('id','title')->orderBy('title','asc')->get();

        return view('video.list',$data);
    }


    public function create()
    {
        abort_unless( auth()->user()->role == "admin",403);

        $data['categories'] =  Category::select('id','title')->orderBy('title','asc')->get();
    	$data['session_id'] = uniqid('', true);

        return view('video.create',$data);
    }


    public function store(Request $request)
    {
        abort_unless( auth()->user()->role == "admin",403);

                    // dd(request()->category);


        $request->validate([
            'name' => 'present|nullable',
            'category' => 'required|nullable',
            'video' => 'required|file|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi,avi,flv,mp4,mpeg',
            'location' => 'present|nullable',
            'description' => 'present|nullable',
        	'session_id' => 'required',
        	'email_push' => 'required'
        ]);


        if( request()->file('video') ){


            $file = $request->file('video');


            $video = request()->video;

            if( request()->name == null ){
                  $request['name'] = $video->getClientOriginalName();
            }

            $file_name = date('Y-m-d_H-i-s')."_". preg_replace("/[^a-z0-9\_\-\.]/i", '', str_replace(" ","-",$video->getClientOriginalName()) );

            Storage::disk('videos')->put($file_name,  File::get($video));


            $request = $request->all();
			$email_push = $request['email_push'];
            unset($request['email_push']);

        	$session_id = $request['session_id'];
            // unset($request['session_id']);


            $request['user_id'] = auth()->user()->id;
            $request['mime'] = $video->getClientMimeType();

            $size = $video->getSize();
            $precision = 2;
            $base = log($size, 1024);
            $suffixes = array('', 'KB', 'MB', 'GB', 'TB');
            $size= round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
            $request['size'] = $size;

            $request['original_file_name'] = $video->getClientOriginalName();
            $request['file_name'] = $file_name;
            $request['runtime'] = 123.456;


            unset($request['file']);

            $new_video = Video::create($request);

        	$this->create_preview($file_name, $session_id);
            $this->create_thumbnail($file_name);


        }

        if( sizeof(request()->category) >0 ){

            $categories = request()->category;

            foreach ($categories as $category) {
                if($category!=null){
                    VideoCategory::create([
                                            'video_id' => $new_video->id
                                            ,'category_id' => $category
                                        ]);
                }
            }
        }

        History::create([
                            'video_id' => $new_video->id
                            ,'user_id' => auth()->user()->id
                            ,'action' => "Video Uploaded"
                        ]);


        if( $email_push == "admin" ){
        	 $users = User::where('role','admin')->orderBy('id','asc')->get();
        }
    	elseif(  $email_push == "all" ){
			$users = User::where('id','>=',0)->orderBy('id','asc')->get();
        }else{
            $users= [];
        }
            $data['data'] = Video::where('id',$new_video->id)->get()->first();
            $data['mail'] = 'App\Mail\VideoUploaded';
            $data['users'] = $users;
        $job = (new SendQueueEmail($data))->delay(now()->addSeconds(2));
        dispatch($job);


       //  return Redirect::to('videos')
       // ->with('success','Greate! Video created successfully.');
    	return response()->json( $new_video->id );
    }



	public function create_preview($file_name, $id){

    $video = Video::where('session_id',$id);

    // request()->session()->put('session_encoding_progress'.$id, 0 );
    // request()->session()->save();

    // dd(public_path().'uploads/'.$file_name.'_preview.mp4');
        	//create low res
                // create a video format...
       	 		// $lowBitrateFormat = (new X264('libmp3lame', 'libx264'))
       	 		$lowBitrateFormat = (new X264('aac', 'libx264'))
                ->setKiloBitrate(500);
            	// open the uploaded video from the right disk...
                $coversion = FFMpeg::fromDisk("videos")
                    ->open( $file_name)
    //                        ->addWatermark(function(WatermarkFactory $watermark) {
    //     $watermark->fromDisk('public')
    //         ->open('watermark.png')
    //         ->left(25)
    //         ->bottom(25);
    // })

                    ->addFilter(function ($filters) {
                        $filters->resize(new Dimension(640, 360));
                    })
                    ->export()
                    ->onProgress(function ($percentage) use ($video) {
        				// request()->session()->put('session_encoding_progress', $percentage);
						$video->update(['progress'=> $percentage ]);
        				// request()->session()->put('session_encoding_progress'.$id, $percentage);
                    	// request()->session()->save();
                	})

                    ->toDisk('previews')
                    ->inFormat($lowBitrateFormat)
                	->save( 'preview_'.$file_name);
    }


	public function create_thumbnail($file_name){

    $video =  FFMpeg::fromDisk('previews')
    		->open('preview_'.$file_name);


    foreach ([5, 15, 25, 60, 120, 240] as $key => $seconds) {
     $video =  $video->getFrameFromSeconds($seconds)
        ->export()
     	->toDisk('thumbs')
        ->save('thumb_'.($key+1)."_".$file_name.'.png');
}

// 	// $duration = $video->getDurationInSeconds(); // returns an int
// 	$duration = $video->get('duration'); // returns an int

    }


	public function get_session_encoding_progress(Request $request){


    	$request->validate([
    	'session_id' => 'required',
    	]);
    	$request = $request->all();
    	$id = $request['session_id'];

    	$video = Video::where('session_id',$request['session_id'])->get()->first();

    	// return response()->json( Session::get('session_encoding_progress') );
    	// return response()->json( request()->session()->get('session_encoding_progress'.$id) );
        if($video){
            return response()->json( $video->progress );
        }
    }


    public function show(Video $video)
    {
        $where = array('id' => $video->id);
        $data['video'] = $video;

    	if($data['video'] == null){
       	 return Redirect::to('videos')
       		->with('error','No such video found!');

        }

        //create view
    	if( !$data['video']->viewed_before() ){
        	VideoView::create_log($data['video']);
        }




    	//get related videos
        foreach($data['video']->categories as $key => $category ){
            $current_video_tags[$key] = $category->category->id;
        }

        if( isset($current_video_tags) ){
        // dd($current_video_tags);
       	$list_of_files = scandir(public_path()."uploads/videos");

        $data['related'] = Video::whereHas('categories', function($q) use ($current_video_tags) {
                                    $q->whereIn('category_id', $current_video_tags);
                                })
        						->where('id', '!=' , $video->id)
        						->whereIn('file_name', $list_of_files)
                                ->orderBy('created_at','desc')->take(4)->get();
        }else{

            $data['related'] = Video::orderBy('created_at','desc')->where('id', '!=' , $video->id)->take(4)->get();

        }



        return view('video.show', $data);
    }

	public function create_view($id){

        $where = array('id' => $id);
        $data['video'] = Video::where($where)->first();

    	if($data['video'] == null){
       	 return response()->json( "No such video found to update view!" );

        }

        //create view
    	if( !$data['video']->viewed_before() ){
        	VideoView::create_log($data['video']);
        }

    	return response()->json( "Video view updated successfully!" );
    }

    public function download(Video $video)
    {


        $where = array('id' => $video->id);
        $video = $video;

    	if($video == null){
        	return Redirect::to('videos')
       		->with('error','No such video found!');

        }

        History::create([
                            'video_id' => $video->id
                            ,'user_id' => auth()->user()->id
                            ,'action' => "Video Downloaded"
                        ]);

        return Response::download(public_path()."uploads/videos/".$video->file_name);
    }


    public function edit(Video $video)
    {

        abort_unless( auth()->user()->role == "admin",403);

        Session::put('video_edit_request_referrer', URL::previous());

        $where = array('id' => $video->id);
        $data['video'] = $video;
        $data['categories'] =  Category::select('id','title')->orderBy('title','asc')->get();


        return view('video.edit', $data);
    }


    public function update(Video $video, Request $request)
    {

       abort_unless( auth()->user()->role == "admin",403);
       $request->validate([
            'name' => 'present|nullable',
            'category' => 'required|nullable',
            'video' => 'nullable|file|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi,avi,flv,mp4,mpeg',
            'location' => 'present|nullable',
            'description' => 'present|nullable',
            'thumbnail' => 'present|required',
        	'session_id' => 'required',
        ]);

        $request = $request->all();
        $email_push = $request['email_push'];

        $video_id = $video->id;

        $video->name = $request['name'];
        $video->location = $request['location'];
        $video->description = $request['description'];
        $video->thumbnail = $request['thumbnail'];



        if( request()->file('video') ){

            $file = $request->file('video');


        	$session_id = $request['session_id'];

            $video_file = request()->video;
            $extension = $video->getClientOriginalExtension();
            $file_name = date('Y-m-d_H-i-s')."_".str_replace(" ","-",$video_file->getClientOriginalName());

            Storage::disk('videos')->put($file_name,  File::get($video_file));

            $this->create_preview($file_name, $session_id );
            $this->create_thumbnail($file_name);


//            $request['mime'] = $video_file->getClientMimeType();
            $video->mime = $request['mime'];

            $size = $video_file->getSize();
            $precision = 2;
            $base = log($size, 1024);
            $suffixes = array('', 'kb', 'mb', 'gb', 'tb');
            $size= round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];

            $request['size'] = $size;


//            $request['original_file_name'] = $video_file->getClientOriginalName();
//            $request['file_name'] = $file_name;
//            $request['runtime'] = 123.456;
            $old_video_file_name = $video->file_name;

            $video->original_file_name = $video_file->getClientOriginalName();
            $video->file_name = $file_name;
            $video->runtime = 123.456;


           $this->delete_video_files($old_video_file_name );

        }

        $video->save();

        if( sizeof(request()->category) >= 1 ){
            $categories = request()->category;

             VideoCategory::where('video_id',$video_id)->delete();

            foreach ($categories as $category) {
                if($category!=null){
                VideoCategory::create([
                                        'video_id' => $video_id
                                        ,'category_id' => $category
                                    ]);
                }
            }
        }else{
             VideoCategory::where('video_id',$video_id)->delete();
        }



        History::create([
            'video_id' => $video->id
            ,'user_id' => auth()->id()
            ,'action' => "Video Edited"
        ]);


        return response()->json( $video_id );

    }


	public function delete_video_files($file_name){
    	 	$previous_video_path = public_path().'uploads/videos/'.$file_name;
            if(file_exists ($previous_video_path)){
//            	unlink($previous_video_path);
            }

            $previous_preview_path = public_path().'uploads/videos/previews/preview_'.$file_name;
        	if(file_exists ($previous_preview_path)){
//            	unlink($previous_preview_path);
            }

    		for ($i = 1; $i <= 3; $i++) {
            	$previous_thumbnail_path = public_path().'uploads/videos/thumbs/thumb_'.$i."_".$file_name.'.png';
        		if(file_exists ($previous_thumbnail_path)){
//                unlink($previous_thumbnail_path);
            	}
			}

    }


    public function destroy($id)
    {

        abort_unless( auth()->user()->role == "admin",403);

        $video = Video::where('id',$id);

        $this->delete_video_files( $video->latest()->first()->file_name );

        $planner_items = PlanItem::where('type',0)->where('item_id',$id)->delete();

        $video->delete();
        VideoCategory::where('video_id',$id)->delete();
        VideoView::where('video_id',$id)->delete();

        History::create([
                            'video_id' => $id
                            ,'user_id' => auth()->user()->id
                            ,'action' => "Video Deleted"
                        ]);

        return Redirect::to('videos')->with('success','Video deleted successfully');
    }


    public function search(){


        if(request()->sort == "new" || request()->sort == null){
            $videos = Video::orderBy('id','desc');
        }else{
            $videos = Video::orderBy('id','asc');
        }



        if(isset(request()->search)){
            // var_dump(request()->search);
            // var_dump($videos->get()->all());
            $videos->where(function($query){
                    $query->where('name', 'like', '%'.request()->search.'%')
                        ->orWhere('description', 'like', '%'.request()->search.'%')
                        ->orWhere('location', 'like', '%'.request()->search.'%')
                        ->orWhere('original_file_name', 'like', '%'.request()->search.'%')
                        ->orWhereHas('user', function($query){
                            $query->where('name', 'like', '%'.request()->search.'%');
                        });
                   }) ;

            // var_dump($videos->get()->all());
        }

        if(isset(request()->user)){

            $videos->where(function($query){
                    $query
                        ->where('user_id', request()->user);
                    })
                    ;

        }

        if(isset(request()->from_date)){

            $date_before = Carbon::parse(request()->from_date)->subDays(1)->toDateString();
            $date = Carbon::parse(request()->from_date)->toDateString();
            $date_after = Carbon::parse(request()->from_date)->addDays(1)->toDateString();



            $videos->where(function($query) use ($date,$date_after){
                    $query
                        ->where('created_at',">=",$date)->where('created_at',"<",$date_after);
                        //->where('created_at',">=", request()->from_date);
                    })
                    ;

        }

        if(isset(request()->category)){

            $videos->where(function($query){
                    $query
                        ->whereHas('categories', function($query){
                            $query->where('category_id', request()->category);
                        });
                    })
                    ;
        }
        // dd(public_path()."/uploads/");
        $list_of_files = scandir(public_path()."uploads/videos");
        $videos->whereIn('file_name', $list_of_files);

        return $videos;
    }




}
