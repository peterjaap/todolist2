<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
