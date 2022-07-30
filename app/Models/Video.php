<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        	return $this->views
        	->where('ip', '=',  request()->ip())->exists();
    	}

    	return $this->views
        	->where('user_id', '=', (auth()->user()->id) )->exists();
    }
}
