<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    protected $fillable = [
        'first_name','last_name','phone_number','email','password','dob','total_books_borrowed','is_active',
    ];

    protected $hidden = ['password'];

    public function borrowings()
    {
        return $this->hasMany(Borrow::class);
    }
}
