@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="modal fade" id="modal-sm" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" id="modal-content">

                        </div>
                    </div>
                </div>

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex justify-content-between">
                            <div class="page-title-left">
                               
                            </div>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">{{ $page_title }}</li>
                                    <li class="breadcrumb-item active">{{ $module_name }}</li>
                                </ol>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-sm-flex justify-content-between">
                                <h5 class="card-title mb-0">{{ $page_title }}</h5>
                                <button type="button" onclick="addEditModal('','category','create','GET')"
                                    class="btn btn-success waves-effect waves-light">
                                    <i class="ri-add-circle-line align-middle me-1"></i>Add New
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="ajax-datatables_wrapper" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const route = '{{ route('getCategoryIndexData') }}';
            const columns = [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action'
                }
            ];

            initializeDataTable('#ajax-datatables_wrapper', route, columns);
        });
    </script>
@endsection
