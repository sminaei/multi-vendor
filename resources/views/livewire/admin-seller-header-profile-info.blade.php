<div>
    @if(Auth::guard('admin')->check())
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a
                    class="dropdown-toggle"
                    href="#"
                    role="button"
                    data-toggle="dropdown"
                >
							<span class="user-icon">
								<img src="back/vendors/images/photo1.jpg" alt="" />
							</span>
                    <span class="user-name">Ross C. Lopez</span>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                >
                    <a class="dropdown-item" href="{{ route('seller.profile') }}"
                    ><i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('admin.settings') }}"
                    ><i class="dw dw-settings2"></i> Settings</a
                    >
                    <a class="dropdown-item" href="faq.html"
                    ><i class="dw dw-help"></i> Help</a
                    >
                    <a class="dropdown-item" href="{{route('seller.logout')}}"
                       onclick="event.preventDefault();document.getElementById('sellerLogoutForm').submit();"
                    ><i class="dw dw-logout"></i> Log Out</a
                    >
                    <form action="{{route('seller.logout')}}" id="adminLogoutForm" method="post" id="sellerLogoutForm">@csrf</form>
                </div>
            </div>
        </div>
    @elseif(Auth::guard('seller')->check())

    @endif
</div>
