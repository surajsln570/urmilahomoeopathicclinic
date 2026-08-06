<?php

// namespace App\Modules\Auth\Models;

// use Illuminate\Database\Eloquent\Model;

// class User extends Model

namespace App\Modules\Auth\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Modules\Auth\Models\Role;

class User extends Authenticatable
{
    //
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'password',
        'role_id'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
