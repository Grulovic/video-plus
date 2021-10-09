<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

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

    public function inFavorite(){
        $user_id = Auth::id();
        $plan_id = $this->id;

        $existing_favorite = UserPlan::where('plan_id',$plan_id)->where('user_id',$user_id)->get();

        if( sizeof($existing_favorite) > 0){
            return true;
        }else{
            return false;
        }
    }

}
