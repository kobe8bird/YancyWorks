@extends('layouts.base')

@section('title', (isset($data) ? 'Edit Employee' : 'Add Employee'))

@section('content')
    
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon-buildings text-primary"></i>
            </span>
            <h3 class="card-label">{{ isset($data) ? 'Edit Employee' : 'Add Employee' }}</h3>
        </div>

    </div>


        <form class="form" id="kt_form_1" action="{{ isset($data) ?  route('admin.employee.update', $data->id) : route('admin.employee.store') }}" method="POST"  enctype="multipart/form-data">
             @csrf
             @if( isset($data) )
                {{ method_field('PUT') }}
             @endif

            <div class="card-body">


                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Firstname *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" class="form-control {{ $errors->any() && $errors->first('firstname') ? 'is-invalid' : '' }}" name="firstname" placeholder="Enter firstname" value="{{ isset($data) ? old('firstname', $data->firstname) : old('firstname') }}"/>
                        @if( $errors->first('firstname') )
                         <div class="invalid-feedback">{{ $errors->first('firstname') }}.</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Lastname *</label>
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" class="form-control {{ $errors->any() && $errors->first('lastname') ? 'is-invalid' : '' }}" name="lastname" placeholder="Enter lastname" value="{{ isset($data) ? old('lastname', $data->lastname) : old('lastname') }}"/>
                        @if( $errors->first('lastname') )
                         <div class="invalid-feedback">{{ $errors->first('lastname') }}.</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Email</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <input type="email" class="form-control {{ $errors->any() && $errors->first('email') ? 'is-invalid' : '' }}" name="email" placeholder="Enter email" value="{{ isset($data) ? old('email', $data->email) : old('email') }}"/>
                        @if( $errors->first('email') )
                         <div class="invalid-feedback">{{ $errors->first('email') }}.</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Phone</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <input type="text" class="form-control" name="phone" placeholder="Enter phone" value="{{ isset($data) ? old('phone', $data->phone) : old('phone') }}"/>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Company</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <select class="form-control select2" id="kt_select2_1" name="company_id">
                            <option value="">-- Select Company --</option>
                            @foreach( $companies as $row )
                                <option value="{{ $row->id }}" {{ isset($data) && $row->id == old('company_id', $data->company_id) ? "selected='selected'" : ''  }} >{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

        
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="reset" onClick="location.href='{{ route('admin.employee.index') }}'" class="btn btn-secondary">Cancel</button>
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
 $('#kt_select2_1').select2({
    placeholder: "Select a Company"
});
$('#kt_select2_1').select2("val", "{{ isset($data) ? old('company_id', $data->company_id) : old('company_id')  }}");


FormValidation.formValidation(
 document.getElementById('kt_form_1'),
 {
  fields: {

    firstname: {
    validators: {
     notEmpty: {
      message: 'Please enter firstname'
     },
     stringLength: {
      min:3,
      max:100,
      message: 'Please enter a menu within text length range 50 and 100'
     }
    }
   },
   lastname: {
    validators: {
     notEmpty: {
      message: 'Please enter lastname'
     },
     stringLength: {
      min:3,
      max:100,
      message: 'Please enter a menu within text length range 50 and 100'
     }
    }
   },

   email: {
     emailAddress: {
      message: 'The value is not a valid email address'
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