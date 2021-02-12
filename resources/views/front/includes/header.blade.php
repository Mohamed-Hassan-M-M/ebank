<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>


<header class="site-navbar js-sticky-header site-navbar-target" role="banner">

    <div class="container">
        <div class="row align-items-center">

            <div class="col-6 col-xl-2">
                <h1 class="mb-0 site-logo"><a href="{{route('website.home')}}" class="h2 mb-0" @if(\Illuminate\Support\Facades\Request::is('user/*')) style="color: #007bff !important;" @endif >Finances<span class="text-primary">.</span> </a></h1>
            </div>

            <div class="col-12 col-md-10 d-none d-xl-block">
                <nav class="site-navigation position-relative text-right" role="navigation">

                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                        @auth
                        <li class="has-children">
                            <a class="nav-link" style="font-weight: bolder;color: forestgreen !important;">{{auth('web')->user()->username}}</a>
                            <ul class="dropdown text-center" style="max-width: 100%;">
                                <li style="min-width: 100%;"><a class="nav-link">Balance: {{auth('web')->user()->balance}} $</a></li>
                                <li style="min-width: 100%;"><a href="{{route('account.index')}}" class="nav-link">Share Home</a></li>
                                <li style="min-width: 100%;"><a href="{{route('account.manageaccount')}}" class="nav-link">Manage Account</a></li>
                                <li style="min-width: 100%;"><a href="{{route('account.ourservice')}}" class="nav-link">Our Services</a></li>
                                <li style="min-width: 100%;"><a href="{{route('account.transfer')}}" class="nav-link">Transfer Money</a></li>
                                <li style="min-width: 100%;"><a href="{{route('account.transaction')}}" class="nav-link">Transactions</a></li>
                                <li style="min-width: 100%;"><a href="{{route('user.logout')}}" class="nav-link">Logout</a></li>
                            </ul>
                        </li>
                        @else
                            <li><a href="{{route('website.home')}}" class="nav-link" @if(\Illuminate\Support\Facades\Request::is('user/*')) style="color: #000 !important;" @endif >Home</a></li>
                            <li class="has-children">
                                <a href="#about-section" class="nav-link" @if(\Illuminate\Support\Facades\Request::is('user/*')) style="color: #000 !important;" @endif >About Us</a>
                                <ul class="dropdown">
                                    <li><a href="#faq-section" class="nav-link">FAQ</a></li>
                                    <li><a href="#gallery-section" class="nav-link">Gallery</a></li>
                                    <li><a href="#services-section" class="nav-link">Services</a></li>
                                </ul>
                            </li>
                            <li><a href="#blog-section" class="nav-link" @if(\Illuminate\Support\Facades\Request::is('user/*')) style="color: #000 !important;" @endif >Blog</a></li>
                            <li><a href="#contact-section" class="nav-link" @if(\Illuminate\Support\Facades\Request::is('user/*')) style="color: #000 !important;" @endif >Contact</a></li>
                            <li><a href="{{route('user.login')}}" class="nav-link">Login</a>|<a href="{{route('user.register')}}" class="nav-link">Register</a></li>
                        @endauth
                    </ul>
                </nav>
            </div>


            <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3" @if(\Illuminate\Support\Facades\Request::is('user/*')) style="color: #000 !important;" @endif ></span></a></div>

        </div>
    </div>

</header>
@if(\Illuminate\Support\Facades\Request::is('/*'))
</div>
@endif
