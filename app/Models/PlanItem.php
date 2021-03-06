<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'type',
        'item_id',
    ];

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function getItem(){

        if($this->type == 0){
            return $this->belongsTo(Video::class,'item_id');
        }
        else if($this->type == 1){
            return $this->belongsTo(Gallery::class,'item_id');
        }
        else if($this->type == 2){
            return $this->belongsTo(Article::class,'item_id');
        }
        else if($this->type == 3){
            return $this->belongsTo(Live::class,'item_id');
        }
    }

}
