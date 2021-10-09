<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\GalleryCategory;
use App\Models\VideoCategory;

use Illuminate\Http\Request;
use Redirect;

class CategoryController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        abort_unless( auth()->user()->role == "admin",403);
        abort_unless( auth()->user()->id == 14 || auth()->user()->id == 1,403);

        $data['categories'] = Category::orderBy('id','desc')->paginate(50);

        return view('category.list',$data);
    }


    public function create()
    {
        abort_unless( auth()->user()->role == "admin",403);

        return view('category.create');
    }


    public function store(Request $request)
    {
        abort_unless( auth()->user()->role == "admin",403);

        // var_dump($request->all());


        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $request = $request->all();
        unset($request['_token']);
        unset($request['_method']);
        $request['user_id'] = auth()->user()->id;


        Category::create($request);

        return Redirect::to('categories')
       ->with('success','Greate! Category created successfully.');
    }


    public function show($id)
    {
        abort_unless( auth()->user()->role == "admin",403);

        $where = array('id' => $id);
        $data['category'] = Category::where($where)->first();

        if( auth()->user()->type != "admin" ){
            abort_unless( auth()->user()->id == $data['category']->user_id,403);
        }

        return view('category.show', $data);
    }


    public function edit($id)
    {
        abort_unless( auth()->user()->role == "admin",403);

        $where = array('id' => $id);
        $data['category'] = Category::where($where)->first();

        if( auth()->user()->type != "admin" ){
            abort_unless( auth()->user()->id == $data['category']->user_id,403);
        }



        return view('category.edit', $data);
    }


    public function update(Request $request, $id)
    {
        abort_unless( auth()->user()->role == "admin",403);

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $request = $request->all();
        unset($request['_token']);
        unset($request['_method']);
        // $update = ['title' => $request->title, 'description' => $request->description];
        $category = Category::where('id',$id);

        if( auth()->user()->type != "admin" ){
            abort_unless( auth()->user()->id == $category->first()->user_id,403);
        }



        $category->update($request);

        return Redirect::to('categories')
       ->with('success','Great! Category updated successfully');
    }


    public function destroy($id)
    {
        abort_unless( auth()->user()->role == "admin",403);

        $category = Category::where('id',$id);

        if( auth()->user()->type != "admin" ){
            abort_unless( auth()->user()->id == $category->first()->user_id,403);
        }

        $video_categories = VideoCategory::where('category_id',$id)->get();

        foreach($video_categories as $video_category ){
            $video_category->delete();
        }

        $gallery_categories = GalleryCategory::where('category_id',$id)->get();

        // dd($gallery_categories);

        foreach($gallery_categories as $gallery_category ){
            $gallery_category->delete();
        }


        $category->delete();

        return Redirect::to('categories')->with('success','Category deleted successfully');
    }





}
