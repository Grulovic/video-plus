<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
			// 'user_id',
			// 'category_id',

			// 'name',
			// 'description',
    		'gallery_id',
			'mime',
			'file_name',
			'original_file_name'
		];

	public function history() {
		return $this->hasMany(History::class);
	}

	public function categories() {
		return $this->hasMany(PhotoCategory::class);
	}

	public function gallery(){
        return $this->belongsTo(User::class);
    }

}
