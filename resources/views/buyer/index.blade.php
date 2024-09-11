@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="modal fade" id="buyer-add" tabindex="-1" aria-labelledby="buyer-add-label" aria-modal="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="buyer-add-label">Add Buyer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="javascript:void(0);">
                                    <div class="row g-3">
                                        <div class="col-xxl-6">
                                            <div>
                                                <label for="buyer" class="form-label">Buyer</label>
                                                <input type="text" class="form-control" id="buyer" name="buyer"
                                                    placeholder="Enter Buyer">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-xxl-6">
                                            <div>
                                                <label for="mobile" class="form-label">Mobile</label>
                                                <input type="text" class="form-control" id="mobile" name="mobile"
                                                    placeholder="Enter Mobile">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-12">
                                            <label for="genderInput" class="form-label">Status</label>
                                            <select class="form-select mb-3" aria-label="Default select example">
                                                <option selected>Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                        </div><!--end col-->
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="buyer-view" tabindex="-1" aria-labelledby="-view-label" aria-modal="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="buyer-view-label">Add Buyer </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="javascript:void(0);">
                                    <div class="row g-3">
                                        <!-- <div class="col-xxl-6">
                                                <div>
                                                    <label for="propertiesmanagement" class="form-label">Properties Management</label>
                                                    <input type="text" class="form-control" id="propertiesmanagement" name="propertiesmanagement" placeholder="Enter Properties Management">
                                                </div>
                                            </div>
                                            <div class="col-xxl-6">
                                                <div>
                                                    <label for="mobile" class="form-label">Mobile</label>
                                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="genderInput" class="form-label">Status</label>
                                                <select class="form-select mb-3" aria-label="Default select example">
                                                    <option selected>Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="2">Inactive</option>
                                                </select>
                                            </div> -->
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Buyer</a></li>
                                    <li class="breadcrumb-item active">Buyer</li>
                                </ol>
                            </div>


                            <div class="page-title-right">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#buyer-add"
                                    class="btn btn-success waves-effect waves-light">
                                    <i class="ri-add-circle-line align-middle me-1"></i>Add New
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Buyer</h5>
                            </div>
                            <div class="card-body">
                                <table id="example"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th data-ordering="false">SNo</th>
                                            <th data-ordering="false">Buyer</th>
                                            <th data-ordering="false">city</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>1</td>
                                            <td>Vignesh</td>
                                            <td>Coimbatore</td>

                                            <td><span class="badge bg-success-subtle text-success">Active</span></td>
                                            <td>
                                                <a class="link-success fs-15 me-2"
                                                    data-bs-toggle="modal" data-bs-target="#buyer-add-edit"
                                                    href="#"><i class="mdi mdi-account-check"></i>
                                                </a>
                                                <a class="link-danger fs-15 me-2"
                                                    data-bs-toggle="modal" data-bs-target="#buyer-add-edit"
                                                    href="#"><i class="mdi mdi-account-remove"></i>
                                                </a>
                                                
                                            </td>
                                        </tr>
                                        <tr>

                                            <td>2</td>
                                            <td>Pugal</td>
                                            <td>Erode</td>
                                            <td><span class="badge bg-warning-subtle text-warning">Inactive</span></td>
                                            <td>
                                                <a class="link-success fs-15 me-2"
                                                    data-bs-toggle="modal" data-bs-target="#buyer-add-edit"
                                                    href="#"><i class="mdi mdi-account-check"></i>
                                                </a>
                                                <a class="link-danger fs-15 me-2"
                                                    data-bs-toggle="modal" data-bs-target="#buyer-add-edit"
                                                    href="#"><i class="mdi mdi-account-remove"></i>
                                                </a>
                                                
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
