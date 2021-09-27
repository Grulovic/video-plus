<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoView extends Model
{
    use HasFactory;

	
	public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public static function create_log($video) {
        $video_view = new VideoView();
        $video_view->video_id = $video->id;
        $video_view->user_id = (auth()->check())?auth()->id():null; 
        $video_view->ip = request()->ip();
        $video_view->agent = request()->header('User-Agent');
        $video_view->save();
    }


}
