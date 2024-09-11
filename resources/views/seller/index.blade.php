@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="modal fade" id="packagemanagement-add" tabindex="-1" aria-labelledby="packagemanagement-add-label"
                    aria-modal="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="packagemanagement-add-label">Add Package Management</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="javascript:void(0);">
                                    <div class="row g-3">
                                        <div class="col-xxl-6">
                                            <div>
                                                <label for="Packagemanagement" class="form-label">Package Management</label>
                                                <input type="text" class="form-control" id="packagemanagement"
                                                    name="packagemanagement" placeholder="Enter Package Management">
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


                <div class="modal fade" id="packagemanagement-view" tabindex="-1" aria-labelledby="-view-label"
                    aria-modal="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="packagemanagement-view-label">Add Package Management </h5>
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Package Management</a></li>
                                    <li class="breadcrumb-item active">Package Management</li>
                                </ol>
                            </div>


                            <div class="page-title-right">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#packagemanagement-add"
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
                                <h5 class="card-title mb-0">Package Management</h5>
                            </div>
                            <div class="card-body">
                                <table id="example"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th data-ordering="false">SNo</th>
                                            <th data-ordering="false">Package Management</th>
                                            <th data-ordering="false">city</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>01</td>
                                            <td>Coimbatore</td>
                                            <td>Pannirmadai</td>

                                            <td><span class="badge bg-success-subtle text-success">Active</span></td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill align-middle"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a href="#" class="dropdown-item"><i
                                                                    class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                List</a>
                                                        </li>

                                                        <li><a class="dropdown-item view-item-btn" data-bs-toggle="modal"
                                                                data-bs-target="#packagemanagement-view" href="#"><i
                                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                View</a></li>
                                                        <li>
                                                            <a class="dropdown-item update-item-btn">
                                                                <i
                                                                    class="ri-lock-fill align-bottom me-2 text-muted"></i>Update
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item remove-item-btn">
                                                                <i
                                                                    class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item assign-item-btn">
                                                                <i
                                                                    class="ri-keyboard-fill align-bottom me-2 text-muted"></i>Assign
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td>02</td>
                                            <td>Erode</td>
                                            <td>puthupalayam</td>
                                            <td><span class="badge bg-warning-subtle text-warning">Inactive</span></td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill align-middle"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a href="#!" class="dropdown-item"><i
                                                                    class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                list</a>
                                                        </li>
                                                        <li><a class="dropdown-item edit-item-btn" data-bs-toggle="modal"
                                                                data-bs-target="#packagemanagement-view" href="#"><i
                                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                View</a></li>
                                                        <li>
                                                            <a class="dropdown-item update-item-btn">
                                                                <i
                                                                    class="ri-lock-fill align-bottom me-2 text-muted"></i>Update
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item remove-item-btn">
                                                                <i
                                                                    class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item remove-item-btn">
                                                                <i
                                                                    class="ri-keyboard-fill align-bottom me-2 text-muted"></i>Assign
                                                            </a>
                                                        </li>


                                                    </ul>
                                                </div>
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
