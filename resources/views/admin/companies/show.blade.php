@extends('layouts.base')

@section('title', 'Show Company')

@section('content')
    
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon-buildings text-primary"></i>
            </span>
            <h3 class="card-label">Show Company</h3>
        </div>

    </div>


 

            <div class="card-body">

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Logo</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <img src="{{ (isset($data) && !empty($data->logo) ? asset('storage/' . $data->logo) : 'https://via.placeholder.com/250x250?text=logo+here') }}" style="max-width:200px" />
                    </div>
                    
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Name : </label>
                    
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <p class="col-form-label">{{ isset($data) ? $data->name : '' }}</p>   
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Email *</label>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                    <p class="col-form-label">{{ isset($data) ? $data->email : '' }}</p>
                    </div>
                </div>
        
            </div>
            <div class="card-footer">
                <div class="row">
                <div class="col-lg-2"></div>
                    <div class="col-lg-6">
                        <button type="reset" onClick="location.href='{{ route('admin.company.edit', $data->id) }}'" class="btn btn-primary">Edit</button> 
                        <button type="reset" onClick="location.href='{{ route('admin.company.index') }}'" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
      

    
</div>
<!--end::Card-->


@endsection

