@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', [
            'url' => [null => 'Görüş ve Öneri Oluştur'],
        ])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Oluştur
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    {{ Form::open(['url' => route('system_request.store'), 'method' => 'post']) }}
                    <div class="form-group">
                        {{ Form::label('Türü') }}
                        {{ Form::select('request_type', $systemRequestCategories, null, ['class' => 'form-control', 'placeholder' => '--Seçiniz--']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Başlık') }}
                        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Başlık Giriniz']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Açıklama') }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Açıklama Yazınız', 'rows' => 5]) }}
                    </div>
                    {{ Form::submit('Gönder', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/plugins/summernote/summernote.js') }}"></script>
    <script src="{{ asset('js/plugins/summernote/summernote-tr-TR.js') }}"></script>
@endsection
