@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', ['url' => [null => 'Bakanlık Görüşleri']])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Bakanlık Görüşleri
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    {{ Form::open(['url' => route('admin.ministeries_opinions.store'), 'method' => 'POST', 'files' => true]) }}
                    <div class="form-group">
                        {{ Form::label('Başlık') }}
                        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Başlık Giriniz']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Dosya') }}
                        <div>
                            {{ Form::file('file', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Durum') }}
                                {{ Form::select('status', [1 => 'Aktif', 0 => 'Pasif'], 'default', ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Sıra') }}
                                {{ Form::number('order', 0, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::submit('Kaydet', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
