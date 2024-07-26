<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Gender;
use App\Student;
use App\Teacher;
use App\MyParent;
use App\Specialization;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateTeacherApi;
use App\Http\Controllers\Auth\UserServices;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    private UserServices $userServices;
    const TOKEN_NAME = 'adminToken';
    public function __construct(UserServices $userService)
    {
        $this->userServices = $userService;
    }
    public function register(CreateUser $request)
    {
        $user =  $this->userServices->createUser($request);

        if ($user) {
            return response()->json([
                'user' => $user,
                'token' => $user->createToken(self::TOKEN_NAME, ['admin'])->plainTextToken,
                //token as text and  returns in response
            ]);
        }
    }
    public function login(Request $request)
    {
        return $this->userServices->login($request);
    }
    public function logout(Request $request)
    {
        return $this->userServices->logout($request);
    }

    public function get_all_students()
    {
        $students =  Student::all();

        return response()->json($students, status: 200);
    }
    public function get_all_teachers()
    {
        $teachers = Teacher::all();

        return response()->json($teachers, status: 200);
    }
    public function get_all_parents()
    {
        $parents = MyParent::all();

        return response()->json($parents, status: 200);
    }
    ///////////////////////
    public function get_specializations()
    {
        $data = ['specializations' => Specialization::all()];
        return response()->json($data, status: 200);
    }
    /////////////////////////
    public function get_genders()
    {
        $data = ['genders' => Gender::all()];
        return response()->json($data, status: 200);
    }
    // teachers 

    function getSpecializationName($id)
    {
        // افترض أن لديك جدول للتخصصات به عمود 'name'
        $specialization = Specialization::find($id);
        return $specialization ? $specialization->name : 'Unknown';
    }

    function getGenderName($id)
    {
        // افترض أن لديك جدول للأنواع به عمود 'name'
        $gender = Gender::find($id);
        return $gender ? $gender->name : 'Unknown';
    }
    public function create_teacher(CreateTeacherApi $request)
    {
        $request->validate([
            'email' => 'required|unique:teachers,email|email',
            'password' => 'required',
            'name_ar' => 'required|string|min:2|max:60',
            'name_en' => 'required|string|min:2|max:60',
            'specialization_id' => 'required',
            'gender_id' => 'required',
            'joining_Date' => 'required',
            'address' => ' required',
        ]);

        try {
            $teacher = new Teacher();
            $teacher->email = $request->email;
            $teacher->password = Hash::make($request->password);
            $teacher->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $teacher->specialization_id = $request->specialization_id;
            $teacher->gender_id = $request->gender_id;
            $teacher->joined_date = $request->joining_Date;
            $teacher->adderss = $request->address;
            $teacher->save();

            // إعداد البيانات لإرجاعها في الاستجابة

            $teacher->load('gender', 'specialization');
            // $responseData = [
            //     'id' => $teacher->id,
            //     'name' => $teacher->name,
            //     'email' => $teacher->email,
            //     'gender' => $this->getGenderName($teacher->gender_id),
            //     'specialization_id' =>  $teacher->specialization_id,
            //     'gender_id' =>  $teacher->gender_id,
            //     'specialization' => $this->getSpecializationName($teacher->specialization_id),
            //     'joined_date' => $teacher->joined_date,
            //     'address' => $teacher->adderss,
            //     'created_at' => $teacher->created_at,
            //     'updated_at' => $teacher->updated_at
            // ];

            return response()->json([
                'message' => 'Teacher Created successfully',
                'data' => $teacher->makeHidden('password')->toArray(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'msg' => $e->getMessage(),
                    'status' => false,
                ],
                400
            );
        }
    }

    public function updateTeacher(Request $request)

    {


        try {

            $teacher = Teacher::findOrFail($request->id);

            $teacher->email = $request->email;
            $teacher->password = Hash::make($request->password);
            $teacher->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $teacher->specialization_id = $request->specialization_id;
            $teacher->gender_id = $request->gender_id;

            $teacher->joined_date = $request->joining_Date;

            $teacher->adderss = $request->address;
            $teacher->save();


            $teacher->load('gender', 'specialization');

            // إخفاء حقل كلمة المرور وإرجاع البيانات مع رسالة بالتحديث
            return response()->json([
                'message' => 'Teacher updated successfully',
                'data' => $teacher->makeHidden('password')->toArray(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json(

                status: 400,
                data: ['msg' => $e->getMessage(), 'status' => false],
            );
        }
    }
    public function deleteTeacher(Request $request)
    {
        try {
            Teacher::findOrFail($request->id);
            return response()->json([
                ['message' => 'Teacher Deleted successfully'], 200

            ], 200);
        } catch (\Exception $e) {
            return response()->json(
                status: 400,
                data: ['msg' => $e->getMessage()],
            );
        }
    }
}
