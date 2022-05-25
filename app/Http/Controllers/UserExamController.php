<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\UserExam;
use App\Models\UserExamQuiz;
use App\Models\Quiz;
use App\Models\User;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserExamController extends Controller
{
    /**
     * User attends the exam
     */
    public function attend($examId) {

        $userExam = null;
        if( !(UserExam::where(['user_id' => Auth::user()->id, 'exam_id' => $examId ])->exists()) ) {
            $userExam = UserExam::create([
                'user_id' => Auth::user()->id,
                'exam_id' => $examId,
                'started_at' => now()
            ]);
        }

        $userExam = UserExam::where(['exam_id' => $examId, 'user_id' => Auth::user()->id])->first();
        $exam = Exam::find($examId);

        $now = Carbon::now();
        $end_time = Carbon::parse($userExam->started_at)->addMinute($userExam->duration);
        
        // If time up show result page
        if( $now->greaterThan($end_time)) {
            return $this->getResultPage( $userExam, $exam );
        }

        // If all the question already answered return result page
        if( $exam->quizes->count() == $userExam->answeredQuizes()->count() ) {
            return $this->getResultPage( $userExam, $exam );
        }

        return Inertia::render('UserExam/SingleQuiz', [
            'started_at' => $userExam->started_at,
            'exam' => $exam,
            'quiz' => $this->getNextQuiz( $userExam, $exam )
        ]);
    }

    /**
     * Returns next quiz with route if no next quiz redirect to result page i.e. submit page
     */
    public function nextQuiz(Request $request, $examId, $quizId ) {

        $exam = Exam::find($examId);
        
        // Get attended exam info
        $userExam = UserExam::where(['exam_id' => $examId, 'user_id' => Auth::user()->id])->first();

        // If time exceeds discard currently answered quiz and show result
        $now = Carbon::now();
        $end_time = Carbon::parse($userExam->started_at)->addMinute($userExam->duration);
        
        // If time up show result page
        if( $now->greaterThan($end_time)) {
            return $this->getResultPage( $userExam, $exam );
        }

        // Get submitted quiz info
        $quiz = Quiz::find( $quizId );
        $userAnswere = $quiz->type == 'mcq' ? $request->checked_value : $request->answere;

        // Add submitted quiz to the answered quiz list
        if( !UserExamQuiz::where(['user_exam_id' => $userExam->id,'quiz_id' => $quizId])->exists() ) {
            UserExamQuiz::create([
                'user_exam_id' => $userExam->id,
                'quiz_id' => $quizId,
                'user_answere' => $userAnswere
            ]);
        }

        // Get next Quiz for this user exam
        $nextQuiz = $this->getNextQuiz($userExam, $exam);

        if( $nextQuiz != null ) {
            return Inertia::render('UserExam/SingleQuiz', [
                'started_at' => $userExam->started_at,
                'exam' => Exam::find($examId),
                'quiz' => $nextQuiz
            ]);
        } else {
            // return redirect('exams/'.$examId.'/submit');
            return $this->getResultPage( $userExam, $exam );
        }
    }

    /**
     * Get the Next Unanswered Quiz under Current Exam
     */
    protected function getNextQuiz( $userExam, $exam ) {
        if( $exam->quizes->count() > 0 ) {
            return $exam->quizes
                            ->whereNotIn('id', $userExam->answeredQuizes->map(function ( $record ) {
                                return $record->quiz_id;
                            }))
                            ->first();
        } else {
            return null;
        }
    }

    /**
     * Return result page with appropriate data
     */
    protected function getResultPage( $userExam, $exam ) {
        return Inertia::render('UserExam/Result', [
            'result' => $this->getCalculatedResult( $userExam, $exam )
        ]);
    }

    /**
     * Generate Result Object
     */
    private function getCalculatedResult( $userExam, $exam ) {

        $rightCount = 0;
        $wrongCount = 0;
        $unansweredCount = 0;
        $obtainedMark = 0;
        // $rightCount = $userExam->answeredQuizes
        //                         ->reduce( function( $result, $aQuiz ) {
        //                             $quiz = Quiz::find($aQuiz->quiz_id);
        //                             if( $aQuiz->user_answere == $quiz->answere ) {                                        
        //                                 return ++$result;
        //                             }

        //                             return $result;
        //                         }, 0);

        foreach( $userExam->answeredQuizes as $answeredQuiz ) {
            if( $answeredQuiz->user_answere == Quiz::find( $answeredQuiz->quiz_id )->answere ) {
                $rightCount++;
            } else {
                $wrongCount++;
            }
        }

        $unansweredCount = $exam->quizes->count() - $userExam->answeredQuizes->count();

        if( $exam->has_negative_marking ) {
            $obtainedMark = ($rightCount * 2) - ($wrongCount * $exam->negative_mark_rate);
        } else {
            $obtainedMark = ($rightCount * 2);
        }

        return [
            'answered' => $userExam->answeredQuizes->count(),
            'right' => $rightCount,
            'wrong' => $wrongCount,
            'unanswered' => $unansweredCount,
            'obtained_mark' => $obtainedMark < 0 ? 0 : $obtainedMark
        ];
    }

}
