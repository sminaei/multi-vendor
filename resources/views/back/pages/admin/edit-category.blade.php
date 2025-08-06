@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4>Edit Categories</h4>
                    </div>
                    <div class="pull-right">
                        <a href=" {{ route('admin.manage-categories.cats-subcats-list') }}" class="btn btn-primary btn-sm" type="button">
                            <i class="ion-arrow-left-a"> </i>
                            Back to Category</a>
                    </div>
                </div>
                <form action=" {{ route('admin.manage-categories.update-category') }}" method="post" enctype="multipart/form-data" class="mt-3">
                    <input type="hidden" name="category_id" value="{{ $request('id') }}">
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
                                <input type="text" class="form-control" name="category_name" value="{{ $category->category_name }}">
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
                            <div class="avatar mb-3">
                                <img src="" alt="" data-ijabo-default-img="/images/categories/{{ $category->category_image }}" width="50" height="50" id="category_image_preview">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('input[type="file"][name= "category_image"]').ijaboViewer({
            preview: '#category_image_preview',
            imageShape: 'square',
            allowedExtensions: ['png','jpeg','jpg','svg'],
            onErrorShape:function (message,element){
                alert(message)
            },
            onInvalidType:function (message,element){
                alert(message)
            },
            onsuccess : function (message,element){

            }
        })
    </script>
@endpush
