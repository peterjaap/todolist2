<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'done', 'category_id'];

    protected $attributes = [
        'done' => false,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
