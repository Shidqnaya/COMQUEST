<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\Quiz;
use App\Models\Question;
use illuminate\Support\Facades\Auth;

class KuisController extends Controller
{
    public function create(Bab $bab)
    {
        $user = Auth::user();
        return view('admin.quizform', compact('user','bab'));
    }

    public function store(Request $request, Bab $bab)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $bab->quizzes()->create($request->all());
        return back()->with('success', 'Quiz created successfully.');
    }

    public function addSoal(Bab $bab, Quiz $quiz)
    {
        $user = Auth::user();
        $matkul = $bab->matkul;
        
        return view('admin.soalform', compact('user','bab', 'matkul', 'quiz'));
    }

    public function update(Request $request, Bab $bab, Quiz $quiz)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $quiz->update($request->all());
        return redirect()->route('admin.quiz.create', $bab->matkul_id)->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Bab $bab, Quiz $quiz)
    {
        $quiz->delete();
        return back()->with('success', 'Quiz deleted successfully.');
    }
}
