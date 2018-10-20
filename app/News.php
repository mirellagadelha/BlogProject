<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title','body','category','author', 'keywords'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'news';
}
