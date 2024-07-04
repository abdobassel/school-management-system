<?php

namespace App\Http\Controllers\Teacher;

use App\Quize;
use App\QuesetionQ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsTeacherController extends Controller
{
    public function show($id)
    {

        $quizz_id = $id;
        $quizz = Quize::findOrFail($quizz_id);

        return view('pages.teachers.questions.create', compact('quizz_id', 'quizz'));
    }

    public function store(Request $request)
    {
        try {
            $question = new QuesetionQ();
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quize_id = $request->quizz_id;
            $question->save();
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $question = QuesetionQ::findorfail($id);

        return view('pages.teachers.questions.edit', compact('question'));
    }

    public function update(Request $request)
    {
        try {
            $question = QuesetionQ::findorfail($request->id);
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;

            $question->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('questionTeacher.show');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            QuesetionQ::destroy($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
