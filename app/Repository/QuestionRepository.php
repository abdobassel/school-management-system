<?php


namespace App\Repository;

use App\Quize;
use App\QuesetionQ;

use App\Repository\QuestionRepositoryInterface;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function index()
    {
        $questions = QuesetionQ::all();
        return view('pages.questions.index', compact('questions'));
    }

    public function create()
    {
        $quizzes = Quize::get();
        return view('pages.questions.create', compact('quizzes'));
    }

    public function store($request)
    {
        try {
            $question = new QuesetionQ();
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quize_id = $request->quizze_id;
            $question->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('questions.create');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $question = QuesetionQ::findorfail($id);
        $quizzes = Quize::get();
        return view('pages.questions.edit', compact('question', 'quizzes'));
    }

    public function update($request)
    {
        try {
            $question = QuesetionQ::findorfail($request->id);
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quize_id = $request->quizze_id;
            $question->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('questions.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            QuesetionQ::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
