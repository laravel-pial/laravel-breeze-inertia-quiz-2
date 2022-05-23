<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\UserExam;
use App\Models\UserExamQuiz;
use App\Models\Quiz;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserExamController extends Controller
{
    //
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

        return Inertia::render('UserExam/SingleQuiz', [
            'started_at' => $userExam->started_at,
            'exam' => Exam::find($examId),
            'quiz' => Quiz::all()->where('exam_id', $examId)->first()
        ]);
    }

    /**
     * Returns next quiz with route if no next quiz redirect to result page i.e. submit page
     */
    public function nextQuiz(Request $request, $examId, $quizId ) {

        $exam = Exam::find($examId);
        $userExam = UserExam::where(['exam_id' => $examId, 'user_id' => Auth::user()->id])->first();
        $userExamId = $userExam->id;
        $quiz = Quiz::find( $quizId );
        $userAnswere = $quiz->type == 'mcq' ? $request->checked_value : $request->answere;

        UserExamQuiz::create([
            'user_exam_id' => $userExamId,
            'quiz_id' => $quizId,
            'user_answere' => $userAnswere
        ]);

        // dd([
        //     'exam_user' => $userExam,
        //     'quizes' => $userExam->quizes,
        //     'ex_quizes' => Exam::find($examId)->quizes(),
        //     'quiz_par_exam' => Exam::find($examId)->quizes()->first()->exam->title,
        // ]);

        // Get next Quiz for this user exam
        $nextQuiz = null;

        dd([
            // 'quiz_ids' => $userExam->quizes->map( function( $record ) {
            //     return $record->id;
            // })
            'nex_quiz' => $exam->quizes
                                ->whereNotIn( 'id', $userExam->quizes->map( function( $record ) {
                                    return $record->id;
                                })),
            'quiz_ids' => [1]
        ]);

        if( $userExam->quizes->count() > 0 ) {
            $nextQuiz = $exam->quizes->first();
        } else {
            $nextQuiz = $exam->quizes->first();
        }
        dd($nextQuiz);

        if( $nextQuiz != null ) {
            return Inertia::render('UserExam/SingleQuiz', [
                'started_at' => $userExam->started_at,
                'exam' => Exam::find($examId),
                'quiz' => $nextQuiz
            ]);
        } else {
            return redirect('exams/'.$examId.'/');
        }
    }

    public function submit(Request $request, $examId) {
        return response()->json([
            'examId' => $examId,
            'req_body' => $request->body,
            'result' => 'result'
        ]);
    }
}
