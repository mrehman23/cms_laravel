<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes;

    public function category() {
        return $this->hasOne(Categories::class,'id','category_id');
    }

    public function postTags()
    {
        return $this->belongsToMany(Tags::class)->withTimestamps();
    }

    public function createdBy() {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function updatedBy() {
        return $this->hasOne(User::class,'id','updated_by');
    }
}
