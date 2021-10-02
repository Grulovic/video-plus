<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\History;
use App\Models\Live;
use App\Models\Plan;
use App\Models\PlanCategory;
use App\Models\PlanItem;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PlannerController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Plan::class, 'plan');
    }

    public function index(Request $request)
    {
        $request->validate([
            'date' => 'nullable',
        ]);

        if($request->has('date')){
            $date_before = Carbon::parse($request->date)->subDays(1)->toDateString();
            $date = Carbon::parse($request->date)->toDateString();
            $date_after = Carbon::parse($request->date)->addDays(1)->toDateString();
            $data['plans'] = Plan::where('date',">=",$date)->where('date',"<",$date_after)->get();
        }else{
            $date_before = Carbon::now()->subDays(1)->toDateString();
            $date = Carbon::now()->toDateString();
            $date_after = Carbon::now()->addDays(1)->toDateString();

            $data['plans'] = Plan::where('date',">=",$date)->where('date',"<",$date_after)->get();
        }
        $data['date_after'] = $date_after;
        $data['today'] = Carbon::now()->toDateString();
        $data['date_before'] = $date_before;
        return view('plan.list',$data);
    }


    public function create()
    {
        $data['categories'] =  Category::select('id','title')->orderBy('title','asc')->get();

        $data['videos'] =  Video::select('id','name')->orderBy('created_at','desc')->limit(20)->get();
        $data['photos'] =  Gallery::select('id','name')->orderBy('created_at','desc')->limit(20)->get();
        $data['texts'] =  Article::select('id','title')->orderBy('created_at','desc')->limit(20)->get();
        $data['lives'] =  Live::select('id','title')->orderBy('created_at','desc')->limit(20)->get();

        return view('plan.create',$data);
    }


    public function store(Request $request)
    {
        // abort_unless( auth()->user()->role == "admin",403);

        $request->validate([
            'title' => 'required',
            'description' => 'present|nullable',
            'location' => 'present|nullable',
            'date' => 'required',
            'category' => 'present|nullable',

            'video' => 'present|nullable',
            'photo' => 'present|nullable',
            'text' => 'present|nullable',
            'live' => 'present|nullable',

            'video_items' => 'nullable',
            'photo_items' => 'nullable',
            'text_items' => 'nullable',
            'live_items' => 'nullable',
        ]);

        $request = $request->all();

        unset($request['_token']);
        unset($request['_method']);
        $request['user_id'] = Auth::id();

        $new_plan = Plan::create($request);

        //create categories
        $categories = request()->category;
        if( sizeof($categories) > 0 && $categories[0]!=null  ){
            foreach ($categories as $category) {
                PlanCategory::create([
                    'plan_id' => $new_plan->id
                    ,'category_id' => $category
                ]);
            }
        }

        //create video items
        $video_items = request()->video_items;
        if( sizeof($video_items) > 0 && $video_items[0]!=null  ){
            foreach ($video_items as $video_item) {
                PlanItem::create([
                    'plan_id' => $new_plan->id
                    ,'type' => 0
                    ,'item_id' => $video_item
                ]);
            }
        }

        //create photo items
        $photo_items = request()->photo_items;
        if( sizeof($photo_items) > 0 && $photo_items[0]!=null  ){
            foreach ($photo_items as $photo_item) {
                PlanItem::create([
                    'plan_id' => $new_plan->id
                    ,'type' => 1
                    ,'item_id' => $photo_item
                ]);
            }
        }

        //create text items
        $article_items = request()->text_items;
        if( sizeof($article_items) > 0 && $article_items[0]!=null  ){
            foreach ($article_items as $article_item) {
                PlanItem::create([
                    'plan_id' => $new_plan->id
                    ,'type' => 2
                    ,'item_id' => $article_item
                ]);
            }
        }

        //create live items
        $live_items = request()->live_items;
        if( sizeof($live_items) > 0 && $live_items[0]!=null  ){
            foreach ($live_items as $live_item) {
                PlanItem::create([
                    'plan_id' => $new_plan->id
                    ,'type' => 3
                    ,'item_id' => $live_item
                ]);
            }
        }

//        History::create([
//            'gallery_id' => $id
//            ,'user_id' => auth()->user()->id
//            ,'action' => "Gallery Edited"
//        ]);

        return Redirect::to('planner')
            ->with('success','Great! Plan created successfully.');
    }


    public function edit(Plan $plan)
    {
        // abort_unless( auth()->user()->role == "admin",403);

        $data['plan'] = $plan;

        $data['categories'] =  Category::select('id','title')->orderBy('title','asc')->get();

        $data['videos'] =  Video::select('id','name')->orderBy('created_at','desc')->limit(20)->get();
        $data['photos'] =  Gallery::select('id','name')->orderBy('created_at','desc')->limit(20)->get();
        $data['texts'] =  Article::select('id','title')->orderBy('created_at','desc')->limit(20)->get();
        $data['lives'] =  Live::select('id','title')->orderBy('created_at','desc')->limit(20)->get();

        return view('plan.edit', $data);
    }


    public function update(Request $request, Plan $plan)
    {
        // abort_unless( auth()->user()->role == "admin",403);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'date' => 'required',
            'category' => 'present|nullable',

            'video' => 'present|nullable',
            'photo' => 'present|nullable',
            'text' => 'present|nullable',
            'live' => 'present|nullable',

            'video_items' => 'nullable',
            'photo_items' => 'nullable',
            'text_items' => 'nullable',
            'live_items' => 'nullable',
        ]);

        $request = $request->all();

        unset($request['_token']);
        unset($request['_method']);
        // $update = ['title' => $request->title, 'description' => $request->description];
        //$live = Live::where('id',$id);

        // if( auth()->user()->type != "admin" ){
        //     abort_unless( auth()->user()->id == $live->first()->user_id,403);
        // }

        $plan->update($request);


        //replace categories
        $categories = request()->category;
        PlanCategory::where('plan_id',$plan->id)->delete();
        if(  sizeof($categories) > 0 && $categories[0]!=null   ){
            foreach ($categories as $category) {
                PlanCategory::create([
                    'plan_id' => $plan->id
                    ,'category_id' => $category
                ]);
            }
        }


        //create video items
        $video_items = request()->video_items;
        $plan->videoItems()->delete();
        if( sizeof($video_items) > 0 && $video_items[0]!=null  ){
            foreach ($video_items as $video_item) {
                PlanItem::create([
                    'plan_id' => $plan->id
                    ,'type' => 0
                    ,'item_id' => $video_item
                ]);
            }
        }

        //create photo items
        $photo_items = request()->photo_items;
        $plan->photoItems()->delete();
        if( sizeof($photo_items) > 0 && $photo_items[0]!=null  ){
            foreach ($photo_items as $photo_item) {
                PlanItem::create([
                    'plan_id' => $plan->id
                    ,'type' => 1
                    ,'item_id' => $photo_item
                ]);
            }
        }

        //create text items
        $article_items = request()->text_items;
        $plan->textItems()->delete();
        if( sizeof($article_items) > 0 && $article_items[0]!=null  ){
            foreach ($article_items as $article_item) {
                PlanItem::create([
                    'plan_id' => $plan->id
                    ,'type' => 2
                    ,'item_id' => $article_item
                ]);
            }
        }

        //create live items
        $live_items = request()->live_items;
        $plan->liveItems()->delete();
        if( sizeof($live_items) > 0 && $live_items[0]!=null  ){
            foreach ($live_items as $live_item) {
                PlanItem::create([
                    'plan_id' => $plan->id
                    ,'type' => 3
                    ,'item_id' => $live_item
                ]);
            }
        }

//        History::create([
//            'gallery_id' => $id
//            ,'user_id' => auth()->user()->id
//            ,'action' => "Gallery Edited"
//        ]);

        return Redirect::to('planner')
            ->with('success','Great! Plan updated successfully');
    }


    public function destroy(Plan $plan)
    {
        // abort_unless( auth()->user()->role == "admin",403);

        $plan->videoItems()->delete();
        $plan->photoItems()->delete();
        $plan->textItems()->delete();
        $plan->liveItems()->delete();
        $plan->delete();

//        History::create([
//            'gallery_id' => $id
//            ,'user_id' => auth()->user()->id
//            ,'action' => "Gallery Edited"
//        ]);

        return Redirect::to('planner')->with('success','Plan deleted successfully');
    }
}
