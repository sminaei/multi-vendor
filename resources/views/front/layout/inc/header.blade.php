<header id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="main-logo">
                    <a href="/"><img src="/images/site/ {{ get_settings()->site_logo }}" alt="logo"></a>
                </div>
            </div>
            <div class="col-md-10">
                <nav id="navbar">
                    <div class="main-menu stellarnav">
                        <ul class="menu-list">
                            <li class="menu-item active"><a href="#home">Home</a></li>
                            <li class="menu-item has-sub">
                                <a href="#pages" class="nav-link">Pages</a>
                                @if(count(get_categories()) > 0)
                                    @foreach(get_categories() as $category)

                                <ul>
                                    <img src="/images/categories/{{ $category->$category_image }}">
                                 {{ $category->category_name }}
                                    @if(count($category->subcategories) > 0 )

                                    @endif
                               @foreach($category->subcategories as $subcategory)
                                        @if($subcategories->is_child_of == 0) > 0 )
                                    <div>
                                    <h5>{{ $subcategory->$subcategory_name }}</h5>
                                    </div>
                                        @if(count($subcategory->children) > 0 )
                                            <li class="menu-item"><a href="#featured-books" class="nav-link"></a></li>
                                            @foreach($subcategory->children as $child_subcategory)
                                                <li class="menu-item"><a href="#popular-books" class="nav-link">
                                                        {{ $child_subcategory->subcategory_name }}
                                                    </a></li>
                                            @endforeach
                                        @endif
                                        @endif
                               @endforeach
                                </ul>

                            </li>
{{--                            <li class="menu-item"><a href="#featured-books" class="nav-link">Featured</a></li>--}}
{{--                            <li class="menu-item"><a href="#popular-books" class="nav-link">Popular</a></li>--}}
{{--                            <li class="menu-item"><a href="#special-offer" class="nav-link">Offer</a></li>--}}
{{--                            <li class="menu-item"><a href="#latest-blog" class="nav-link">Articles</a></li>--}}
{{--                            <li class="menu-item"><a href="#download-app" class="nav-link">Download App</a></li>--}}
                        </ul>
                        @endforeach
                        @endif
                        <div class="hamburger">
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </div>

                    </div>
                </nav>

            </div>

        </div>
    </div>
</header>
