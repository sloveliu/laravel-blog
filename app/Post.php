<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'category_id'];
    // 找到文章作者
    public function user()
    {
        // 在一對一中，屬於 App\User 這個 model
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        // 一篇文章屬於某個 Category
        return $this->belongsTo('App\Category');
    }
}
