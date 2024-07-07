<div>

    <div>
        <div class="card card-statistics mb-30">
            <div class="card-body">
                <h4 class="card-title"> {{ $data[0]->answers }}</h4>
                @foreach (preg_split('/(-)/', $data[$counter]->answers) as $index => $answer)
                    <div class="custom-control custom-radio">
                        <input type="radio" name="customRadio" id="customRadio{{ $index }}"
                            class="custom-control-input">
                        <label class="custom-control-label" for="customRadio{{ $index }}"
                            wire:click="nextQuestion({{ $data[$counter]->id }},{{ $data[$counter]->score }},'{{ $answer }}','{{ $data[$counter]->right_answer }}')">{{ $answer }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
