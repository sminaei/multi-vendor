@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4>Add Sub Categories</h4>
                    </div>
                    <div class="pull-right">
                        <a href=" {{ route('admin.manage-categories.cats-subcats-list') }}" class="btn btn-primary btn-sm" type="button">
                            <i class="ion-arrow-left-a"> </i>
                            Back to Category</a>
                    </div>
                </div>
                <form action=" {{ route('admin.manage-categories.store-category') }}" method="post" enctype="multipart/form-data" class="mt-3">
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
                                <label for="">Parent Category</label>
                                <select name="parent_category" class="form-control">
                                    <option value="">Not Set</option>
                                    @foreach($categories as $item)
                                        <option value="{{ $item->id }}" {{ old('parent_category') == $item->id ? 'selected' : ''}}>
                                            {{ $item->category_name }}
                                        </option>

                                    @endforeach
                                </select>
                                @error('parent_category')
                                <span class="text-danger ml-2" >
                                    {{ $message }}
                                </span>

                                @enderror
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="">Sub Category name</label>
                                <input type="text" class="form-control" name="subcategory_name" value="{{ old('category_name') }}">
                                @error('subcategory_name')
                                <span class="text-danger ml-2" >
                                    {{ $message }}
                                </span>

                                @enderror
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="">Is chlid of</label>
                                <select name="is_child_of" class="form-control">
                                    <option value="0"> Independent</option>
                                    @foreach($subcategories as $item)
                                        <option value="{{ $item->id }}" {{ old('is_child_of') == $item->id ? 'selected' : ''}}>
                                            {{ $item->subcategory_name }}
                                        </option>

                                    @endforeach
                                </select>                                @error('is_child_of')
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
@push('scripts')
@endpush
