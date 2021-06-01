<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\company;
use DataTables;
use Validator;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use App\Mail\EmailDennis;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Employee::latest()->selectRaw("CONCAT(first_name,' ',last_name) as full_name,employees.*,companies.name as company_name,companies.logo as company_logo,companies.website as company_website,companies.email as company_email")->join('companies','employees.company_id','=','companies.id')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a data-toggle="modal" data-target="#EmployeeModal" href="javascript:void(0)" class="btn btn-info btn-sm"
					'." onclick='showModalEmployee(".json_encode($row->id).")'".'
					"><svg width="14" height="14" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
					  <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
					  <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
									</svg> View </a> <a href="javascript:void(0)" '." onclick='showModalEdit(".json_encode($row->id).",".json_encode($row->first_name).",".json_encode($row->last_name).",".json_encode($row->company_id).",".json_encode($row->email).",".json_encode($row->phone).")'".' 
									data-toggle="modal" data-target="#ModalData" class="btn btn-success btn-sm"><svg width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
					  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
					  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
					</svg> Edit</a> <a href="javascript:void(0)" data-toggle="modal" data-target="#DeleteModal" onclick="showModalDelete('.json_encode($row->id).')" class="delete btn btn-danger btn-sm"> <svg width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
					  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
					  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
					</svg> Delete</a>';
                    return $actionBtn;
                })
				->addColumn('company_view', function($row){
						$companyViewBtn = '<a data-toggle="modal" data-target="#CompanyModal" href="javascript:void(0)" 
						onclick="showModalCompany('.$row->company_id.')"
						class="btn btn-info btn-sm"><svg width="14" height="14" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
					  <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
					  <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
									</svg> '.$row->company_name.' </a> ';
									return $companyViewBtn;
								})->rawColumns(['company_view', 'action'])
                ->make(true);
        }
		else {		
			 $company = Company::all();
			 return view('employee', compact('company'));
		} 
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
		$validator = Validator::make($request->all(), [

              'first_name' => 'required|min:3',
			  'last_name' => 'required|min:3',
			  'company_id' => 'required',
			  'email' => 'required|email',
			  'phone' => 'required'

        ]);
		
		
		if ($validator->passes()) {
			
			
			$employee = new Employee;
			$employee->first_name  = $request->first_name;
			$employee->last_name  = $request->last_name;
			$employee->company_id = $request->company_id;
			$employee->email  = $request->email;
			$employee->phone  = $request->phone;
			$employee->save();
			
			$Company = Company::find($request->company_id);
			$email = $Company->email;
   
			$details = [

				'title' => 'Added New Employee',

				'body' => "Added ".$employee->first_name." ".$employee->last_name

			];

		   

			\Mail::to($email)->send(new \App\Mail\EmailDennis($details));
	        return response()->json(['success'=>["Success add record and email notification"]]);

        }

     

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Employee::selectRaw("CONCAT(first_name,' ',last_name) as full_name,employees.*,companies.name as company_name,companies.logo as company_logo,companies.website as company_website,companies.email as company_email")->join('companies','employees.company_id','=','companies.id')->where("employees.id",$id)->first();
		return response()->json(['data'=>$data]);
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
        $validator = Validator::make($request->all(), [

              'first_name' => 'required|min:3',
			  'last_name' => 'required|min:3',
			  'company_id' => 'required',
			  'email' => 'required|email',
			  'phone' => 'required'

        ]);
		
		
		if ($validator->passes()) {
            
			$employee = Employee::find($id);
			$employee->first_name  = $request->first_name;
			$employee->last_name  = $request->last_name;
			$employee->company_id = $request->company_id;
			$employee->email  = $request->email;
			$employee->phone  = $request->phone;
			$employee->save();

            return response()->json(['success'=>'Success update record.']);

        }

     

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // delete
        $company = Employee::find($id);
        $company->delete();

        return response()->json(['success'=>'Success delete record.']);
    }
}
