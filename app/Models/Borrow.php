<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'member_id',
        'issue_date',
        'due_date',
        'date_returned',
        'late_fee',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'date_returned' => 'date',
    ];

    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class);
    }

    public function member()
    {
        return $this->belongsTo(\App\Models\Member::class);
    }
}
