<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
class SoalController extends Controller
{
    public function store(Request $request, Bab $bab, Quiz $quiz)
    {
        // return dd($request->all());
        $data =(
            [
                'question' => $request->question,
                'quiz_id' => $quiz->id
            ]
        );

        // return dd($request , $bab, $quiz);

        $quiz->questions()->create($data);

        return back()->with('success', 'Soal created successfully.');
    }

    public function addopsi(Request $request, $questionid)
    {
        $question = Question::find($questionid);
        $data =(
            [
                'question_id' => (int)$questionid,
                'answer' => $request->answer,
                'is_correct' =>(int) $request->is_correct
            ]
        );
        // return dd($data, $questionid);

        $question->answers()->create($data);

        return back()->with('success', 'Jawaban created successfully.');
    }

    public function destroy(Bab $bab, Quiz $quiz, Question $question)
    {
        $question->delete();
        return back()->with('success', 'Soal deleted successfully.');
    }

    public function update(Request $request, Bab $bab, Quiz $quiz, Question $question)
    {
        // return dd($request->all());
        $request->validate([
            'question' => 'required|string|max:255',
        ]);
        $question['question'] = $request->question;

        $question->update();
        return back()->with('success', 'Soal updated successfully.');
    }

    public function destroyopsi(Bab $bab, Quiz $quiz, Question $question, Answer $answer)
    {
        $answer->delete();
        return back()->with('success', 'Jawaban deleted successfully.');
    }

    public function updateopsi(Request $request, Bab $bab, Quiz $quiz, Question $question, Answer $answer)
    {
        $request->validate([
            'answer' => 'required|string|max:255',
        ]);
        // return dd($request->all());

        $answer['answer'] = $request->answer;
        if($request->is_correct != null){
            $answer['is_correct'] = $request->is_correct;
        }

        $answer->update();
        return back()->with('success', 'Jawaban updated successfully.');
    }
}
