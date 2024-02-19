@extends('layout.main')
@section('content')
    @php
        $files = [
            1 => '1) Savcılığa Kesilecek Makbuz Örneği (2018)',
            2 => '2) Savcılığa Kesilecek Makbuz Örneği (2019)',
            3 => '3) Savcılığa Kesilecek Makbuz Örneği (2020) - V3',
            4 => '4) Savcılığa Kesilecek Makbuz Örneği (2020-2021)',
            5 => '5) Savcılığa Kesilecek Makbuz Örneği (2022) - V1',
            6 => '6) Savcılığa Kesilecek Makbuz Örneği (2023) - V3',
            7 => '7) Savcılığa Kesilecek Makbuz Örneği (2023) - V4',
            8 => '8) Savcılığa Kesilecek Makbuz Örneği (2023) - V8',
            9 => '9) Savcılığa Kesilecek Makbuz Örneği (2024) - V3',
        ];
    @endphp
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', [
            'url' => [
                '/hesaplama-araclari' => 'Hesaplama Araçları',
                null => 'Savcılıklara Düzenlenecek Makbuz Örnekleri',
            ],
        ]);
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                @foreach ($files as $file => $title)
                    <div class="col-lg-6">
                        <div class="kt-portlet kt-iconbox kt-iconbox--wave" style="height: 140px">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                            class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path
                                                    d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <rect fill="#000000" x="6" y="11" width="9" height="2"
                                                    rx="1" />
                                                <rect fill="#000000" x="6" y="15" width="5" height="2"
                                                    rx="1" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                        </h3>
                                        <div class="kt-iconbox__content">
                                            <button type="button" class="btn kt-link view-pdf text-left"
                                                pdf-link="{{ asset('makbuz-ornekleri/' . $file . '.pdf') }}"
                                                data-toggle="modal" data-target="#myModal">{{ $title }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <embed id="pdf-viewer" src="" frameborder="0" width="100%" height="800px">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.view-pdf').click(function() {
                var pdf_link = $(this).attr('pdf-link');
                $('#pdf-viewer').attr('src', pdf_link + '#toolbar=0&navpanes=0&scrollbar=0&zoom=100');
                $('#myModal .modal-body').html(iframe);
            });
        });
    </script>
@endsection
