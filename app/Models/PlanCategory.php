<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'plan_id',

    ];


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }


}
