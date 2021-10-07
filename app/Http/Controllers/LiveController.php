<?php

namespace App\Http\Controllers;

use App\Models\Live;
use App\Models\PlanItem;
use Illuminate\Http\Request;
use Redirect;

class LiveController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Live::class, 'live');
    }

    public function index()
    {
        // abort_unless( auth()->user()->role == "admin",403);

        $data['lives'] = Live::orderBy('id','desc')->paginate(10);

        return view('live.list',$data);
    }


    public function create()
    {
        // abort_unless( auth()->user()->role == "admin",403);

        return view('live.create');
    }


    public function store(Request $request)
    {
        // abort_unless( auth()->user()->role == "admin",403);

        // var_dump($request->all());


        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'required',
            'featured' => 'required',
//            'youtube' => 'required'
        ]);

        $request = $request->all();
        unset($request['_token']);
        unset($request['_method']);
        $request['user_id'] = auth()->user()->id;

        $youtube_url = null;
        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $request['url'], $youtube_url);

//        dd($youtube_url[0][0]);

        parse_str( parse_url( $youtube_url[0][0], PHP_URL_QUERY ), $my_array_of_vars );
        dd($my_array_of_vars);
        $request['url'] =  'https://www.youtube.com/embed/'.$my_array_of_vars['v'];



        Live::create($request);

        return Redirect::to('lives')
       ->with('success','Greate! Live created successfully.');
    }


    public function show(Live $live)
    {
        // abort_unless( auth()->user()->role == "admin",403);

        $data['live'] = $live;

        // if( auth()->user()->type != "admin" ){
        //     abort_unless( auth()->user()->id == $data['live']->user_id,403);
        // }

        return view('live.show', $data);
    }


    public function edit(Live $live)
    {
        // abort_unless( auth()->user()->role == "admin",403);

        // $where = array('id' => $id);
        $data['live'] = $live;

        // if( auth()->user()->type != "admin" ){
        //     abort_unless( auth()->user()->id == $data['live']->user_id,403);
        // }



        return view('live.edit', $data);
    }


    public function update(Request $request, Live $live)
    {
        // abort_unless( auth()->user()->role == "admin",403);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'required',
            'featured' => 'required',
        ]);

        $request = $request->all();
        unset($request['_token']);
        unset($request['_method']);
        // $update = ['title' => $request->title, 'description' => $request->description];
        //$live = Live::where('id',$id);

        // if( auth()->user()->type != "admin" ){
        //     abort_unless( auth()->user()->id == $live->first()->user_id,403);
        // }



        $live->update($request);

        return Redirect::to('lives')
       ->with('success','Great! Live updated successfully');
    }


    public function update_featured(Request $request, Live $live)
    {
        // abort_unless( auth()->user()->role == "admin",403);

        $request->validate([
            'featured' => 'required',
        ]);

        $request = $request->all();
        unset($request['_token']);
        unset($request['_method']);
        // $update = ['title' => $request->title, 'description' => $request->description];
        // $live = Live::where('id',$id);

        // if( auth()->user()->type != "admin" ){
        //     abort_unless( auth()->user()->id == $live->first()->user_id,403);
        // }

        $live->update($request);

        return Redirect::to('lives')
       ->with('success','Great! Live updated successfully');
    }



    public function destroy(Live $live)
    {
        // abort_unless( auth()->user()->role == "admin",403);

        // $live = Live::where('id',$id);

        $planner_items = PlanItem::where('type',3)->where('item_id',$live->id)->delete();

        $live->delete();

        return Redirect::to('lives')->with('success','Live deleted successfully');
    }


}
