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
                                <h4>New product</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('seller.home') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        new product
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
                <form action="{{ route('seller.product.create-product') }}" method="post"
                      enctype="multipart/form-data" id="addProductForm">
                    @csrf
                    <div class="row pd-10">
                        <div class="col-md-8 mb-20">
                            <div class="card-box height-100-p pd-10">
                                <div class="form-group">
                                    <label for="">product name:</label>
                                    <input type="text" class="form-control" name="name">
                                    <span class="text-danger error_text name_error"></span>
                                </div>
                                  <div class="form-group">
                                    <label for="">product summary:</label>
                               <textarea id="summary" class="form-control summernot" cols="30" rows="10"></textarea>
                                    <span class="text-danger error_text summary_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">product image:</label>
                                    <input type="file" class="form-control" name="product_image">

                                    <span class="text-danger error_text product_image_error"></span>
                                </div>
                                <div class="d-block mb-3">
                                    <img src="" class="img-thumbnail" id="image-preview" data-ijabo-default-img="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-20">
                        <div class="card-box min-height-200px pd-20 mb-20">2
                        <div class="form-group">
                            <label for="">Category:</label>
                         <select name="category" id="category">
                             <option value="" selected>Not set</option>
                            <option value="1" >Cat 1 </option>
                               <option value="1" >Cat 2 </option>
                              <option value="1" >Cat 3 </option>
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
                                        <option value="{{ $item->id }}" >{{ $item->$category_name }}</option>
                                    @endforeach

                                    <option value="1" >sub Cat 2 </option>
                                    <option value="1" >sub Cat 3 </option>
                                </select>
                                <span class="text-danger error_text subcategory_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Price:</label>
                                <input type="text" class="form-control" name="price">
                                <span class="text-danger error_text price_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Compare Price:</label>
                                <input type="text" class="form-control" name="compare_price">
                                <span class="text-danger error_text compare_price_error"></span>
                            </div>
                        </div>
                        <div class="card-box min-height-120px pd-20">
                            <div class="form-group">
                                <label for="">Visibility</label>
                                <select name="visibility" id="" class="form-control">
                                    <option value="1" selected>public</option>
                                    <option value="0" >private </option>

                                </select>
                            </div>
                        </div>
                        </div>
                        </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">create product</button>
                    </div>
                </form>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30"></div>
            </div>
            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Bootstrap 4 Admin Template By
                <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

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
           $('#addProductForm').on('submit',function(e){
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
                           $(form)[0].reset();
                           $('textarea.summernote').summernote('code','');
                           $('select#subcategory').find('option').not(':first').remove();
                           $('img#image-preview').attr('src','');
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
    </script>

    @endpush
