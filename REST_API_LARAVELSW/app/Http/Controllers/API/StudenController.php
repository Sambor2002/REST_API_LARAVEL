<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudenController extends Controller
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

}
