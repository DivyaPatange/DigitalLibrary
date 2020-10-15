<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\BookTransaction;
use App\Admin\StudentBT;
use App\Admin\LibraryBook;
use App\Admin\AcademicYear;
use App\Admin\StudentBookIssue;
use Redirect;

class BookTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookTransaction = BookTransaction::all();
        return view('auth.bookTransaction.index', compact('bookTransaction'));
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
            'BT_no' => 'required',
        ]);
        $studentBT = StudentBT::where('BT_no', $request->BT_no)->first();
        $session = AcademicYear::where('id', $studentBT->session)->first();
        $date = date('Y/m/d H:i:s');
        if(($date >= $session->from_academic_year) && ($date <= $session->to_academic_year))
        {
            $bookTransaction = BookTransaction::where('BT_no', $request->BT_no)->first();
            if(empty($bookTransaction)){
            // $increment_date = strtotime("+7 day", strtotime($date));
            // $expected_date = date("Y-m-d", $increment_date);
            $bookTransaction = new BookTransaction();
            $bookTransaction->BT_no = $request->BT_no;
            // $bookTransaction->book_code = $request->book_code;
            // $bookTransaction->issue_date = $date;
            // $bookTransaction->expected_return_date = $expected_date;/
            $bookTransaction->save();
            return redirect('/admin/bookTransaction')->with('success', 'Book Issue Successfully!');
            }
            else{
                return redirect('/admin/bookTransaction')->with('danger', 'BT Card is already registered!');
            }
        }
        else{
            return redirect('/admin/bookTransaction')->with('danger', 'BT Card is Expired!');
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchStudentBTCard(Request $request)
    {
        if($request->ajax()) {
            // select country name from database
            $data = StudentBT::where('BT_no', 'LIKE', $request->BT_no.'%')
                ->get();
                
        
            // declare an empty array for output
            $output = '';
            // if searched countries count is larager than zero
            // dd(!(isset($data)) || empty($data));
            if(!(isset($data)) || empty($data))
                {
                    return array("error","Please Enter Valid Referral Code");
                }
            if (count($data)>0) {
                // concatenate output to the array
                // loop through the result array
                foreach ($data as $row){
                    // dd($request->user_referral_info == $row->referral_code);
                    if($request->BT_no == $row->BT_no){
                    // concatenate output to the array
                    // $parentName = User::where('id', $row->parent_id)->first();

                    
                       $output .= $row->name;
                        
                        
                    }
                }
                // end of output
            }
            
            else {
                // if there's no matching results according to the input
                $output .= 'No results';
            }
            // return output result array
            return $output;
        }
    }

    public function searchBookCode(Request $request)
    {
        if($request->ajax()) {
            // select country name from database
            $data = LibraryBook::where('book_no', 'LIKE', $request->book_code.'%')
                ->get();
                
        
            // declare an empty array for output
            $output = '';
            // if searched countries count is larager than zero
            // dd(!(isset($data)) || empty($data));
            if(!(isset($data)) || empty($data))
                {
                    return array("error","Please Enter Valid Referral Code");
                }
            if (count($data)>0) {
                // concatenate output to the array
                // loop through the result array
                foreach ($data as $row){
                    // dd($request->user_referral_info == $row->referral_code);
                    if($request->book_code == $row->book_no){
                    // concatenate output to the array
                    // $parentName = User::where('id', $row->parent_id)->first();

                    
                       $output .= $row->book_name;
                        
                        
                    }
                }
                // end of output
            }
            
            else {
                // if there's no matching results according to the input
                $output .= 'No results';
            }
            // return output result array
            return $output;
        }
    }

    public function studentBookIssueForm($id)
    {
        $BT_no = BookTransaction::findorfail($id);
        $issueBook = StudentBookIssue::where('bookTransaction_id', $id)->get();
        // dd($issueBook);
        return view('auth.bookTransaction.studentBookIssueForm', compact('BT_no', 'issueBook'));
    }

    public function studentBookIssueFormSubmit(Request $request)
    {
        $request->validate([
            'book_code' => 'required',
        ]);
            $checkBookAvailability = LibraryBook::where('book_no', $request->book_code)->first();
            if($checkBookAvailability->book_status == 1)
            {
                $studentBT = StudentBT::where('BT_no', $request->BT_no)->first();
                $session = AcademicYear::where('id', $studentBT->session)->first();
                $date = date('Y/m/d H:i:s');
                if(($date >= $session->from_academic_year) && ($date <= $session->to_academic_year))
                {
                    $increment_date = strtotime("+7 day", strtotime($date));
                    $expected_date = date("Y-m-d", $increment_date);
                    // $bookTransaction->book_code = $request->book_code;
                    $issueBook = new StudentBookIssue();
                    $issueBook->bookTransaction_id = $request->BT_id;
                    $issueBook->book_no = $request->book_code;
                    $issueBook->issue_date = $date;
                    $issueBook->expected_return_date = $expected_date;
                    $issueBook->status = 1;
                    $issueBook->save();
                    $bookStatus = LibraryBook::where('book_no', $request->book_code)->update(['book_status' => 0]);
                    return Redirect::back()->with('success', 'Book Issue Successfully');
                }
                else{
                    return Redirect::back()->with('danger', 'BT Card is expired!');
                }
            }
            else{
                return Redirect::back()->with('danger', 'Book is not available!');
            }
        
    }

    public function studentBookIssueFormUpdate(Request $request)
    {
        $bookTransaction = StudentBookIssue::where('id', $request->issueID)->first();
        $book_status = $request->book_status;
        $foundjquery = "Not found";
        if(in_array('jQuery',$book_status)){
            $foundjquery = "found";
        }
        // Converting the array to comma separated string
        $book_status = implode(",",$book_status);
        $bookTransaction = StudentBookIssue::where('id', $request->issueID)->update([
            'actual_return_date' => $request->return_date,
            'book_status' => $book_status,
        ]);
    }
}
