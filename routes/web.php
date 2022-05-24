<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserExamController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

// ================== EXAM Routes

    
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resources([
        'exams' => ExamController::class,
        'quizes' => QuizController::class,
    ]);
});

// Exam Custom Routes
Route::get('/exams/{id}/quizes/create', [ExamController::class, 'addQuiz']);

// User exam routes
Route::post('/exams/{id}/attend', [UserExamController::class, 'attend' ]);
Route::post('/exams/{examId}/quizes/{quizId}', [UserExamController::class, 'nextQuiz' ]);
// Route::post('/exams/{id}/submit', [UserExamController::class, 'submit'])->name('userExam.result');