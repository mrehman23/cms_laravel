<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function posts() {
        return $this->hasMany(Posts::class,'category_id');
    }

    public function createdBy() {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function updatedBy() {
        return $this->hasOne(User::class,'id','updated_by');
    }
}
