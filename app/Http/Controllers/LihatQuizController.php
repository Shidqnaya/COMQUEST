<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\User;
use App\Models\Matkul;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class LihatQuizController extends Controller
{
    public function index(Matkul $matkul, Bab $bab)
    {
        $user = Auth::user();
        $quizzes = $bab->quizzes;
        return view('user.lihatquiz', compact('matkul','bab', 'quizzes','user'));
    }

    public function attempt(Matkul $matkul, Bab $bab, Quiz $quiz)
    {
        $user = Auth::user();
        $questions = $quiz->questions;
        return view('user.quizpage', compact('matkul','bab','quiz','user','questions'));
    }

    public function submit(Request $request, Matkul $matkul, Bab $bab, Quiz $quiz)
    {
        // Ambil jawaban dari request
        $ans = $request->answers;
        $user = Auth::user();
        $questions = $quiz->questions;

        // Hitung skor dan balance berdasarkan jawaban yang benar
        $score = 0;
        foreach ($ans as $key => $value) {
            $dValue = json_decode($value, true);
            if ($dValue['is_correct'] == "1") {
                $score += 100;
            }
        }
        $balance = $score;

        // Update skor dan balance user
        $user->score += $score;
        $user->balance += $balance;
        $user->save(); // Pastikan perubahan disimpan ke database
        //return dd($ans, $score, $balance);

        // Redirect ke rute review tanpa score dan balance di URL
        return view('user.quizend', compact('matkul', 'bab', 'quiz', 'user', 'questions', 'score', 'balance', 'ans'));
    }

}
