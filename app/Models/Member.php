<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name','last_name','phone_number','email','password','dob','total_books_borrowed','is_active',
    ];

    protected $hidden = ['password'];

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    public function borrowings()
{
    return $this->hasMany(\App\Models\Borrow::class, 'member_id');
}

}
