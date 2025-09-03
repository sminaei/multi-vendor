@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4> shop setting</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('seller.home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                           shop setting
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <x-alert.form-alert/>
        <form action="{{ route('seller.shop-settings') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Shop name:</label>
                        <input type="text" class="form-control" name="shop_name" value="{{ old('shop_name') ? old('shop_name') :
                $shopInfo->shop_name }}">
                        @error('shop_name')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Shop phone:</label>
                        <input type="text" class="form-control" name="shop_phone" value="{{ old('shop_phone') ? old('shop_phone') :
                $shopInfo->shop_phone }}">
                        @error('shop_phone')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Shop address:</label>
                        <input type="text" class="form-control" name="shop_address" value="{{ old('shop_address') ? old('shop_address') :
                $shopInfo->shop_address }}">
                        @error('shop_address')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="">Shop Description</label>
                        <textarea name="shop_description" class="form-control" id="" cols="30" rows="10">{{ old('shop_description') ? old('shop_description') :
                    $shopInfo->shop_description }}</textarea>
                        @error('shop_description')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Shop Logo</label>
                        <input type="file" name="shop_logo" class="form-control">
                        <div class="mb-2 mt-1">
                            <img src="{{ $shopInfo->shop_logo != null ? '/images/shop/'.  $shopInfo->shop_logo : '' }}" alt="" class="img-thumbnail" id="shop_logo_preview">
                        </div>
                        @error('shop_logo')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
    $('input[type="file"][name=shop_logo]').ijaboViewer({
        preview: 'img#shop_logo_preview',
        imageShape: 'square',
        allowedExtensions: ['jpg', 'svg', 'png'],
        onErrorShape: function(message, element) {
            alert(message);
        },
        onInvalidType: function(message, element) {
            alert(message);
        },
        onSuccess: function(message, element) {},
        onErrorFileSize: 'The selected file exceeds the maximum allowed size of 1MB',
        onErrorText: 'Please upload a valid image file',
        initialPreview: "{{ $
    </script>
                    @endpush
