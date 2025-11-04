<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ add this

class Admin extends Authenticatable
{
    use HasFactory, Notifiable; // ✅ include HasFactory here

    protected $fillable = [
        'first_name','last_name','email','password','is_active',
    ];

    protected $hidden = ['password'];
}
