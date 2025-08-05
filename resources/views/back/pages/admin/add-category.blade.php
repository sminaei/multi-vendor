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
                        <a href=" {{ route('admin.manage-categories.cats-subcats-list') }}" class="btn btn-primary btn-sm" type="button">
                            <i class="ion-arrow-left-a"> </i>
                            Back to Category</a>
                    </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    @if(Session::get('success'))
                        <div class="alert alert-success">
                            <strong><i class="dw dw-checked"></i></strong>
                            {{ (Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(Session::get('fail'))
                        <div class="alert alert-success">
                            <strong><i class="dw dw-checked"></i></strong>
                            {{ (Session::get('fail') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="">Category name</label>
                                <input type="text" class="form-control" name="category_name" value="{{ old('category_name') }}">
                                @error('category_name')
                                <span class="text-danger ml-2" >
                                    {{ $message }}
                                </span>

                                @enderror
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="">Category image</label>
                                <input type="file" class="form-control" name="category_image" value="{{ old('category_name') }}">
                                @error('category_image')
                                <span class="text-danger ml-2" >
                                    {{ $message }}
                                </span>

                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
