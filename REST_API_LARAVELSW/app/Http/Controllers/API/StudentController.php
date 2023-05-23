<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Middleware\ValidateSignature;
use App\Models\Student;
use Dotenv\Validator;
use http\Env\Response;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index (){
        $students = Student::all();

        if($students->count() > 0){
            return response() -> json([
                'status' => 200,
                'students' => $students
            ], 200);

        } else {
            return response() -> json([
                'status' => 404,
                'message' => 'No data'
            ], 404);
        }
    }

    public function store(Request $request){
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'name'=>'required|string|max:191',
            'course'=>'required|string|max:191',
            'email'=>'required|email|max:191',
            'phone'=>'required|digits:9',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ],422);
        }else{
            $student = Student::create([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone
            ]);

            if($student){
                return response()->json([
                    'status' => 200,
                    'message' => "Student added succsessfully"
                ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "Error - something went wrong"
                ],500);
            }
        }
    }
}
