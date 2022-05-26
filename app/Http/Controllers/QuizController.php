<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Inertia::render('Quiz/Index', [
            'quizes' => Quiz::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render('Quiz/Create', [
            'exams' => Exam::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string',
            'type' => 'required|string|in:mcq,blank',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'answere' => 'required|string',

            'exam_id' => 'string'
        ]);

        Quiz::create([
            'title' => $request->title,
            'type' => $request->type,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'answere' => $request->answere,

            'exam_id' => $request->exam_id
        ]);

        return redirect('quizes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Inertia::render('Quiz/Show', [
            'quiz' => Quiz::find( $id )
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return Inertia::render('Quiz/Edit', [
            'quiz' => Quiz::find( $id )
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $quiz = Quiz::find( $id );

        $quiz->fill([
            'title' => $request->title,
            'type' => $request->type,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'answere' => $request->answere
        ]);

        $quiz->save();

        return redirect('quizes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $quiz = Quiz::find( $id );
        $quiz->delete();

        return redirect('quizes');
    }
}
