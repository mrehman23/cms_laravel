<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{

    public function createdBy() {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function updatedBy() {
        return $this->hasOne(User::class,'id','updated_by');
    }
}
