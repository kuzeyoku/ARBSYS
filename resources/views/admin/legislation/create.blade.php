@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', [
            'url' => [null => 'Mevzuat Sayfası Oluştur'],
        ])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Mevzuat Sayfası Oluştur
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    {{ Form::open(['url' => route('admin.legislation.store'), 'method' => 'POST']) }}
                    <div class="form-group">
                        {{ Form::label('Sayfa Başlığı') }}
                        {{ Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => 'Sayfa Başlığı Giriniz.']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Açıklama') }}
                        {{ Form::textarea('content', old('content'), ['class' => 'form-control summernote']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Durum') }}
                        {{ Form::select('status', [1 => 'Aktif', 0 => 'Pasif'], old('status'), ['class' => 'form-control']) }}
                    </div>
                    {{ Form::submit('Gönder', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
