<footer id="footer">
    <div class="container">
        <div class="row">

            <div class="col-md-4">

                <div class="footer-item">
                    <div class="company-brand">
                        <img src="/images/site/{{ get_settings()->site_logo }}" alt="logo" class="footer-logo">
                        <p>
                            {{ get_settings()->site_meta_description }}
                        </p>
                        <ul class="address">
                            <li> {{ get_settings()->site_address }}</li>
                            <li> {{ get_settings()->site_email }}</li>
                            <li> {{ get_settings()->site_phone }}</li>

                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-md-2">

                <div class="footer-menu">
                    <h5>About Us</h5>
                    <ul class="menu-list">
                        <li class="menu-item">
                            <a href="#">vision</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">articles </a>
                        </li>
                        <li class="menu-item">
                            <a href="#">careers</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">service terms</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">donate</a>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-md-2">

                <div class="footer-menu">
                    <h5>Discover</h5>
                    <ul class="menu-list">
                        <li class="menu-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Books</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Authors</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Subjects</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Advanced Search</a>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-md-2">

                <div class="footer-menu">
                    <h5>My account</h5>
                    <ul class="menu-list">
                        <li class="menu-item">
                            <a href="#">Sign In</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">View Cart</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">My Wishtlist</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Track My Order</a>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-md-2">

                <div class="footer-menu">
                    <h5>Help</h5>
                    <ul class="menu-list">
                        <li class="menu-item">
                            <a href="#">Help center</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Report a problem</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Suggesting edits</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Contact us</a>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
        <!-- / row -->

    </div>
</footer>

<div id="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="copyright">
                    <div class="row">

                        <div class="col-md-6">
                            <p>© 2022 All rights reserved. Free HTML Template by <a
                                    href="https://www.templatesjungle.com/" target="_blank">TemplatesJungle</a></p>
                        </div>

                        <div class="col-md-6">
                            <div class="social-links align-right">
                                <ul>
                                    <li>
                                        <a href="{{ get_social_network()->facebook_url }}"><i class="icon icon-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ get_social_network()->twitter_url }}"><i class="icon icon-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ get_social_network()->instagram_url }}"><i class="icon icon-youtube-play"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ get_social_network()->youtube_url }}"><i class="icon icon-behance-square"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div><!--grid-->

            </div><!--footer-bottom-content-->
        </div>
    </div>
</div>
