<?php

namespace App\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = ['name'];

    public function user(){
        return $this->hasMany(User::class);
    }
}
