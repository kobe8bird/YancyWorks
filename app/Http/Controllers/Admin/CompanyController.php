<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use DataTables;

use App\Models\Company;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.form');
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
            'name' => 'required|max:255',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $request->all();


        if( $request->hasFile('logo') ) {
            $path = $request->file('logo')->store('logos');
            $name = $request->file('logo')->getClientOriginalName();

            $data['logo'] = $path;
        }
        
        Company::create($data);

        return redirect()->route('admin.company.index')->with('success', 'Successfully Added Company');
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Company::findOrFail($id);

        return view('admin.companies.show', [ 'data' => $data ]);
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
        $data = Company::findOrFail($id);

        return view('admin.companies.form', [ 'data' => $data ]);
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

        $company = Company::findOrFail($id);
        $data = $request->all();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $company['name'] = $data['name'];
        $company['email'] = $data['email'];

        if( $request->hasFile('logo') ) {
            $path = $request->file('logo')->store('logos');
            $name = $request->file('logo')->getClientOriginalName();

            $company['logo'] = $path;
        }
        
        $company->save();

        return redirect()->route('admin.company.index')->with('success', 'Successfully Updated Company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = Company::find($id);

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
                'success' => 'Company has been deleted'
            ]);
        }

        return redirect()->back()->with("success", "Company has been deleted");
    }


    /**
     * Get records from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function listings(Request $request)
    {
        $data = Company::latest()->orderBy('created_at', 'desc')->get();

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
                ->addIndexColumn()
                ->addColumn('Actions', function($row) {

                })
                ->rawColumns(['Actions'])
                ->make(true);
    }


    
}
