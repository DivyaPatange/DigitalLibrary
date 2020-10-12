<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\LibraryAccession;
use DateTime;
use App\Admin\StudentBT;

class LibraryAccessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libraryAccession = LibraryAccession::all();
        return view('auth.libraryAccession.index', compact('libraryAccession'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'start_time' => 'required',
        ]);
        $libraryAccession = new LibraryAccession();

        $libraryAccession->BT_no = $request->BT_no;
        $libraryAccession->start_time = $request->start_time;
        $libraryAccession->save();
        return redirect('/admin/libraryAccession')->with('success', 'Library Accessed');
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

    public function searchLibraryAccessionRecord(Request $request)
    {
        if($request->ajax()) {
            // select country name from database
            $data = LibraryAccession::where('start_time', 'LIKE', $request->accession_date.'%')
                ->get();
                // dd($data);
                
        
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
                foreach ($data as $key => $row){
                    // dd($request->user_referral_info == $row->referral_code);
                    if($request->book_code == $row->book_code){
                    // concatenate output to the array
                    // $parentName = User::where('id', $row->parent_id)->first();

                    $user = StudentBT::where('BT_no', $row->BT_no)->first();
                       $output .= '<tr>'. 
                       '<td>'.++$key.'</td>'.
                       '<td>'.$row->BT_no.'</td>'. 
                       '<td>'.$user->name.'</td>'. 
                       '<td>'.$row->start_time.'</td>';
                       if(!$row->end_time){
                       $output .='<td><input type="text" class="form-control form-control-user accession-end-time" name="end_time"  placeholder="End Time" ></td>';
                        }
                        else{
                            $output .='<td>'.$row->end_time.'</td>'; 
                        }
                        
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
}
