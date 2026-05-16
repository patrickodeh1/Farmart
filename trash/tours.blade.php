@php
    Theme::layout('full-width');
    Theme::set('bodyClass', 'rezgo-tours-page');
@endphp

<div class="bg-light py-md-5 px-lg-3 px-2">
    <div class="container-xxxl">

        <div class="row align-items-center mb-4">
            <div class="col">
                <h1 class="fs-4 fw-bold mb-0">{{ __('Available Tours & Tickets') }}</h1>
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (empty($tours))
            <div class="alert alert-info">No tours available at this time.</div>
        @else
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($tours as $tour)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            @if ($tour['image'])
                                <img src="{{ $tour['image'] }}" class="card-img-top" alt="{{ $tour['title'] }}" style="height:200px; object-fit:cover;">
                            @else
                                <div class="bg-secondary" style="height:200px;"></div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fs-6 fw-bold">{{ $tour['title'] }}</h5>
                                @if ($tour['location'])
                                    <p class="text-muted small mb-2">
                                        <i class="ti ti-map-pin"></i> {{ $tour['location'] }}
                                    </p>
                                @endif
                                <div class="mt-auto">
                                    @if ($tour['starting'] > 0)
                                        <p class="fw-bold text-primary mb-2">From ${{ number_format($tour['starting'], 2) }}</p>
                                    @else
                                        <p class="fw-bold text-primary mb-2">Price varies by date</p>
                                    @endif
                                    <a href="{{ route('rezgo.storefront.tour', $tour['uid']) }}"
                                       class="btn btn-primary w-100">
                                        {{ __('View & Book') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
