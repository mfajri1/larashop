<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelBook extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = "books";

    public function modelCategory(){
       return $this->belongsToMany('App\Models\ModelCategory');
    }


}
