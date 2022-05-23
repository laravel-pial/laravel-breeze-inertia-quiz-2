<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExamQuiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_exam_id',
        'quiz_id',
        'user_answere'
    ];

    /**
     * Returns the ExamUser modal this quiz belongs to
     */
    public function userExam() {
        return $this->belongsTo(ExamUser::class, 'user_exam_id', 'id');
    }
}
