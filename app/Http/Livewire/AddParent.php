<?php

namespace App\Http\Livewire;

use App\Blood;
use App\MyParent;
use App\Religion;
use App\Nationality;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class AddParent extends Component
{ //father
    public $currentStep = 1, $Email, $Password, $Name_Father, $Name_Father_en, $Job_Father, $Job_Father_en, $National_ID_Father, $Phone_Father, $Nationality_Father_id, $Blood_Type_Father_id, $Religion_Father_id, $Address_Father, $Passport_ID_Father;
    public $successMessage = '';
    // mother
    public $Name_Mother, $Name_Mother_en, $Job_Mother, $Job_Mother_en, $National_ID_Mother, $Phone_Mother, $Nationality_Mother_id, $Blood_Type_Mother_id, $Religion_Mother_id, $Address_Mother, $Passport_ID_Mother;


    // validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'Email' => 'required|email|unique:my_parents,email',
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my_parents,national_id_father',
            'Passport_ID_Father' => 'required|unique:my_parents,passport_id_father',
            'Phone_Father' => 'required|regex:/^([0-9\s\-\*\(\)]*)$/|min:10',
            'Blood_Type_Father_id' => 'required',
            'Nationality_Father_id' => 'required',
            'Address_Father' => 'required',
            'Religion_Father_id' => 'required',

        ]);
    }
    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => Nationality::all(),
            'Bloods' => Blood::all(),
            'Religions' => Religion::all(),
        ]);
    }


    public function  firstStepSubmit()
    {
        // father form validation
        $this->validate([
            'Email' => 'required|unique:my_parents,email',
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',

            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my_parents,national_id_father',
            'Passport_ID_Father' => 'required|unique:my_parents,passport_id_father',
            'Phone_Father' => 'required|regex:/^([0-9\s\-\*\(\)]*)$/|min:10',
            'Blood_Type_Father_id' => 'required',
            'Nationality_Father_id' => 'required',
            'Address_Father' => 'required',
            'Religion_Father_id' => 'required',
        ]);
        $this->currentStep = 2;
    }
    public function secondStepSubmit()
    {
        // mother form validation then nextstep page
        $this->validate([

            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'Job_Mother' => 'required',

            'Job_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my_parents,national_id_mother',
            'Passport_ID_Mother' => 'required|unique:my_parents,passport_id_mother',
            'Phone_Mother' => 'required|regex:/^([0-9\s\-\*\(\)]*)$/|min:10',
            'Blood_Type_Mother_id' => 'required',
            'Nationality_Mother_id' => 'required',
            'Address_Mother' => 'required',
            'Religion_Mother_id' => 'required',
        ]);
        $this->currentStep = 3;
    }

    public function submitForm()
    {
        //1 =>  insert 
        $My_Parent = new MyParent();
        $My_Parent->name_father = ['ar' => $this->Name_Father, 'en' => $this->Name_Father_en];
        $My_Parent->email = $this->Email;
        $My_Parent->password = Hash::make($this->Password);
        $My_Parent->phone_father = $this->Phone_Father;
        $My_Parent->national_id_father = $this->National_ID_Father;
        $My_Parent->job_father = $this->Job_Father;
        $My_Parent->passport_id_father = $this->Passport_ID_Father;
        $My_Parent->nationality_father_id = $this->Nationality_Father_id;
        $My_Parent->religion_father_id = $this->Religion_Father_id;
        $My_Parent->blood_father_id = $this->Blood_Type_Father_id;
        $My_Parent->address_father = $this->Address_Father;
        // mother
        $My_Parent->name_mother = ['ar' => $this->Name_Mother, 'en' => $this->Name_Mother_en];

        $My_Parent->phone_mother = $this->Phone_Mother;
        $My_Parent->job_mother = $this->Job_Mother;
        $My_Parent->national_id_mother = $this->National_ID_Mother;
        $My_Parent->passport_id_mother = $this->Passport_ID_Mother;
        $My_Parent->nationality_mother_id = $this->Nationality_Mother_id;
        $My_Parent->religion_mother_id = $this->Religion_Mother_id;
        $My_Parent->blood_mother_id = $this->Blood_Type_Mother_id;
        $My_Parent->address_mother = $this->Address_Mother;
        $My_Parent->save();

        $this->successMessage = trans('messages.success');
        $this->clearForm();
    }


    // clear form 
    public function clearForm()
    {
        $this->Phone_Father = '';
        $this->Email = '';
        $this->Job_Father = '';
        $this->Job_Mother = '';
        $this->Job_Father_en = '';
        $this->Job_Mother_en = '';
        $this->Password = '';
        $this->Passport_ID_Father = '';
        $this->Passport_ID_Mother = '';
        $this->Blood_Type_Father_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Nationality_Father_id = '';
        $this->Nationality_Mother_id = '';
        $this->Religion_Mother_id = '';
        $this->Religion_Father_id = '';
        $this->Name_Father = '';
        $this->Name_Father_en = '';
        $this->Name_Mother = '';
        $this->Name_Mother_en = '';
        $this->Address_Mother = '';
        $this->Phone_Mother = '';
        $this->Phone_Father = '';
        $this->Address_Father = '';
    }
    public function firstStepSubmit_edit()
    {
    }
    public function back($step)
    {
        $this->currentStep = $step;
    }
    public function secondStepSubmit_edit()
    {
    }
}
/*

  @if ($catchError)
        <div class="alert alert-danger" id="success-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $catchError }}
        </div>
    @endif


    @if ($show_table)
        @include('livewire.Parent_table')
    @else

     @if ($updateMode)
            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="secondStepSubmit_edit"
                type="button">{{ trans('Parent_trans.Next') }}
            </button>
        @else
            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button"
                wire:click="secondStepSubmit">{{ trans('Parent_trans.Next') }}</button>
        @endif


//addparnetblade
          @if ($updateMode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="submitForm_edit"
                        type="button">{{ trans('Parent_trans.Finish') }}
                    </button>
                @else
                    <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                        type="button">{{ trans('Parent_trans.Finish') }}</button>
                @endif

*/