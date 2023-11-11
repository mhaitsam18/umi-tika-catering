@extends('layouts.main')
@section('content')
    <!-- Hero -->
    {{-- <div class="hero-home bg-mockup hero-bottom-border">
        <div class="content">
            <h1 class="animated-element">Umi Tika Catering</h1>
            <p class="animated-element">Pesan Catering hari ini atau besok lapar.</p>
            <a href="/catering" class="btn-1 medium animated-element">Yuk Order</a>
            <a href="#orderFood" class="mouse-frame nice-scroll">
                <div class="mouse"></div>
            </a>
        </div>
    </div> --}}
    <!-- Hero End -->

    <!-- Services -->
    <div class="services">
        <div class="container">
            <div class="main-title">
                <span><em></em></span>
                <h2 id="orderFood">Pesan Catering</h2>
                <p>Choosing one of the payment methods</p>
            </div>
            <div class="row">
                <div class="col-lg-6 animated-element">
                    <a href="pay-with-card-online/" class="service-link">
                        <div class="box text-center">
                            <div class="icon d-flex align-items-end"><i class="icon icon-credit-card2"></i></div>
                            <h3 class="service-title">Pay Online</h3>
                            <p>and wait for delivery</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 animated-element">
                    <a href="pay-with-cash-on-delivery/" class="service-link">
                        <div class="box text-center">
                            <div class="icon d-flex align-items-end"><i class="icon icon-wallet"></i></div>
                            <h3 class="service-title">Pay with cash</h3>
                            <p>when food is arrived to you</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    <div class="banner animated-element">
        <div class="container">
            <div class="content">
                <div class="mask">
                    <div class="textbox">
                        <small>Umi Tika Delivery</small>
                        <h2>Umi Tika Catering</h2>
                        <p>Pesan Catering sekarang! dari pada besok lapar.</p>
                        <a href="/catering" class="btn-1">Yuk Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
