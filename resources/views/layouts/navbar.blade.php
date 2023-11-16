<!-- Header -->
<header class="main-header sticky">
    <a href="#menu" class="btn-mobile">
        <div class="hamburger hamburger--spin" id="hamburger">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
    </a>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div id="logo">
                    <h1><a href="/" title="UmiTikaCatering">Umi Tika Catering</a></h1>
                </div>
            </div>
            <div class="col-lg-9 col-6">
                <ul id="menuIcons">
                    @guest
                        <li><a href="/login" title="login"><i class="icon icon-enter"></i></a></li>
                    @endguest
                    @auth
                        <li><a href="keranjang"><i class="icon icon-shopping-cart2"></i></a></li>

                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" title="logout" class="button-a"><i
                                        class="icon icon-exit"></i></button>
                            </form>
                        </li>
                    @endauth
                </ul>
                <!-- Menu -->
                <nav id="menu" class="main-menu">
                    <ul>
                        <li><span><a href="/">Beranda</a></span></li>
                        @cannot('admin')
                            <li><span><a href="/catering">Catering</a></span></li>
                        @endcannot
                        {{-- <li>
                            <span><a href="#">Order <i class="fa fa-chevron-down"></i></a></span>
                            <ul>
                                <li>
                                    <span><a href="#">Pay online</a></span>
                                    <ul>
                                        <li><a href="pay-with-card-online/">Demo 1 - Filtering</a></li>
                                        <li><a href="pay-with-card-online/order-2.php">Demo 2 - Sticky navigation</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <span><a href="#">Pay with cash</a></span>
                                    <ul>
                                        <li><a href="pay-with-cash-on-delivery/">Demo 1 - Filtering</a></li>
                                        <li><a href="pay-with-cash-on-delivery/order-2.php">Demo 2 - Sticky navigation</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li> --}}
                        <li><span><a href="/tentang-kami">Tentang Kami</a></span></li>
                        <li><span><a href="/testimoni">Testimoni</a></span></li>
                        @can('admin')
                            <li><span><a href="/admin/index">Dashboard Admin</a></span></li>
                        @endcan
                        @can('member')
                            <li><span><a href="/member/profile">Profile</a></span></li>
                        @endcan
                    </ul>
                </nav>
                <!-- Menu End -->
            </div>
        </div>
    </div>
</header>
<!-- Header End -->
