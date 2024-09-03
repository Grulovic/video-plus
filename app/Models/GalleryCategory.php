<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $fillable = [
		'category_id',
		'gallery_id',
		
	];


	public function category(){
        return $this->belongsTo(Category::class);
    }	

	public function gallery(){
        return $this->belongsTo(Photo::class);
    }

}
