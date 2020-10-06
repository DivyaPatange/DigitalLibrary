<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\StudentBT;
use App\Admin\Course;
use App\Admin\Department;
use App\Admin\AcademicYear;

class StudentBTCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = Course::all();
        $department = Department::all();
        $academicYear = AcademicYear::all();
        $studentBT = StudentBT::all();
        return view('auth.studentBTCard.index', compact('studentBT', 'course', 'department', 'academicYear'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'class' => 'required',
            'department' => 'required',
            'session' => 'required',
        ]);
        $id = mt_rand(100000,999999);
        $studentBT = new StudentBT();
        $studentBT->BT_no = "BTS".$id;
        $studentBT->name = $request->name;
        $studentBT->class = $request->class;
        $studentBT->department = $request->department;
        $studentBT->session = $request->session;
        $studentBT->save();
        return redirect('/admin/student-bt-card')->with('success', 'BT Card added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::all();
        $department = Department::all();
        $academicYear = AcademicYear::all();
        $studentBT = StudentBT::findorfail($id);
        return view('auth.studentBTCard.edit', compact('studentBT', 'course', 'department', 'academicYear'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $studentBT = StudentBT::findorfail($id);
        $request->validate([
            'name' => 'required',
            'class' => 'required',
            'department' => 'required',
            'session' => 'required',
        ]);
        $studentBT->name = $request->name;
        $studentBT->class = $request->class;
        $studentBT->department = $request->department;
        $studentBT->session = $request->session;
        $studentBT->update($request->all());
        return redirect('/admin/student-bt-card')->with('success', 'BT Card updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentBT = StudentBT::findorfail($id);
        $studentBT->delete();
        return redirect('/admin/student-bt-card')->with('success', 'BT Card  deleted successfully!');
    }

    public function viewStudentCard($id)
    {
        $studentBT = StudentBT::findorfail($id);
        return view('auth.studentBTCard.view', compact('studentBT'));

    }
}
