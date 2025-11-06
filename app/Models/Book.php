<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn','title','author_id','genre','published_date','copies','status','pdf_link','total_borrow_count'
    ];

    protected $dates = ['published_date'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
