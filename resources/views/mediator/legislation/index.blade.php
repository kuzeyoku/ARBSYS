@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', ['url' => [null => 'İlgili Mevzuat']])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                @foreach ($legislations as $legislation)
                    <div class="col-lg-4">
                        <a href="{{ route('legislation.show', [$legislation, $legislation->slug]) }}">
                            <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__icon">
                                            @svg('far-file-alt')
                                        </div>
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                            </h3>
                                            <div class="kt-iconbox__content">
                                                <p class="kt-link">{{ $legislation->title }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
