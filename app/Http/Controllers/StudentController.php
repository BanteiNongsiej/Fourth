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
    public function updateStudent(Request $request, $id){
        try{
            $student=Student::find($id);
            if(!$student){
                return response()->json([
                    'message' => 'Student not found'
                ], 404);
            }
            $student->name=$request->name;
            $student->email=$request->email;
            $student->phone=$request->phone;
            $student->save();
            return response()->json([
                'message' => 'Student updated successfully',
                'student name'=>$student->name,
                'student email'=>$student->email,
                'student phone'=>$student->phone
            ],200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error updating student',
                'error' => $e->getMessage()
            ], 404);
        }
    }
    public function deleteStudent($id){
        try{
            $student=Student::find($id);
            if(!$student){
                return response()->json([
                    'message' => 'Student not found'
                ], 404);
            }
            $student->delete();
            return response()->json([
                'message' => 'Student deleted successfully'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error deleting student',
                'error' => $e->getMessage()
            ], 404);
        }
    }
    public function getStudent($id){
        try{
            $student=Student::find($id);
            if(!$student){
                return response()->json([
                    'message' => 'Student not found'
                ], 404);
            }
            return response()->json([
                'student'=>$student
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Error getting student',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
