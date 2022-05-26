<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_id',
        'started_at'
    ];

    /**
     * Returns All the quizes this started exam has with users answere
     */
    public function answeredQuizes() {
        return $this->hasMany(UserExamQuiz::class, 'user_exam_id', 'id');
    }
}
