@extends('back.layout.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Profile</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('seller.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Profile
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@livewire('seller.seller-profile')
@endsection
@push('scripts')
    <script>
        $('input[type="file"][id="sellerProfilePitureFile"]').kropify({
            aspectRatio: 1,
            viewMode: 1,
            preview: '#seller',
            processURL: '{{ route("seller.change-profile-picture") }}', // or processURL:'/crop'
            maxSize: 2 * 1024 * 1024, // 2MB
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            showLoader: true,
            success : function(data){
                if( data.status == 1 ){
                    toastr.success(data.msg);
                }else{
                    toastr.error(data.msg);
                }
            },
            animationClass: 'pulse',
            // fileName: 'avatar', // leave this commented if you want it to default to the input name
            cancelButtonText:'Cancel',
            resetButtonText: 'Reset',
            cropButtonText: 'Crop & Upload',
            maxWoH:500,
            onError: function (msg) {
                alert(msg);
                // toastr.error(msg);
            },
            onDone: function(response){
                // alert(response.message);
                console.log(response);
                // toastr.success(response.message);
            }
        });
    </script>
    @endpush
