@extends('layouts.base')

@section('title', 'Employee Details')

@section('content')
    
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon-buildings text-primary"></i>
            </span>
            <h3 class="card-label">Employee Details</h3>
        </div>

    </div>


 

            <div class="card-body">

              

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Firstname : </label>
                    
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <p class="col-form-label">{{ isset($data) ? $data->firstname : '' }}</p>   
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Lastname : </label>
                    
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <p class="col-form-label">{{ isset($data) ? $data->lastname : '' }}</p>   
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Email *</label>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                    <p class="col-form-label">{{ isset($data) ? $data->email : '' }}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Phone : </label>
                    
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <p class="col-form-label">{{ isset($data) ? $data->phone : '' }}</p>   
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Company : </label>
                    
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <p class="col-form-label">{{ isset($data) && isset($data->company) ? $data->company->name : '' }}</p>   
                    </div>
                </div>
        
            </div>
            <div class="card-footer">
                <div class="row">
                <div class="col-lg-2"></div>
                    <div class="col-lg-6">
                        <button type="reset" onClick="location.href='{{ route('admin.employee.edit', $data->id) }}'" class="btn btn-primary">Edit</button> 
                        <button type="reset" onClick="location.href='{{ route('admin.employee.index') }}'" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
      

    
</div>
<!--end::Card-->


@endsection

