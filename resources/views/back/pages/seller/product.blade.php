@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title here')
@section('content')
	<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>My Product</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="{{ route('seller.home')}}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											My Product
										</li>
									</ol>
								</nav>
							</div>
							<div class="col-md-6 col-sm-12 text-right">
						<a href="{{ route('seller.product.add-product')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle">
                            Add new Product</i></a>
							</div>
						</div>
					</div>
                @@livewire('seller.products')
@endsection