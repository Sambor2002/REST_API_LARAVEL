<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Middleware\ValidateSignature;
use App\Models\People;
use Dotenv\Validator;
use http\Env\Response;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index (){
        $students = People::all();

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
            'email'=>'required|email|max:191',
            'phone'=>'required|digits:9',
            'street'=>'required|string|max:191',
            'country'=>'required|string|max:191',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ],422);
        }else{
            $student = People::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'street' => $request->street,
                'country' => $request->country
            ]);

            if($student){
                return response()->json([
                    'status' => 200,
                    'message' => "People added succsessfully"
                ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "Error - something went wrong"
                ],500);
            }
        }
    }

    public function show($id){
        $student = People::find($id);
        if($student){
            return response()->json([
                'status' => 200,
                'student' => $student
            ],200);
        }else {
            return response() -> json([
                'status' => 404,
                'message' => 'No student found'
            ], 404);
        }
    }
    public function edit($id){
        $student = People::find($id);
        if($student){
            return response()->json([
                'status' => 200,
                'student' => $student
            ],200);
        }else {
            return response() -> json([
                'status' => 404,
                'message' => 'No student found'
            ], 404);
        }
    }

    public function update(Request $request, int $id){
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'name'=>'required|string|max:191',
            'email'=>'required|email|max:191',
            'phone'=>'required|digits:9',
            'street'=>'required|string|max:191',
            'country'=>'required|string|max:191',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ],422);
        }else{
            $student = People::find($id);

            if($student){
                $student->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'street' => $request->street,
                    'country' => $request->country
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "People updated successfully"
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "Error - something went wrong"
                ],404);
            }
        }
    }

    public function delete($id){
        $student = People::find($id);

        if($student){
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => "People deleted successfully"
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Error - something went wrong"
            ],404);
        }

    }
}
