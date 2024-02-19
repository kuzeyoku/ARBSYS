@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', ['url' => [null => 'Şablon İşlemleri']])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label w-100  d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand flaticon2-line-chart"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Şablon İşlemleri
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    {{ Form::open(['url' => route('admin.template.store'), 'method' => 'post']) }}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Uyuşmazlık Türü') }}
                                {{ Form::select('lawsuit_subject_type', $lawsuitSubjectTypes, 'default', ['class' => 'form-control', 'placeholder' => '--Seçiniz--', 'required' => '']) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Döküman Tipi') }}
                                {{ Form::select('document_type', $documentTypes, 'default', ['class' => 'form-control', 'placeholder' => '--Seçiniz--', 'required' => '']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('Şablon Kodu') }}
                        {{ Form::textarea('html', null, ['class' => 'summernote']) }}
                    </div>

                    {{ Form::submit('Kaydet', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
