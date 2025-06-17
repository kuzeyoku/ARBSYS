@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', ['url' => [null => 'Şablon Düzenle']])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Şablon Düzenle
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="card-body">
                        <div class="alert alert-success">{{ $lawsuitSubjectType->name }} için Tutanak Şablonlarını
                            Düzenliyorsunuz
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <ul class="nav nav-pills nav-fill" role="tablist">
                                    @if ($lawsuitSubject)
                                        @foreach ($lawsuitSubject->documentTypeTemplate as $template)
                                            <li class="nav-item border mb-2">
                                                <a class="nav-link {{ $loop->first ? 'active show' : '' }}"
                                                   data-toggle="tab"
                                                   href="#tab_{{ $template->id }}">{{ $template->documentType->name }}</a>
                                            </li>
                                        @endforeach
                                    @else
                                        @foreach ($lawsuitSubjectType->documentTypeTemplate->whereNull("lawsuit_subject_id") as $template)
                                            <li class="nav-item border mb-2">
                                                <a class="nav-link {{ $loop->first ? 'active show' : '' }}"
                                                   data-toggle="tab"
                                                   href="#tab_{{ $template->id }}">{{ $template->documentType->name }}</a>
                                            </li>
                                        @endforeach
                                        <li class="nav-item">
                                            <a class="btn btn-block btn-success"
                                               href="{{ route('admin.template.create') }}">Yeni Şablon Ekle</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-lg-9">
                                <div class="tab-content mb-2">
                                    @if ($lawsuitSubject)
                                        @foreach ($lawsuitSubject->DocumentTypeTemplate as $template)
                                            <div class="tab-pane {{ $loop->first ? 'active' : '' }}"
                                                 id="tab_{{ $template->id }}" role="tabpanel">
                                                <div class="card mb-3">
                                                    <div class="card-header bg-secondary">Değişkenler</div>
                                                    <div class="card-body">
                                                        <div class="row mb-2">
                                                            @foreach ($template->documentType->getKeywords() as $keyword)
                                                                <div class="col-lg-2 mb-2">
                                                                    <div class="badge badge-success">
                                                                        {{ $keyword }}
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                {{ Form::open(['url' => route('admin.template.update', $template), 'method' => 'PUT']) }}
                                                <div class="form-group">
                                                    {{ Form::textarea('html', $template->html, ['class' => 'summernote']) }}
                                                </div>
                                                {{ Form::submit('Kaydet', ['class' => 'btn btn-primary']) }}
                                                {{ Form::close() }}
                                            </div>
                                        @endforeach
                                    @else
                                        @foreach ($lawsuitSubjectType->documentTypeTemplate as $template)
                                            <div class="tab-pane {{ $loop->first ? 'active' : '' }}"
                                                 id="tab_{{ $template->id }}" role="tabpanel">
                                                <div class="card mb-3">
                                                    <div class="card-header bg-secondary">Değişkenler</div>
                                                    <div class="card-body">
                                                        <div class="row mb-2">
                                                            @foreach ($template->documentType->getKeywords() as $keyword)
                                                                <div class="col-lg-2 mb-2">
                                                                    <div class="badge badge-success">
                                                                        {{ $keyword }}
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                {{ Form::open(['url' => route('admin.template.update', $template), 'method' => 'PUT']) }}
                                                <div class="form-group">
                                                    {{ Form::textarea('html', $template->html, ['class' => 'summernote']) }}
                                                </div>
                                                {{ Form::submit('Kaydet', ['class' => 'btn btn-primary']) }}
                                                {{ Form::close() }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
