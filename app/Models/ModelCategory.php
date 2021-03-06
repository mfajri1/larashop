<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelCategory extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = "category";

    public function modelBook(){
       return $this->belongsToMany('App\Models\ModelBook');
    }
}
