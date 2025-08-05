@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4>Categories</h4>
                    </div>
                    <div class="pull-right">
                        <a href=" {{ route('admin.manage-categories.add-category') }}" class="btn btn-primary btn-sm" type="button">
                            <i class="fa fa-plus"> </i>
                            Add Category</a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-borderless table-striped">
                        <thead class="bg-secondary text-white">
                        <tr>
                            <th>Category image</th>
                            <th>Category name</th>
                            <th>N Sub Category name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        <tr>
                            <td>
                                <div class="avatar mr-2">
                                    <img src="" width="50" height="50">
                                </div>
                            </td>
                            <td>
                                Electronics
                            </td>
                            <td>12</td>
                            <td>
                                <div class="table-actions">
                                    <a href="" class="text-primary">
                                        <i class="dw dw-edit2"></i>
                                    </a>
                                    <a href="" class="text-danger">
                                        <i class="dw dw-delete-3"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4>Sub Categories</h4>
                    </div>
                    <div class="pull-right">
                        <a href="" class="btn btn-primary btn-sm" type="button">
                            <i class="fa fa-plus"> </i>
                            Add Sub Category</a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-borderless table-striped">
                        <thead class="bg-secondary text-white">
                        <tr>
                            <th>Sub Category image</th>
                            <th>Category name</th>
                            <th>N Child sub name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        <tr>
                            <td>
                                <div class="avatar mr-2">
                                    <img src="" width="50" height="50">
                                </div>
                            </td>
                            <td>
                                mobile and computer
                            </td>
                            <td>
                               electronics
                            </td>
                            <td>
                                none
                            </td>

                            <td>
                                <div class="table-actions">
                                    <a href="" class="text-primary">
                                        <i class="dw dw-edit2"></i>
                                    </a>
                                    <a href="" class="text-danger">
                                        <i class="dw dw-delete-3"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
