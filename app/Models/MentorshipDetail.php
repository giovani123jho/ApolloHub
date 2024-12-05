<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorshipDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentorship_id',
        'content',
        'mentoring_date',
        'meeting_link',
    ];

    public function mentorship()
    {
        return $this->belongsTo(Mentorship::class);
    }
}
