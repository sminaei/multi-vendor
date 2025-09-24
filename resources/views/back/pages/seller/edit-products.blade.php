@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')
    @extends('back.layout.pages-layout')
    @section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
    @section('content')
        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-200px">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="title">
                                    <h4>Edit product</h4>
                                </div>
                                <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('seller.home') }}">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            edit product
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-md-6 col-sm-12 text-right">
                                <a href="{{ route('seller.product.add-product') }}" class="btn btn-primary">
                                    view all product
                                </a>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('seller.product.update-product') }}" method="post"
                          enctype="multipart/form-data" id="updateProductForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product_id }}">
                        <div class="row pd-10">
                            <div class="col-md-8 mb-20">
                                <div class="card-box height-100-p pd-10">
                                    <div class="form-group">
                                        <label for="">product name:</label>
                                        <input type="text" class="form-control" name="name" value="{{ $product_name }}">
                                        <span class="text-danger error_text name_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">product summary:</label>
                                        <textarea id="summary" class="form-control summernot" cols="30" rows="10">
                                            {{ $product->summary }}
                                        </textarea>
                                        <span class="text-danger error_text summary_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">product image:</label>
                                        <input type="file" class="form-control" name="product_image">

                                        <span class="text-danger error_text product_image_error"></span>
                                    </div>
                                    <div class="d-block mb-3">
                                        <img src="" class="img-thumbnail" id="image-preview" data-ijabo-default-img="/images/products/{{ $product->$product_img }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-20">
                                <div class="card-box min-height-200px pd-20 mb-20">2
                                    <div class="form-group">
                                        <label for="">Category:</label>
                                        <select name="category" id="category">
                                            @foreach($categories as $item)
                                            <option value="" selected>Not set</option>
                                            <option value="{{ $item->id }}" {{ $product->category == $item->id ? 'selected' : ''}} >
                                                {{ $item->category_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error_text category_error"></span>

                                    </div>
                                </div>
                                <div class="card-box min-height-200px pd-20 mb-20">
                                    <div class="form-group">
                                        <label for="">Sub Category:</label>
                                        <select name="subcategory" id="subcategory">
                                            <option value="" selected>Not set</option>
                                            @foreach($categories as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $product->subcategory ? 'selected' : ''}}>
                                                    {{ $item->subcategory_name }}</option>
                                                @if(count($item->children) > 0)
                                                    @foreach($item->children as $child)
                                                        <option value="{{ $child->id }}" {{  $child->id == $product->subcategory ? 'selected' : ''}}>
                                                            {{ $item->subcategory_name }}>{{ $child->subcategory_name }} </option>

                                                    @endforeach
                                                @endif
                                            @endforeach

                                            <option value="1" >sub Cat 3 </option>
                                        </select>
                                        <span class="text-danger error_text subcategory_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Price:</label>
                                        <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                                        <span class="text-danger error_text price_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Compare Price:</label>
                                        <input type="text" class="form-control" name="compare_price" value="{{ $product->compare_price }}">
                                        <span class="text-danger error_text compare_price_error"></span>
                                    </div>
                                </div>
                                <div class="card-box min-height-120px pd-20">
                                    <div class="form-group">
                                        <label for="">Visibility</label>
                                        <select name="visibility" id="" class="form-control">
                                            <option value="1" {{ $product->visibility == 1 ? 'selected' : '' }} >public</option>
                                            <option value="0" {{ $product->visibility == 0 ? 'selected' : '' }} >private </option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">update product</button>
                        </div>
                    </form>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box min-height-200px pd-20 mb-20">
                                <div class="title mb-2">
                                    <h6>Additional product image</h6>
                                </div>
                                <form action="{{ route('seller.product.upload-images',['product_id'=> request('id')]) }} " class="dropzone">
                                    @csrf
                                </form>
                                <button class="btn btn-outline-primary btn-sm mt-2" id="uploadAdditionalImagesBtn">upload</button>
                            </div>
                        </div>
                        <div class="box-container mb-2" id="product_images">
                            <div class="box">
                                <img src="" alt="">
                                <a class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </div>
                            <div class="box">
                                <img src="" alt="">
                                <a class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </div>
                            <div class="box">
                                <img src="" alt="">
                                <a class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30"></div>
                </div>
                <div class="footer-wrap pd-20 mb-20 card-box">
                    DeskApp - Bootstrap 4 Admin Template By
                    <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
                </div>
            </div>
        </div>
    @endsection
@push('stylesheets')
<link rel="stylesheet" href="/extra-assets/dropzonejs/min/dropzone.min.css">
    <style>
        .box-container{
            width: 100%;
            display: flex;
            flex-direction: row;
            gap: 1rem;
            justify-content: flex-start;
            flex-wrap: wrap;
        }
        .box-container .box{
            background: #423838;
            display: block;
            width: 110px;
            height: 110px;
            position: relative;
            overflow: hidden;
        }
        .box-container .box img{
            width: 100%;
            height: auto;
        }
        .box-container .box a{
            position: absolute;
            right: 7px;
            bottom: 5px;
        }
        .swal2-popup{
            font-size: .87em;
        }
    </style>
@endpush
    @push('scripts')
<script src="/extra-assets/dropzonejs/min/dropzone.min.js"></script>
        <script>
            $(document).on('change','select#category',function(e) {
                e.preventDefault();
                var category_id = $(this).val();
                var url = "{{ route('seller.product.get-product-category') }}" ;
                if(category_id == ''){
                    $("select#subcategory").find('option').not(':first').remove();

                }else{
                    $.get(url,{'category_id':category_id},function(response){
                        $("select#subcategory").find('option').not(':first').remove();

                        $("select#subcategory").append(response.data);
                    },'JSON');
                }
            });
            $('input[type="file"][name="product_image"]').ijaboViewer( {
                preview: 'img#image-preview',
                imageShape: 'square',
                allowedExtensions: ['jpg', 'jpeg','png'],
                onErrorShape: function(message, element) {
                    alert(message);
                },
                onInvalidType: function(message, element) {
                    alert(message);
                },
                onSuccess:function(message, element){

                }

            });
            $('#updateProductForm').on('submit',function(e){
                e.preventDefault();
                var summary = $('textarea.summernot').summernot('code');
                var form = this;
                var formdata = new FormData(form);
                formdata.append('summary',summary);
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:formdata,
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        toastr.remove();
                        $(form).find('span.error-text').text('');
                    },
                    success:function(response){
                        toastr.remove();
                        if(response.status == 1){
                            // $(form)[0].reset();
                            // $('textarea.summernote').summernote('code','');
                            // $('select#subcategory').find('option').not(':first').remove();
                            // $('img#image-preview').attr('src','');
                            toastr.success(response.msg);
                        }else{
                            toastr.error(response.msg);
                        }
                    },
                    error:function(response){
                        toastr.remove();
                        $.each(response.responseJson.errors, function(prefix,val){
                            $(form).find('span. '+prefix+'_error').text(val[0]);
                        });
                    }
                })
            })

            Dropzone.autoDiscover= false;
            var myDropzone = new Dropzone('.dropzone',{
                autoProcessQueue:false,
                parallelUploads: 1,
                addRemoveLinks: true,
                maxFilesize: 2,
                acceptedFiles: 'images/*',
                init: function () {
                    thisDz = this;
                    var uploadBtn = document.getElementById('uploadAdditionalImagesBtn');
                    uploadBtn.addEventListener('click', function (){
                        var nFiles = myDropzone.getQueuedFiles().length;
                        thisDz.options.parallelUploads = nFiles;
                        thisDz.processQueue();
                    })
                    thisDz.on('queuecomplete',function (){
                        this.removeAllFiles()
                        getProductImages();
                    });
                }
            })
            getProductImages();
            function getProductImages(){
                var url = "{{ route('seller.product.get-product-image',['product_id' => request('id')]) }}";
                $.get(url,{},function (response){
                    $('div#product_images').html(response.data);
                },'json')
            }
            $(document).on('click','#deleteProductImageBtn', function (e){
                e.preventDefault();
                var url = "{{ route('seller.product.delete-product-image') }}";
                var token = "{{ csrf_token() }}";
                var image_id = $(this).data("image");
                swal.fire({
                    title:'are you sure',
                    html:'you want to delete this image',
                    showCloseButton:true,
                    showCancelButton:true,
                    cancelButtonText:'Cancel',
                    confirmButtonText:'yes,delete',
                    cancelButtonColor: '#30885d6',
                    width:300,
                    allowOutsideClick:false,
                }).then(function (result) {
                    if(result.value){
                        $.post(url, { _token: token, image_id: image_id}, function (response){
                toastr.remove();
                if(response.status == 1){
                    getProductImages();
                    toastr.success(response.msg)
                }else{
                    toastr.error(response.msg);
                }
                        },'json')
                    }
                });
                alert('image id: ' + image_id);
            })
        </script>

    @endpush

@endsection
