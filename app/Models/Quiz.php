<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'option_a',
        'option_b',
        'option_c',
        'answere'
    ];

    /**
     * Returns the exam this quiz belongs to
     */
    public function exam() {
        return $this->belongsTo(Exam::class);
    }
}
