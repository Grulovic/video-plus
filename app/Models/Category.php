<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
		'user_id',
		'title',
		'description',
	];

    public function latestVideos() {
        return $this->belongsToMany(Video::class,VideoCategory::class,'category_id','video_id')
            ->orderBy('id', 'desc')->with(['history','categories','categories.category','user','views'])->limit(4);
    }

    public function videos() {
		return $this->hasMany(VideoCategory::class);
	}

	public function galleries() {
		return $this->hasMany(GalleryCategory::class);
	}

	public function user(){
        return $this->belongsTo(User::class);
    }
}
