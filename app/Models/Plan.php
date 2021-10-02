<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
        return $this->belongsTo(PlanItem::class);
    }

    public function videoItems(){
        return $this->items()->where('type',0)->get();
    }

    public function photoItems(){
        return $this->items()->where('type',1)->get();
    }

    public function textItems(){
        return $this->items()->where('type',2)->get();
    }

    public function liveItems(){
        return $this->items()->where('type',3)->get();
    }

}
