@extends('layouts.main')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <!-- Services -->
    <div class="services">
        <div class="container">
            <div class="main-title">
                <span><em></em></span>
                <h2 id="orderFood">Testimoni</h2>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    @if ($testimonis->count() > 0)
                        <div class="row">
                            @foreach ($testimonis as $testimoni)
                                <div class="card col-lg-4">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $testimoni->member->name }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            {{ Carbon::parse($testimoni->created_at)->isoFormat('LL') }}</h6>
                                        <p class="card-text">{{ $testimoni->testimoni }}.</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>Testimoni belum tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
