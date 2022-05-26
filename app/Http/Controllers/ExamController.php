<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Inertia::render('Exam/Index', [
            'exams' => Exam::all()
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
        return Inertia::render('Exam/Create');
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
            'duration' => 'required|numeric',
            'mark' => 'required|numeric',
            'negative_mark_rate' => 'required|numeric',
            'no_of_quizes' => 'required|numeric',
        ]);

        Exam::create([
            'title' => $request->title,
            'duration' => $request->duration,
            'mark' => $request->mark,
            'has_negative_marking' => $request->has_negative_marking,
            'negative_mark_rate' => $request->negative_mark_rate,
            'no_of_quizes' => $request->no_of_quizes,
        ]);

        return redirect('exams');

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
        return Inertia::render('Exam/Show', [
            'exam' => Exam::find( $id )
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
        return Inertia::render('Exam/Edit', [
            'exam' => Exam::find( $id )
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
        $exam = Exam::find( $id );
        $exam->fill([
            'title' => $request->title,
            'duration' => $request->duration,
            'mark' => $request->mark,
            'has_negative_marking' => $request->has_negative_marking,
            'negative_mark_rate' => $request->negative_mark_rate,
            'no_of_quizes' => $request->no_of_quizes,
        ]);

        $exam->save();

        return redirect('exams');
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
        $exam = Exam::find( $id );
        $exam->delete();

        return redirect('exams');
    }

    /**
     * Returns View to Add quiz to this exam
     */
    public function addQuiz( $id ) {
        // If all the quizes for the exam added already then redirect to exam list page
        $exam = Exam::find( $id );
        if( $exam->quizes->count() >= $exam->no_of_quizes ) {
            return redirect('exams');
        }

        return Inertia::render('Quiz/Create', [
            'exam' => Exam::find( $id )
        ]);
    }
}
