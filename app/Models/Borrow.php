<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
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
