<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function saveStudent(Request $request){
        try{
            $student=new Student();
            $student->name=$request->name;
            $student->email=$request->email;
            $student->phone=$request->phone;
            $student->save();
            return response()->json([
                'message' => 'Student saved successfully',
                'student name'=>$student->name,
                'student email'=>$student->email,
                'student phone'=>$student->phone
            ],201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error saving student',
                'error' => $e->getMessage()
            ], 404);
        }
    }
    public function showStudentForm(){
        return view('student_form');
    }
    public function showStudentList(){
        $students=Student::all();
        return view('student_list', compact('students'));
    }
}
