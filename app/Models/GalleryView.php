<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryView extends Model
{
    use HasFactory;
	
	protected $table = 'gallery_views';
	
	public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public static function create_log($gallery) {
        $gallery_view = new GalleryView();
        $gallery_view->gallery_id = $gallery->id;
        $gallery_view->user_id = (auth()->check())?auth()->id():null; 
        $gallery_view->ip = request()->ip();
        $gallery_view->agent = request()->header('User-Agent');
        $gallery_view->save();
    }


}
