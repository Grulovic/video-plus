<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
			'user_id',
			'video_id',
            // 'photo_id',
            'gallery_id',
            'plan_id',

			'action'
		];

	public function user(){
        return $this->belongsTo(User::class);
    }

    public function video(){
        return $this->belongsTo(Video::class);
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    // public function photo(){
    //     return $this->belongsTo(Gallery::class);
    // }
}
