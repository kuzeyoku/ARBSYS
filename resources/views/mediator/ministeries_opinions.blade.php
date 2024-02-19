@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', ['url' => [null => 'Bakanlık Görüşleri ve Duruyuları']])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                @foreach ($items as $item)
                    <div class="col-lg-4">
                        <div class="kt-portlet kt-iconbox kt-iconbox--wave" style="height: 140px">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__icon">
                                        @svg('far-file-pdf')
                                    </div>
                                    <div class="kt-iconbox__desc">
                                        <div class="kt-iconbox__content">
                                            <button type="button" class="btn kt-link view-pdf text-center"
                                                pdf-link="{{ $item->getFileUrl() }}" data-toggle="modal"
                                                data-target="#myModal">{{ $item->title }}</button>
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
                $('#pdf-viewer').attr('src', pdf_link + '#toolbar=0&navpanes=0&scrollbar=0&zoom=150');
                $('#myModal .modal-body').html(iframe);
            });
        });
    </script>
@endsection
