@extends('layouts.base')

@section('title', 'Companies')

@section('content')
    
<!--begin::Card-->
<div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="flaticon-buildings text-primary"></i>
                </span>
                <h3 class="card-label">Companies</h3>
            </div>
            <div class="card-toolbar">

                <!--begin::Dropdown-->
                     @include("admin.companies.partials.export")
                <!--end::Dropdown-->
                
                <!--begin::Button-->
                <a href="{{ route('admin.company.create') }}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <circle fill="#000000" cx="9" cy="15" r="6" />
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>Add Company</a>
                <!--end::Button-->

            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->


@endsection


@section('plugin_css')
    <link href="{!! asset('assets/plugins/custom/datatables/datatables.bundle.css') !!}" rel="stylesheet" type="text/css" />
@endsection


@section('plugin_js')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{!! asset('assets/plugins/custom/datatables/datatables.bundle.js') !!}"></script>
    <!--end::Page Vendors-->
@endsection


<!-- Custom build scripts goes here -->
@section('scripts')

    @if( Session::has('success') )
    <script>

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr.success("{{  Session::get('success') }}");
    </script>
    @endif

    <script>

        var storageUrl = '{{ asset('storage') }}';

        var table = $('#kt_datatable');

                // begin first table
                table.DataTable({
                    responsive: true,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }, 
                        url: "{{ route('admin.company.listings') }}",
                        type: 'POST',
                        data: {
                            // parameters for custom backend script
                            columnsDef: [
                                'logo', 'name', 'email', 'created_at', 'updated_at', 'Actions'],
                        },
                    },
                    columns: [
                        {data: 'logo'},
                        {data: 'name'},
                        {data: 'email'},
                        {data: 'created_at',
                            type: 'num',
                            render: {
                                _: 'display',
                                sort: 'timestamp'
                        }
                        },
                        {data: 'updated_at'},
                        {data: 'Actions', responsivePriority: -1},
                    ],

                    columnDefs: [
                        {
                            targets: -1,
                            title: 'Actions',
                            orderable: false,
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                var id = full.id;
                                var showUrl = '{{ route('admin.company.show', ":id") }}';
                                var editUrl = '{{ route('admin.company.edit', ":id") }}';
                                var deleteUrl = '{{ route('admin.company.destroy', ":id") }}';
                                    showUrl = showUrl.replace(':id', id);
                                    editUrl = editUrl.replace(':id', id);
                                    deleteUrl = deleteUrl.replace(':id', id);

                                    
                                
                                return '\ <a href="'+showUrl+'" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Show details">\
                                            <span class="svg-icon svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                                    <rect x="0" y="0" width="24" height="24"/>\
                                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>\
                                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>\
                                                    <path d="M10.5,10.5 L10.5,9.5 C10.5,9.22385763 10.7238576,9 11,9 C11.2761424,9 11.5,9.22385763 11.5,9.5 L11.5,10.5 L12.5,10.5 C12.7761424,10.5 13,10.7238576 13,11 C13,11.2761424 12.7761424,11.5 12.5,11.5 L11.5,11.5 L11.5,12.5 C11.5,12.7761424 11.2761424,13 11,13 C10.7238576,13 10.5,12.7761424 10.5,12.5 L10.5,11.5 L9.5,11.5 C9.22385763,11.5 9,11.2761424 9,11 C9,10.7238576 9.22385763,10.5 9.5,10.5 L10.5,10.5 Z" fill="#000000" opacity="0.3"/>\
                                                </g>\
                                            </svg>\
                                            </a>\
                                    <a href="'+editUrl+'" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details">\
	                            <span class="svg-icon svg-icon-md">\
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
											<rect x="0" y="0" width="24" height="24"/>\
											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>\
											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>\
										</g>\
									</svg>\
	                            </span>\
	                        </a>\
	                        <a href="javascript:;"  data-url="'+deleteUrl+'" class="delete-record btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Delete">\
								<span class="svg-icon svg-icon-md">\
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
											<rect x="0" y="0" width="24" height="24"/>\
											<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
											<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
										</g>\
									</svg>\
								</span>\
	                        </a>';

                                // return '\
                                //     <a href="'+showUrl+'" class="btn btn-sm btn-clean btn-icon" title="View details"><i class="icon-xl la la-eye"></i></a>\
                                //     <a href="'+editUrl+'" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a>\
                                //     <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete"><i class="la la-trash"></i></a>\
                                // ';
                            },
                        },
                        {
                            targets: -6,
                            title: 'Logo',
                            orderable: false,
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                if( full.logo !== null ) {
                                    return '\<img src="{{ asset('storage') }}/'+ full.logo +'" alt="'+ full.name +'" height="70" class="text-justify">';
                                } else {
                                    return '\<img src="https://via.placeholder.com/250x250?text=No+Logo" alt="'+ full.name +'" height="70" class="text-justify">';
                                }
                            
                                
                            },
                        },
                        
                    ],
                });


                $("body").on('click', '.delete-record', function(e) {
                    var destroyUrl = $(this).data('url');

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won\"t be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!",
                    }).then(function(result) {
                        if (result.value) {

                            $.ajax({
                                type: 'delete',
                                dataType : 'json',
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                }, 
                                url: destroyUrl,
                                success: function (data) {
                                    // console.log("data", data);

                                    Swal.fire(
                                        "Deleted!",
                                        data.success,
                                        "success"
                                    ).then(function(result) {
                                        location.reload();
                                    });

                                    
                                } 
                            });
                        } else if (result.dismiss === "cancel") {
                            Swal.fire(
                                "Cancelled",
                                "Your imaginary file is safe :)",
                                "error"
                            )
                        }
                    });
                });

    </script>

@endsection