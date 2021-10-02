<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'date',
        'description',
        'location',
        'video',
        'photo',
        'text',
        'live',
    ];

    public function categories() {
        return $this->hasMany(PlanCategory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(PlanItem::class);
    }

    public function videoItems(){
        return $this->items()->where('type',0);
    }

    public function photoItems(){
        return $this->items()->where('type',1);
    }

    public function textItems(){
        return $this->items()->where('type',2);
    }

    public function liveItems(){
        return $this->items()->where('type',3);
    }

}
