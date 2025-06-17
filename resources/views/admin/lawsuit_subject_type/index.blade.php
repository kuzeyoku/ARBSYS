@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-1" style="background-color: white;">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Anasayfa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Uyuşmazlık Türleri</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Uyuşmazlık Türleri & Uyuşmazlık Konuları
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <div class="row">
                        <div class="col-lg-6">
                            {{ Form::open(['url' => route('admin.lawsuit_subject_type.store'), 'method' => 'POST']) }}
                            <div class="form-group">
                                {{ Form::label('Uyuşmazlık Türü') }}
                                {{ Form::text('lawsuit_subject_type_name', null, ['class' => 'form-control', 'placeholder' => 'Uyuşmazlık Türü Başlığı Giriniz']) }}
                            </div>
                            {{ Form::submit('Kaydet', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-lg-6">
                            {{ Form::open(['url' => route('admin.lawsuit_subject.store'), 'method' => 'POST']) }}
                            <div class="form-group">
                                {{ Form::label('Uyuşmazlık Türü') }}
                                {{ Form::select('lawsuit_subject_type', App\Models\Lawsuit\LawsuitSubjectType::selectToArray(), 'default', ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Uyuşmazlık Konusu') }}
                                {{ Form::text('lawsuit_subject_name', null, ['class' => 'form-control', 'placeholder' => 'Uyuşmazlık Konusu Giriniz']) }}
                            </div>
                            {{ Form::submit('Kaydet', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>

                    <hr>
                    <ul class="list-group">
                        @foreach (App\Models\Lawsuit\LawsuitSubjectType::all() as $item)
                            <li class="list-group-item mb-2 bg-secondary">{{ $item->name }}
                                {{ Form::open(['url' => route('admin.lawsuit_subject_type.destroy', $item), 'method' => 'DELETE', 'class' => 'd-inline']) }}
                                <button type="button" class="btn btn-sm btn-danger float-right delete-btn"><i
                                        class="fas fa-times"></i></button>
                                {{ Form::close() }}
                            </li>
                            <ul class="list-group">
                                @foreach ($item->lawsuitSubjects as $subject)
                                    <li class="list-group-item mb-2 ml-5">
                                        {{ $subject->name }}
                                        {{ Form::open(['url' => route('admin.lawsuit_subject.destroy', $subject), 'method' => 'DELETE', 'class' => 'd-inline']) }}
                                        <button type="button" class="btn btn-sm btn-danger float-right delete-btn"><i
                                                class="fas fa-times"></i></button>
                                        {{ Form::close() }}
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>

    </div>
@endsection
