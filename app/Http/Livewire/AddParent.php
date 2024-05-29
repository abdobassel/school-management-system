<?php

namespace App\Http\Livewire;

use App\Blood;
use App\MyParent;
use App\Religion;
use App\Nationality;
use Livewire\Component;
use App\ParentAtachment;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AddParent extends Component
{ //father

    use WithFileUploads;
    public $currentStep = 1, $Email, $Password, $Name_Father, $Name_Father_en, $Job_Father, $Job_Father_en, $National_ID_Father, $Phone_Father, $Nationality_Father_id, $Blood_Type_Father_id, $Religion_Father_id, $Address_Father, $Passport_ID_Father;
    public $successMessage = '';
    public $photos;
    public $show_table = true;
    public $updateMode = false;
    // mother
    public $Name_Mother, $Name_Mother_en, $Job_Mother, $Job_Mother_en, $National_ID_Mother, $Phone_Mother, $Nationality_Mother_id, $Blood_Type_Mother_id, $Religion_Mother_id, $Address_Mother, $Passport_ID_Mother;
    public $catchError = false;

    // validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'Email' => 'required|email',
            'Password' => 'required',


            'National_ID_Father' => 'required|string|min:10|max:15|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'required|min:10|max:15',
            'Phone_Father' => 'required|regex:/^([0-9\s\-\*\(\)]*)$/|min:10',
            'National_ID_Mother' => 'required|string|min:10|max:15|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'required|min:10|max:15',
            'Phone_Mother' => 'required|regex:/^([0-9\s\-\*\(\)]*)$/|min:10',


        ]);
    }
    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => Nationality::all(),
            'Bloods' => Blood::all(),
            'Religions' => Religion::all(),
            'my_parents' => MyParent::all(),
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
        try {
            //1 =>  insert 
            $My_Parent = new MyParent();
            $My_Parent->name_father = ['ar' => $this->Name_Father, 'en' => $this->Name_Father_en];
            $My_Parent->email = $this->Email;
            $My_Parent->password = Hash::make($this->Password);
            $My_Parent->phone_father = $this->Phone_Father;
            $My_Parent->national_id_father = $this->National_ID_Father;
            $My_Parent->job_father = ['ar' => $this->Job_Father, 'en' => $this->Job_Father_en];
            $My_Parent->passport_id_father = $this->Passport_ID_Father;
            $My_Parent->nationality_father_id = $this->Nationality_Father_id;
            $My_Parent->religion_father_id = $this->Religion_Father_id;
            $My_Parent->blood_father_id = $this->Blood_Type_Father_id;
            $My_Parent->address_father = $this->Address_Father;
            // mother
            $My_Parent->name_mother = ['ar' => $this->Name_Mother, 'en' => $this->Name_Mother_en];

            $My_Parent->phone_Mother = $this->Phone_Mother;
            $My_Parent->job_mother = ['ar' => $this->Job_Mother, 'en' => $this->Job_Mother_en];
            $My_Parent->national_id_mother = $this->National_ID_Mother;
            $My_Parent->passport_id_mother = $this->Passport_ID_Mother;
            $My_Parent->nationality_mother_id = $this->Nationality_Mother_id;
            $My_Parent->religion_mother_id = $this->Religion_Mother_id;
            $My_Parent->blood_mother_id = $this->Blood_Type_Mother_id;
            $My_Parent->address_mother = $this->Address_Mother;
            $My_Parent->save();

            if (!empty($this->photos)) {
                foreach ($this->photos as $photo) {
                    $photo->storeAs(
                        'parent_attachments/' . $this->National_ID_Father,
                        $photo->getClientOriginalName()
                    );
                    ParentAtachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => MyParent::latest()->first()->id,
                    ]);
                }
            }

            $this->successMessage = trans('messages.success');
            $this->clearForm();

            $this->currentStep = 1; // الرجوع للصفحة الاولى بعد نجاح العملية

        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }
    }
    public $Parent_id;
    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;

        $My_Parent = MyParent::findOrFail($id);
        $this->Parent_id = $id;
        $this->Phone_Father = $My_Parent->phone_father;
        $this->National_ID_Father = $My_Parent->national_id_father;
        $this->Job_Father = $My_Parent->getTranslation('job_father', 'ar');
        $this->Job_Father_en = $My_Parent->getTranslation('job_father', 'en');
        $this->Job_Mother = $My_Parent->getTranslation('job_mother', 'ar');
        $this->Job_Mother_en = $My_Parent->getTranslation('job_mother', 'en');

        $this->Name_Father = $My_Parent->getTranslation('name_father', 'ar');
        $this->Name_Father_en = $My_Parent->getTranslation('name_father', 'en');
        $this->Name_Mother = $My_Parent->getTranslation('name_mother', 'ar');
        $this->Name_Mother_en = $My_Parent->getTranslation('name_mother', 'en');


        $this->Passport_ID_Father = $My_Parent->passport_id_father;
        $this->Nationality_Father_id = $My_Parent->nationality_father_id;
        $this->Religion_Father_id = $My_Parent->religion_father_id;
        $this->Blood_Type_Father_id = $My_Parent->blood_father_id;
        $this->Address_Father = $My_Parent->address_father;
        $this->Phone_Mother = $My_Parent->phone_Mother;

        $this->National_ID_Mother = $My_Parent->national_id_mother;
        $this->Passport_ID_Mother = $My_Parent->passport_id_mother;
        $this->Nationality_Mother_id = $My_Parent->nationality_mother_id;
        $this->Religion_Mother_id = $My_Parent->religion_mother_id;
        $this->Blood_Type_Mother_id = $My_Parent->blood_mother_id;
        $this->Address_Mother = $My_Parent->address_mother;
        $this->Email = $My_Parent->email;
        $this->Password = '';
    }
    public function submitForm_edit()
    {
        if ($this->Parent_id) {
            $this->validate([
                'National_ID_Mother' => 'required|string|min:10|max:15|regex:/[0-9]{9}/',
                'Passport_ID_Mother' => 'required|min:10|max:15',
                'Phone_Mother' => 'required|regex:/^([0-9\s\-\*\(\)]*)$/|min:10',
                'National_ID_Father' => 'required|string|min:10|max:15|regex:/[0-9]{9}/',
                'Passport_ID_Father' => 'required|min:10|max:15',
                'Phone_Father' => 'required|regex:/^([0-9\s\-\*\(\)]*)$/|min:10',
                'Address_Mother' => 'required|string',
                'Address_Father' => 'required|string',
                'Password' => 'nullable|string|min:8',
                'Job_Mother' => 'required|string',
                'Job_Father' => 'required|string',
            ]);

            $data = [
                'national_id_mother' => $this->National_ID_Mother,
                'passport_id_mother' => $this->Passport_ID_Mother,
                'national_id_father' => $this->National_ID_Father,
                'passport_id_father' => $this->Passport_ID_Father,
                'address_mother' => $this->Address_Mother,
                'address_father' => $this->Address_Father,
                'phone_Mother' => $this->Phone_Mother,
                'phone_father' => $this->Phone_Father,
                'job_father' =>  ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
                'job_mother' =>  ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
                'name_father' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                'name_mother' => ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],

            ];

            if ($this->Password) {
                $data['password'] = Hash::make($this->Password);
            }

            $My_Parent = MyParent::findOrFail($this->Parent_id);
            $My_Parent->update($data);

            session()->flash('success', trans('messages.success'));
        } else {
            session()->flash('error', trans('messages.error'));
        }

        return redirect()->to('/add_parent');
    }
    // حذف البيانات مع الملفات بتحذير قبل الحذف واذا لم يجد ملفات يحذف مباشرة بدون تحذير
    public $showConfirmation = false;
    public function confirmDelete($parentId)
    {
        $this->Parent_id = $parentId;
        $parent = MyParent::findOrFail($this->Parent_id);

        if ($parent->parentsAtchments()->count() > 0) {
            $this->showConfirmation = true;
        } else {
            $this->deleteParent();
        }
    }

    public function deleteParent()
    {
        try {
            $parent = MyParent::findOrFail($this->Parent_id);

            // التحقق مما إذا كان هناك مرفقات مرتبطة بالوالد
            // التحقق مما إذا كان هناك مرفقات مرتبطة بالوالد
            if ($parent->parentsAtchments()->count() > 0) {
                // المرور على كل مرفق مرتبط بالوالد
                foreach ($parent->parentsAtchments as $attachment) {
                    // تحديد المسار الكامل إلى الملف

                    $filePath = storage_path('app/parent_attachments/' . $parent->National_ID_Father . '/' . $attachment->file_name);

                    // التحقق مما إذا كان الملف الفعلي موجودًا على السيرفر
                    if (Storage::exists($filePath)) {
                        // حذف الملف من السيرفر
                        Storage::delete($filePath);
                    }
                    // حذف السجل الخاص بالمرفق من قاعدة البيانات
                    $attachment->delete();

                    // حذف السجل الخاص بالمرفق من قاعدة البيانات

                }

                // حذف المجلد الفارغ بعد حذف الملفات إذا لم يعد يحتوي على أي ملفات أخرى
                $directoryPath = storage_path('app/parent_attachments/' . $parent->National_ID_Father);
                if (file_exists($directoryPath) && count(scandir($directoryPath)) === 2) { // تحقق من أن المجلد فارغ
                    rmdir($directoryPath); // حذف المجلد
                }
            }

            $parent->delete();
            $this->showConfirmation = false;
            session()->flash('message', 'تم حذف العنصر بنجاح!');
            return redirect()->to('/add_parent');
        } catch (\Exception $e) {

            session()->flash('warning', $e->getMessage());
        }
    }
    public function delete($id)
    {


        try {

            $parent =  MyParent::findOrFail($id);
            if ($parent->parentsAtchments()->count() > 0) {

                session()->flash('warning', 'لا يمكن حذف هذا الوالدين لأن لديهم مرفقات مرتبطة.');
            } else {
                $parent->delete();
                $parent->parentsAtchments->each->delete();

                toastr()->success(trans('messages.success'));
            }
        } catch (\Exception $e) {
            session()->flash('warning', 'لا يمكن حذف هذا الوالدين لأن لديهم مرفقات مرتبطة.');
            session()->flash('warning', $e->getMessage());
        }

        return redirect()->to('/add_parent');
    }
    public function deleteConfirm()
    {
    }

    public function showAddForm()
    {
        $this->show_table = false;
    }

    // clear form 
    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Name_Father_en = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->National_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Religion_Father_id = '';
        $this->Address_Father = '';
        $this->Passport_ID_Father = '';
        $this->Name_Mother = '';
        $this->Name_Mother_en = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->National_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Religion_Mother_id = '';
        $this->Address_Mother = '';
        $this->Passport_ID_Mother = '';
    }
    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;
    }
    public function back($step)
    {
        $this->currentStep = $step;
    }
    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;
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