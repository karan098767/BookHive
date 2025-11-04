<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅

class Borrow extends Model
{
    use HasFactory; // ✅

    protected $fillable = [
        'book_id','member_id','issue_date','due_date','date_returned','late_fee'
    ];

    protected $dates = ['issue_date','due_date','date_returned'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
