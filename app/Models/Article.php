<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
		'user_id',
		'title',
		'description',
	];

	public function categories() {
		return $this->hasMany(ArticleCategory::class);
	}

	public function user(){
        return $this->belongsTo(User::class);
    }

	public function views() {
		return $this->hasMany(ArticleView::class);
	}

	public function view_num(){
    	return $this->views()->count();
    }

	public function viewed_before()
	{
    	if(auth()->id()==null){
        	return $this->views()
        	->where('ip', '=',  request()->ip())->exists();
    	}

    	return $this->views()
        	->where('user_id', '=', (auth()->user()->id) )->exists();
    }

}
