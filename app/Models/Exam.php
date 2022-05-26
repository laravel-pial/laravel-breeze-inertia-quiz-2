<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'duration',
        'mark',
        'has_negative_marking',
        'negative_mark_rate',
        'no_of_quizes'
    ];

    /**
     * Get All the users those attended this exam
     */
    public function users() {
        return $this->belongsToMany(User::class, 'user_exams');
    }

    /**
     * Returns all the quizes of this exam
     */
    public function quizes() {
        return $this->hasMany(Quiz::class);
    }
}
