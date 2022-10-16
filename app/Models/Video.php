<?php

namespace App\Models;

use App\Consts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
			'user_id',
			// 'category_id',

			'name',
			'description',
			'mime',
			'size',
			'file_name',
			'original_file_name',
			'location',
			'thumbnail',
			'session_id',
			'progress',
			'runtime'
		];

	public function history() {
		return $this->hasMany(History::class);
	}

	public function categories() {
		return $this->hasMany(VideoCategory::class);
	}

	public function user(){
        return $this->belongsTo(User::class);
    }

	public function views() {
		return $this->hasMany(VideoView::class);
	}

	public function view_num(){
    	return $this->views->count();
    }

	public function viewed_before()
	{
    	if(auth()->id()==null){
        	return (bool) $this->views
        	->where('ip', '=',  request()->ip())->first();
    	}

    	return (bool) $this->views
        	->where('user_id', '=', (auth()->user()->id) )->first();
    }


    public function getIsBreakingNewsAttribute() : bool
    {
        $has_breaking_category = false;
        $categories = $this->categories;
        if( sizeof($categories) > 0 ){
            $has_breaking_category = $categories->where('category_id',Consts::BreakingNewsCategory)->first();
        }

        return (bool) $has_breaking_category;
    }
}
