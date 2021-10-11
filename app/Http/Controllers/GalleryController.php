<?php

namespace App\Http\Controllers;

use App\Jobs\SendQueueEmail;
use App\Models\Gallery;
use App\Models\PlanItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Photo;
use App\Models\Category;
use App\Models\GalleryCategory;
use App\Models\GalleryView;
use App\Models\History;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\GalleryUploaded;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Response;
use Redirect;
use Session;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use URL;
use ZipArchive;

class GalleryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $data['galleries'] = $this->search()->has('photos', '>' , 0)->paginate(12);
        $data['users'] =  User::select('id','name')->orderBy('id','asc')->get();
        $data['categories'] =  Category::select('id','title')->orderBy('title','asc')->get();

        return view('gallery.grid',$data);
    }

    public function list()
    {
        $data['galleries'] = $this->search()->has('photos', '>' , 0)->paginate(6);
        $data['users'] =  User::select('id','name')->orderBy('id','asc')->get();
        $data['categories'] =  Category::select('id','title')->orderBy('title','asc')->get();

        return view('gallery.list',$data);
    }


    public function create()
    {

        abort_unless( auth()->user()->role == "admin",403);

        $data['categories'] =  Category::select('id','title')->orderBy('title','asc')->get();
        return view('gallery.create',$data);
    }


    public function store(Request $request)
    {

        abort_unless( auth()->user()->role == "admin",403);

        $request->validate([
            'name' => 'required|nullable',
            'category' => 'present|nullable',
            'gallery.*' => 'required|file|max:500000|mimes:jpeg,png,jpg,gif,svg',
            'location' => 'present|nullable',
            'description' => 'present|nullable',
        	'email_push' => 'required'
        ]);


        $images = $request->gallery;
        $categories = request()->category;
        // dd($categories);

        $request = $request->all();
    $email_push = $request['email_push'];
            unset($request['email_push']);

        $request['user_id'] = auth()->id();
        unset($request['gallery']);
        unset($request['category']);

        $new_gallery = Gallery::create($request);

        if( sizeof($categories) > 0 && $categories[0]!=null  ){
            foreach ($categories as $category) {
                GalleryCategory::create([
                                        'gallery_id' => $new_gallery->id
                                        ,'category_id' => $category
                                    ]);
            }
        }

        $image_attributes['gallery_id'] = $new_gallery->id;

        if(request()->file('gallery')){

            foreach (request()->gallery as $image) {
                //store the images
                $file_name = date('Y-m-d_H-i-s')."_".str_replace(" ","-",$image->getClientOriginalName());

                $extension = $image->getClientOriginalExtension();
                Storage::disk('photos')->put( $file_name,  File::get($image));

                $imagePath = Storage::disk('photos')->path($file_name);
                $storagePath = Storage::disk('photos_compressed')->path('/'). $file_name;
                ImageOptimizer::optimize($imagePath, $storagePath);

                $img = Image::make($storagePath);
                $img->resize(2000, 2000, function ($const) {
                    $const->aspectRatio();
                })->save($storagePath);


                //and add these attributes to the databse for future retrevial of image
                $image_attributes['mime'] = $image->getClientMimeType();
                $image_attributes['original_file_name'] = $image->getClientOriginalName();
                $image_attributes['file_name'] = $file_name;

                Photo::create($image_attributes);
            }
        }


        History::create([
                            'gallery_id' => $new_gallery->id
                            ,'user_id' => auth()->user()->id
                            ,'action' => "Gallery Uploaded"
                        ]);

		 if( $email_push == "admin" ){
        	 $users = User::where('role','admin')->orderBy('id','asc')->get();
        }
    	elseif(  $email_push == "all" ){
			$users = User::where('id','>=',0)->orderBy('id','asc')->get();
        }else{
             $users= [];
         }

        $data['data'] = Gallery::where('id',$new_gallery->id)->get()->first();
        $data['mail'] = 'App\Mail\GalleryUploaded';
        $data['users'] = $users;

        $job = (new SendQueueEmail($data))->delay(now()->addSeconds(2));
        dispatch($job);

       //  return Redirect::to('photos')
       // ->with('success','Greate! Gallery created successfully.');

    	return response()->json( $new_gallery->id );

    }


    public function show($id)
    {
        $where = array('id' => $id);
        $data['gallery'] = Gallery::where($where)->first();


    	 if($data['gallery'] == null){
       	 return Redirect::to('photos')
       		->with('error','No such gallery found!');

        }

        foreach($data['gallery']->categories as $key => $category ){
            $current_gallery_tags[$key] = $category->category->id;
        }


    	//create view
    	if( !$data['gallery']->viewed_before() ){
        	GalleryView::create_log($data['gallery']);
        }


        // dd($current_gallery_tags);
       if( isset($current_gallery_tags) ){

       	$list_of_files = scandir(public_path()."uploads/photos");

            $data['related'] = Gallery::whereHas('categories', function($q) use ($current_gallery_tags) {
                $q->whereIn('category_id', $current_gallery_tags);
            })
            ->where('id', '!=' , $id)
            ->whereHas('photos', function($q) use ($list_of_files) {
                $q->whereIn('file_name', $list_of_files);
            })
            ->orderBy('created_at','desc')
            ->take(4)
            ->get();
       }else{
           $data['related'] = Gallery::orderBy('created_at','desc')
           ->where('id', '!=' , $id)
            ->take(4)
            ->get();
       }



        // dd($data['related'] );

        return view('gallery.show', $data);
    }

        // foreach ($gallery->photos as $photo) {
        //    Response::download(public_path()."/uploads/".$photo->file_name);
        // }

    public function download($id)
    {

       // dd(phpinfo());
        $where = array('id' => $id);
        $gallery = Gallery::where($where)->first();

        if(  sizeof(Gallery::where($where)->has('photos', '>' , 0)->get()) == 0 ){
            return Redirect::to('photos')->with('success','Cannot download photos as the gallery is empty!');
        }

        History::create([
                            'gallery_id' => $id
                            ,'user_id' => auth()->user()->id
                            ,'action' => "Gallery Downloaded"
                        ]);


        $zip_file = date('Y-m-d_H-i-s')."_".str_replace(" ","-",$gallery->name).'_'.$gallery->id.'.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $path = public_path('uploads');
        foreach ($gallery->photos as $photo) {
            $filePath = public_path('uploads').'/photos/'.$photo->file_name;

            // $relativePath = 'uploads/photos/' . substr($filePath, strlen($path) + 1);
        	$relativePath = substr($filePath, strlen($path) + 1);
            $relativePath = date('Y-m-d_H-i-s')."_".str_replace(" ","-",$gallery->name).'_'.$gallery->id."/".$photo->file_name;
            $zip->addFile($filePath, $relativePath);
        }

        // $zip->renameName($zip_file,"test");
        $zip_extract_name = date('Y-m-d_H-i-s')."_".str_replace(" ","-",$gallery->name).'_'.$gallery->id;

        $zip->close();
        return response()->download($zip_file)->deleteFileAfterSend(true);
    }


    public function edit($id)
    {

        abort_unless( auth()->user()->role == "admin",403);

        Session::put('gallery_edit_request_referrer', URL::previous());

        $where = array('id' => $id);
        $data['gallery'] = Gallery::where($where)->first();
        $data['categories'] =  Category::select('id','title')->orderBy('title','asc')->get();

        return view('gallery.edit', $data);
    }


    public function update(Request $request, $id)
    {

        abort_unless( auth()->user()->role == "admin",403);

        $request->validate([
            'name' => 'present|nullable',
            'category' => 'present|nullable',
            'photo_override' => 'required',
            'gallery.*' => 'nullable|present|file|max:500000|mimes:jpeg,png,jpg,gif,svg',
            'location' => 'present|nullable',
            'description' => 'present|nullable',
        ]);


        $images = $request->gallery;
        $categories = request()->category;
        $photo_override = request()->photo_override;


        $request = $request->all();
        $request['user_id'] = auth()->id();
        unset($request['gallery']);
        unset($request['category']);
        unset($request['photo_override']);
        unset($request['_token']);
        unset($request['_method']);

        // dd($request['name']);

        if($request['name'] == null || $request['name'] == ""){
            unset($request['name']);
        }


        $gallery = Gallery::where('id',$id);

        if(  sizeof($categories) > 0 && $categories[0]!=null   ){

            GalleryCategory::where('gallery_id',$id)->delete();

            foreach ($categories as $category) {
                GalleryCategory::create([
                                        'gallery_id' => $id
                                        ,'category_id' => $category
                                    ]);
            }
        }

        $image_attributes['gallery_id'] = $id;



        if(request()->file('gallery')){
            $list_of_files = scandir(public_path()."/uploads/photos/");

            if( $photo_override == 1 ){

                foreach ($gallery->get()->first()->photos as $photo) {
                    $previous_photo_path = public_path().'/uploads/photos/'.$photo->file_name;
                    if (file_exists($previous_photo_path)) {
//                        unlink($previous_photo_path);
                    }
                }

                Photo::where('gallery_id',$id)->delete();
            }

            foreach (request()->gallery as $image) {
                //store the images
                $file_name = date('Y-m-d_H-i-s')."_".str_replace(" ","-",$image->getClientOriginalName());

                $extension = $image->getClientOriginalExtension();
                Storage::disk('photos')->put( $file_name,  File::get($image));

                $imagePath = Storage::disk('photos')->path($file_name);
                $storagePath = Storage::disk('photos_compressed')->path('/'). $file_name;
                ImageOptimizer::optimize($imagePath, $storagePath);

                $img = Image::make($storagePath);
                $img->resize(2000, 2000, function ($const) {
                    $const->aspectRatio();
                })->save($storagePath);

                //and add these attributes to the databse for future retrevial of image
                $image_attributes['mime'] = $image->getClientMimeType();
                $image_attributes['original_file_name'] = $image->getClientOriginalName();
                $image_attributes['file_name'] = $file_name;

                Photo::create($image_attributes);
            }
        }

        $gallery->update($request);

        History::create([
                            'gallery_id' => $id
                            ,'user_id' => auth()->user()->id
                            ,'action' => "Gallery Edited"
                        ]);


       //  return redirect(Session::get('gallery_edit_request_referrer'))
       // ->with('success','Great! Gallery updated successfully');
    	 return response()->json( $gallery->get()->first()->id );

    }



    public function destroy($id)
    {

        abort_unless( auth()->user()->role == "admin",403);

        $gallery = Gallery::where('id',$id);
        $list_of_files = scandir(public_path()."/uploads/photos/");

        foreach ($gallery->get()->first()->photos as $photo) {

            $previous_photo_path = public_path().'/uploads/photos/'.$photo->file_name;
            if (file_exists($previous_photo_path)) {
//                unlink($previous_photo_path);
            }
        }

        $planner_items = PlanItem::where('type',1)->where('item_id',$id)->delete();

        $gallery->delete();
        Photo::where('gallery_id',$id)->delete();
        GalleryCategory::where('gallery_id',$id)->delete();
        GalleryView::where('gallery_id',$id)->delete();

        History::create([
                            'gallery_id' => $id
                            ,'user_id' => auth()->user()->id
                            ,'action' => "Gallery Deleted"
                        ]);

        return Redirect::to('photos')->with('success','Gallery deleted successfully');
    }

    public function destroy_photo($id)
    {

        abort_unless( auth()->user()->role == "admin",403);

        $photo = Photo::where('id',$id);
        $gallery_id = $photo->get()->first()->gallery_id;
        $gallery = Gallery::where('id',$gallery_id);
        $list_of_files = scandir(public_path()."/uploads/photos/");

        if(sizeof($gallery->get()[0]->photos) <= 1){
          $gallery->delete();

            $previous_photo_path = public_path().'/uploads/photos/'.$photo->get()->first()->file_name;
            if (file_exists($previous_photo_path)) {
//                unlink($previous_photo_path);
            }

            $photo->delete();

            return Redirect::to('photos')->with('success','Last photo & gallery deleted successfully');
        }

        $previous_photo_path = public_path().'/uploads/photos/'.$photo->get()->first()->file_name;
        if (file_exists($previous_photo_path)) {
//            unlink($previous_photo_path);
        }


        $photo->delete();

        History::create([
                            'gallery_id' => $gallery->get()->first()->id
                            ,'user_id' => auth()->user()->id
                            ,'action' => "Gallery Edited (Photo delete)"
                        ]);



       return redirect(Session::get('gallery_edit_request_referrer'))->with('success','Gallery deleted successfully');
    }


    public function search(){


        if(request()->sort == "new" || request()->sort == null){
            $galleries = Gallery::orderBy('id','desc');
        }else{
            $galleries = Gallery::orderBy('id','asc');
        }



        if(isset(request()->search)){
            // var_dump(request()->search);
            // var_dump($galleries->get()->all());
            $galleries->where(function($query){
                    $query->where('name', 'like', '%'.request()->search.'%')
                        ->orWhere('description', 'like', '%'.request()->search.'%')
                        ->orWhere('location', 'like', '%'.request()->search.'%')
                        ->orWhereHas('photos', function($query){
                            $query->where('original_file_name', 'like', '%'.request()->search.'%');
                        })
                        ->orWhereHas('user', function($query){
                            $query->where('name', 'like', '%'.request()->search.'%');
                        });
                   }) ;

            // var_dump($galleries->get()->all());
        }

        if(isset(request()->user)){

            $galleries->where(function($query){
                    $query
                        ->where('user_id', request()->user);
                    })
                    ;

        }

        if(isset(request()->from_date)){

            $date_before = Carbon::parse(request()->from_date)->subDays(1)->toDateString();
            $date = Carbon::parse(request()->from_date)->toDateString();
            $date_after = Carbon::parse(request()->from_date)->addDays(1)->toDateString();



            $galleries->where(function($query) use ($date,$date_after){
                $query
                    ->where('created_at',">=",$date)->where('created_at',"<",$date_after);
            })
            ;

        }

        if(isset(request()->category)){

            $galleries->where(function($query){
                    $query
                        ->whereHas('categories', function($query){
                            $query->where('category_id', request()->category);
                        });
                    })
                    ;
        }


        // $list_of_files = ;

        $galleries->whereHas('photos', function($query){
                            $query->whereIn('file_name', scandir(public_path()."/uploads/photos/"));
                        });

        return $galleries;
    }


    public function compress_uploaded(){
        $photos = Photo::get();

        foreach ($photos as $photo){
            $file_name = $photo->file_name;

            $imagePath = Storage::disk('photos')->path($file_name);
            $storagePath = Storage::disk('photos_compressed')->path('/'). $file_name;
            ImageOptimizer::optimize($imagePath, $storagePath);

            $img = Image::make($storagePath);
            $img->resize(2000, 2000, function ($const) {
                $const->aspectRatio();
            })->save($storagePath);
        }
    }
}
