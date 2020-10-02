@extends('layouts.base')

@section('title', (isset($data) ? 'Edit Company' : 'Create Company'))

@section('content')
    
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon-buildings text-primary"></i>
            </span>
            <h3 class="card-label">{{ isset($data) ? 'Edit Company' : 'Create Company' }}</h3>
        </div>

    </div>


        <form class="form" id="kt_form_1" action="{{ isset($data) ?  route('admin.company.update', $data->id) : route('admin.company.store') }}" method="POST"  enctype="multipart/form-data">
             @csrf
             @if( isset($data) )
                {{ method_field('PUT') }}
             @endif

            <div class="card-body">

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Logo</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">

                        <div class="image-input image-input-outline" id="kt_image_1">
                            <div class="image-input-wrapper" style="background-image: url('{{ (isset($data) && !empty($data->logo) ? asset('storage/' . $data->logo) : 'https://via.placeholder.com/250x250?text=logo+here') }}')"></div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Logo">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="logo" accept=".png, .jpg, .jpeg"/>
                                <!-- <input type="hidden" name="profile_avatar_remove"/> -->
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">Image format .png, .jpg, .jpeg (2MB upload limit)</span>
                    </div>
                    
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Name *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" class="form-control {{ $errors->any() && $errors->first('name') ? 'is-invalid' : '' }}" name="name" placeholder="Enter company name" value="{{ isset($data) ? $data->name : '' }}"/>
                        @if( $errors->first('name') )
                         <div class="invalid-feedback">{{ $errors->first('name') }}.</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Email *</label>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <input type="text" class="form-control {{ $errors->any() && $errors->first('email') ? 'is-invalid' : '' }}" name="email" placeholder="Enter company email" value="{{ isset($data) ? $data->email : '' }}"/>
                        @if( $errors->first('email') )
                         <div class="invalid-feedback">{{ $errors->first('email') }}.</div>
                        @endif
                    </div>
                </div>
        
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="reset" onClick="location.href='{{ route('admin.company.index') }}'" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </form>

    
</div>
<!--end::Card-->


@endsection


<!-- Additional css plugins goes here -->
@section('plugin_css')

@endsection

<!-- Additional javascript plugins goes here -->
@section('plugin_js')

@endsection


<!-- Custom build scripts goes here -->
@section('scripts')
<script>
var avatar1 = new KTImageInput('kt_image_1');

FormValidation.formValidation(
 document.getElementById('kt_form_1'),
 {
  fields: {

    name: {
    validators: {
     notEmpty: {
      message: 'Please enter company name'
     },
     stringLength: {
      min:10,
      max:100,
      message: 'Please enter a menu within text length range 50 and 100'
     }
    }
   },

   email: {
    validators: {
     notEmpty: {
      message: 'Company Email is required'
     },
     emailAddress: {
      message: 'The value is not a valid email address'
     }
    }
   },

  },

  plugins: {
   trigger: new FormValidation.plugins.Trigger(),
   // Bootstrap Framework Integration
   bootstrap: new FormValidation.plugins.Bootstrap(),
   // Validate fields when clicking the Submit button
   submitButton: new FormValidation.plugins.SubmitButton(),
            // Submit the form when all fields are valid
   defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
  }
 }
);
</script>
@endsection