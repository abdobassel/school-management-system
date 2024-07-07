<?php

namespace App\Http\Livewire;

use App\Degree;
use App\QuesetionQ;
use Livewire\Component;

class ShowQuestion extends Component
{

    public $quizze_id, $student_id, $data;
    public $counter = 0;
    public $q_count = 0;


    public function render()
    {
        $this->data =  QuesetionQ::where('quize_id', $this->quizze_id)->get();
        $this->q_count = $this->data->count();
        //dd($this->data);
        return view('livewire.show-question', ['data']);
    }
    public function nextQuestion($question_id, $score, $answer, $right_answer)
    {
        $student_degree = Degree::where('student_id', $this->student_id)
            ->where('quizze_id', $this->quizze_id)
            ->first();

        if ($student_degree == null) {
            $degree = new Degree();
            $degree->quizze_id = $this->quizze_id;
            $degree->student_id = $this->student_id;
            $degree->question_id = $question_id;
            $degree->score = (strcmp(trim($answer), trim($right_answer)) === 0) ? $score : 0;
            $degree->date = date('Y-m-d');
            $degree->save();
        } else {
            if ($student_degree->question_id >= $this->data[$this->counter]->id) {
                $student_degree->score = 0;
                $student_degree->abuse = '1';
                $student_degree->save();
                toastr()->error('Detected cheating attempt!');
                return redirect()->route('studentExams.index');
            } else {
                $student_degree->question_id = $question_id;
                $student_degree->score += (strcmp(trim($answer), trim($right_answer)) === 0) ? $score : 0;
                $student_degree->save();
            }
        }

        if ($this->counter < $this->q_count - 1) {
            $this->counter++;
        } else {
            toastr()->success('Done with the exam!');
            return redirect()->route('studentExams.index');
        }
    }
}
