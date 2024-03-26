<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;
    public $timestamps = false; //tell Laravel not to save timestamps
    protected $table = 'category_post'; //point to table name (singular instead of plural)
    protected $fillable = ['category_id', 'post_id']; //for create() function later

    //category_Post belongs to category
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
