<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>@yield('pagesTitle')</title>

		<!-- Site favicon -->
        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="/image/site/{{ get_settings()->site_favicon }}"
        />


		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="/back/vendors/styles/icon-font.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/style.css" />

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script
			async
			src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"
		></script>
		<script
			async
			src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
			crossorigin="anonymous"
		></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() {
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "G-GBZ3SGGX85");
		</script>
		<!-- Google Tag Manager -->
        @livewireStyles
        @stack('stylesheets')
		<!-- End Google Tag Manager -->
	</head>
	<body class="login-page">
		<div class="login-header box-shadow">
			<div
				class="container-fluid d-flex justify-content-between align-items-center"
			>
				<div class="brand-logo">
					<a href="login.html">
						<img src="/images/site/{{ get_settings()->site_logo }}" alt="" />
					</a>
				</div>
				<div class="login-menu">
					<ul>
                        @if(!Route::is('admin.*'))
                            @if(Route::is('seller.login'))
                                <li><a href="{{ route('seller.register') }}">Register</a></li>
                            @else
                                <li><a href="{{ route('seller.login') }}">Register</a></li>

                            @endif


                        @endif
					</ul>
				</div>
			</div>
		</div>
		<div
			class="login-wrap d-flex align-items-center flex-wrap justify-content-center"
		>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 col-lg-7">
						<img src="/back/vendors/images/login-page-img.png" alt="" />
					</div>
					<div class="col-md-6 col-lg-5">
						@yield('content')
					</div>
				</div>
			</div>
		</div>
		<!-- welcome modal start -->
		<div class="welcome-modal">
			<button class="welcome-modal-close">
				<i class="bi bi-x-lg"></i>
			</button>
			<iframe
				class="w-100 border-0"
				src="https://embed.lottiefiles.com/animation/31548"
			></iframe>
			<div class="text-center">
				<h3 class="h5 weight-500 text-center mb-2">
					Open source
					<span role="img" aria-label="gratitude">❤️</span>
				</h3>
				<div class="pb-2">
					<a
						class="github-button"
						href="https://github.com/dropways/deskapp"
						data-color-scheme="no-preference: dark; light: light; dark: light;"
						data-icon="octicon-star"
						data-size="large"
						data-show-count="true"
						aria-label="Star dropways/deskapp dashboard on GitHub"
						>Star</a
					>
					<a
						class="github-button"
						href="https://github.com/dropways/deskapp/fork"
						data-color-scheme="no-preference: dark; light: light; dark: light;"
						data-icon="octicon-repo-forked"
						data-size="large"
						data-show-count="true"
						aria-label="Fork dropways/deskapp dashboard on GitHub"
						>Fork</a
					>
				</div>
			</div>
			<div class="text-center mb-1">
				<div>
					<a
						href="https://github.com/dropways/deskapp"
						target="_blank"
						class="btn btn-light btn-block btn-sm"
					>
						<span class="text-danger weight-600">STAR US</span>
						<span class="weight-600">ON GITHUB</span>
						<i class="fa fa-github"></i>
					</a>
				</div>
				<script
					async
					defer="defer"
					src="https://buttons.github.io/buttons.js"
				></script>
			</div>
			<a
				href="https://github.com/dropways/deskapp"
				target="_blank"
				class="btn btn-success btn-sm mb-0 mb-md-3 w-100"
			>
				DOWNLOAD
				<i class="fa fa-download"></i>
			</a>
			<p class="font-14 text-center mb-1 d-none d-md-block">
				Available in the following technologies:
			</p>
			<div class="d-none d-md-flex justify-content-center h1 mb-0 text-danger">
				<i class="fa fa-html5"></i>
			</div>
		</div>
		<button class="welcome-modal-btn">
			<i class="fa fa-download"></i> Download
		</button>
		<!-- welcome modal end -->
		<!-- js -->
		<script src="/back/vendors/scripts/core.js"></script>
		<script src="/back/vendors/scripts/script.min.js"></script>
		<script src="/back/vendors/scripts/process.js"></script>
		<script src="/back/vendors/scripts/layout-settings.js"></script>
        <script>
            if( navigator.userAgent.indexOf("firefox") != -1){
                history.pushState(null,null, document.URL);
                window.addEventListener('popstate', function (){
                    history.pushState(null,null, document.URL);
                })
            }
        </script>
        <script>
            window.addEventListener('showToaster',function (event){
                toastr.remove();
                if(event.detail[0].type === 'info'){ toastr.info(event.detail[0].message); }
                else if(event.detail[0].type === 'success'){ toastr.success(event.detail[0].message); }
                else if(event.detail[0].type === 'error'){ toastr.error(event.detail[0].message); }
                else if(event.detail[0].type === 'warning'){ toastr.warning(event.detail[0].message); }
                else { return false;}

            })
            document.addEventListener('livewire:init', ()=>{
                Livewire.on('showToastr',event=>{
                    toastr.remove();
                    if(event[0].type === 'info'){ toastr.info(event[0].message); }
                    else if(event[0].type === 'success'){ toastr.success(event[0].message); }
                    else if(event[0].type === 'error'){ toastr.error(event[0].message); }
                    else if(event[0].type === 'warning'){ toastr.warning(event[0].message); }
                    else { return false;}
                });
            })
        </script>
		<!-- Google Tag Manager (noscript) -->
        @livewireScripts
        @stack('scripts')
		<!-- End Google Tag Manager (noscript) -->
	</body>
</html>
