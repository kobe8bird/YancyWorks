<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use DataTables;

use App\Models\Company;
use App\Models\Employee;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::orderBy('name', 'asc')->get();

        return view('admin.employees.form', ['companies' => $companies]);
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
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|max:15'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $request->all();

        Employee::create($data);

        return redirect()->route('admin.employee.index')->with('success', 'Successfully Added Employee');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Employee::findOrFail($id);

        return view('admin.employees.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Employee::findOrFail($id);
        $companies = Company::orderBy('name', 'asc')->get();

        return view('admin.employees.form', ['companies' => $companies, 'data' => $data]);
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
        $employee = Employee::findOrFail($id);
        $data = $request->all();
        
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $employee['firstname']  = $data['firstname'];
        $employee['lastname']   = $data['lastname'];
        $employee['email']      = $data['email'];
        $employee['phone']      = $data['phone'];
        $employee['company_id'] = $data['company_id'];
        
        $employee->save();

        return redirect()->route('admin.employee.index')->with('success', 'Employee has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = Employee::find($id);

        if( empty($data) ) {
            
            if( $request->ajax() ) {
                return response()->json([
                    'error' => '"Record does not exist!'
                ]);
            }

            return redirect()->back()->with("error", "Record does not exist!");
        }

        $data->delete();

        if( $request->ajax() ) {
             return response()->json([
                'success' => 'Employee has been deleted'
            ]);
        }

        return redirect()->back()->with("success", "Employee has been deleted");
        
    }


    /**
     * Get records from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function listings(Request $request)
    {
        $data = Employee::latest()->orderBy('created_at', 'desc')->get();

        return Datatables::of($data)
                ->editColumn('created_at', function ($row) {
                    //change over here
                    return [
                        'display' =>($row->created_at && $row->created_at != '0000-00-00 00:00:00') ? with(new Carbon($row->created_at))->format('d-m-Y H:i:s') : '',
                        'timestamp' =>($row->created_at && $row->created_at != '0000-00-00 00:00:00') ? with(new Carbon($row->created_at))->timestamp : ''
                    ];
                })
                ->editColumn('updated_at', function ($row) {
                    //change over here
                    return date('d-m-Y H:i:s', strtotime($row->updated_at) );
                }) 
                ->addColumn('company', function($row) {
                    return isset($row->company) ? $row->company->name : '';
                })
                ->addIndexColumn()
                ->addColumn('Actions', function($row) {

                })
                ->rawColumns(['Actions'])
                ->make(true);
    }
}
