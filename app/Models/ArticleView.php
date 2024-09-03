<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleView extends Model
{
    use HasFactory;

	
	public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public static function create_log($article) {
        $article_view = new ArticleView();
        $article_view->article_id = $article->id;
        $article_view->user_id = (auth()->check())?auth()->id():null; 
        $article_view->ip = request()->ip();
        $article_view->agent = request()->header('User-Agent');
        $article_view->save();
    }


}
