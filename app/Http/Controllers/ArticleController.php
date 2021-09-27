<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\ArticleCategory;
use App\Models\ArticleView;
use App\Models\User;
use App\Models\History;

use Illuminate\Http\Request;
use Redirect;

class ArticleController extends Controller
{
     public function __construct(){
     	$this->authorizeResource(Article::class, 'article');
    }
    
    public function index()
    {
        
        $data['articles'] = $this->search()->paginate(20);
        $data['users'] =  User::select('id','name')->orderBy('id','asc')->get();
        $data['categories'] =  Category::select('id','title')->orderBy('title','asc')->get();
    
        return view('article.index',$data);
    }
    

    public function create()
    {
        
        $data['categories'] =  Category::select('id','title')->orderBy('title','asc')->get();
    
        return view('article.create',$data);
    }
   

    public function store(Request $request)
    {   

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'present|nullable',
        ]);
    
    	$categories = request()->category;
        
        $request = $request->all();
        unset($request['_token']);
        unset($request['_method']);
        unset($request['category']);
        $request['user_id'] = auth()->user()->id;
        

        $new_article = Article::create($request);
    
    	if( sizeof($categories) > 0 && $categories[0]!=null  ){
            foreach ($categories as $category) {
                ArticleCategory::create([
                                        'article_id' => $new_article->id
                                        ,'category_id' => $category
                                    ]);
            }
        }
    	
    	
    	// History::create([
    	// 'gallery_id' => $new_gallery->id
    	// ,'user_id' => auth()->user()->id
    	// ,'action' => "Gallery Uploaded"
    	// ]);
    
        return Redirect::to('articles')
       ->with('success','Greate! Article created successfully.');
    }
    

    public function show( Article $article)
    {
        
        $where = array('id' => $article->id);
        $data['article'] = $article;

        
    	foreach($data['article']->categories as $key => $article ){
            $current_article_tags[$key] = $article->category->id;
        }
        
    
    	//create view
    	if( !$data['article']->viewed_before() ){
        	ArticleView::create_log($data['article']);
        }
    

       if( isset($current_article_tags) ){
       
            $data['related'] = Article::whereHas('categories', function($q) use ($current_article_tags) {
                $q->whereIn('category_id', $current_article_tags);
            })
            ->where('id', '!=' , $article->id)
            ->orderBy('created_at','desc')
            ->take(4)
            ->get();
       }else{
           $data['related'] = Article::orderBy('created_at','desc')
           ->where('id', '!=' , $article->id)
            ->take(4)
            ->get();
       }
    
    
 
        return view('article.show', $data);
    }
    

    public function edit(Article $article)
    {   
        
        $where = array('id' => $article->id);
        $data['article'] = $article;
        $data['categories'] =  Category::select('id','title')->orderBy('title','asc')->get();
    
        

        return view('article.edit', $data);
    }
   

    public function update(Request $request, Article $article)
    {
        
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'present|nullable',
        ]);
        
        $categories = request()->category;
    	
    	   if(  sizeof($categories) > 0 && $categories[0]!=null   ){

            ArticleCategory::where('article_id',$article->id)->delete();

            foreach ($categories as $category) {
                ArticleCategory::create([
                                        'article_id' => $article->id
                                        ,'category_id' => $category
                                    ]);
            }
        }
    
        $request = $request->all();
        unset($request['_token']);
        unset($request['_method']);
        unset($request['category']);
        // $update = ['title' => $request->title, 'description' => $request->description];
        // $article = Article::where('id',$article->id);

 		// History::create([
 		// 'gallery_id' => $id
 		// ,'user_id' => auth()->user()->id
 		// ,'action' => "Gallery Edited"
 		// ]);


        $article->update($request);
    
        return Redirect::to('articles')
       ->with('success','Great! Article updated successfully');
    }
   

    public function destroy(Article $article)
    {
		
    	ArticleCategory::where('article_id',$article->id)->delete();
    	ArticleView::where('article_id',$article->id)->delete();
    	
        if( auth()->user()->role != "admin" ){
            abort_unless( auth()->user()->id == $article->first()->user_id,403);
        }

        $article->delete();
   
        return Redirect::to('articles')->with('success','Article deleted successfully');
    }

	

     public function search(){
        
   
        if(request()->sort == "new" || request()->sort == null){
            $articles = Article::orderBy('id','desc');
        }else{
            $articles = Article::orderBy('id','asc');
        }

        

        if(isset(request()->search)){
            // var_dump(request()->search);
            // var_dump($galleries->get()->all());
            $articles->where(function($query){
                    $query->where('title', 'like', '%'.request()->search.'%')
                        ->orWhere('description', 'like', '%'.request()->search.'%')
                        ->orWhereHas('user', function($query){ 
                            $query->where('name', 'like', '%'.request()->search.'%');
                        });
                   }) ;

            // var_dump($galleries->get()->all());
        }

        if(isset(request()->user)){
            
            $articles->where(function($query){
                    $query
                        ->where('user_id', request()->user);
                    })
                    ;

        }

        if(isset(request()->from_date)){
            
            $articles->where(function($query){
                    $query
                        ->where('created_at',">=", request()->from_date);
                    })
                    ;

        }

        if(isset(request()->category)){
            
            $articles->where(function($query){
                    $query
                        ->whereHas('categories', function($query){ 
                            $query->where('category_id', request()->category);
                        });
                    })
                    ;
        }
        
        return $articles;
    }



}
