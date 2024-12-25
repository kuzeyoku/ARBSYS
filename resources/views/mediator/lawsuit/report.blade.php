@php use Carbon\Carbon; @endphp
@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-1" style="background-color: white;">
                            <li class="breadcrumb-item"><a href="/home">Anasayfa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Raporlama</li>
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
                            Raporlama
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    {{Form::open(["url" => route('lawsuit.report'), "method" => "post", "class" => "kt-form kt-form--fit"])}}
                    <div class="row kt-margin-b-20">
                        <div class="col-lg-4 kt-margin-b-10-tablet-and-mobile">
                            {{Form::label("application_document_no","Başvuru Dosya No:")}}
                            {{Form::text("application_document_no", null, ["class" => "form-control"])}}
                        </div>
                        <div class="col-lg-4 kt-margin-b-10-tablet-and-mobile">
                            {{Form::label("mediation_document_no","Arabuluculuk Dosya No:")}}
                            {{Form::text("mediation_document_no", null, ["class" => "form-control"])}}
                        </div>
                        <div class="col-lg-4 kt-margin-b-10-tablet-and-mobile">
                            {{Form::label("applicant_date","Başvuru Tarihi:")}}
                            <div class="input-group">
                                {{Form::date("application_date[start]", null, ["class" => "form-control d-inline", "placeholder" => "Başlangıç", "autocomplete" => "off"])}}
                                {{Form::date("application_date[end]", null, ["class" => "form-control kt-input d-inline", "placeholder" => "Bitiş", "autocomplete" => "off"])}}
                            </div>
                        </div>
                    </div>
                    <div class="row kt-margin-b-20">
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            {{Form::label("job_date","Görevin Kabul Tarihi:")}}
                            <div class="input-group">
                                {{Form::date("job_date[start]", null, ["class" => "form-control d-inline", "placeholder" => "Başlangıç", "autocomplete" => "off"])}}
                                {{Form::date("job_date[end]", null, ["class" => "form-control kt-input d-inline", "placeholder" => "Bitiş", "autocomplete" => "off"])}}
                            </div>
                        </div>
                        <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
                            {{Form::label("result_type_id","Sonuç Türü:")}}
                            {{Form::select("result_type_id", $result_types, null, ["class" => "form-control","placeholder" => "--Hepsi--"])}}
                        </div>

                        <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
                            {{Form::label("is_archive","Durum:")}}
                            {{Form::select("is_archive", ["0" => "Aktif", "1" => "Arşivli"], null, ["class" => "form-control kt-input","placeholder" => "--Hepsi--"])}}
                        </div>
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            {{Form::label("result_date","Sonuç Tarihi:")}}
                            <div class="input-group">
                                {{Form::date("result_date[start]", null, ["class" => "form-control kt-input d-inline", "placeholder" => "Başlangıç", "autocomplete" => "off"])}}
                                {{Form::date("result_date[end]", null, ["class" => "form-control kt-input d-inline", "placeholder" => "Bitiş", "autocomplete" => "off"])}}
                            </div>
                        </div>
                        <div class="col-lg-2 kt-margin-t-10-tablet-and-mobile" style="margin-top: 24px;">
                            {{Form::submit("Ara", ["class" => "btn btn-primary"])}}
                            {{Form::reset("Sıfırla", ["class" => "btn btn-secondary"])}}
                        </div>
                    </div>
                    {{Form::close()}}
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-sm"></div>
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th style="width: 150px;">BAŞVURUCU</th>
                            <th style="width: 150px;">KARŞI TARAF</th>
                            <th>YIL</th>
                            <th>BAŞV. DOSYA NO</th>
                            <th>ARB. DOSYA NO</th>
                            <th>UYUŞMAZLIK TÜRÜ</th>
                            <th>BAŞVURU TARİHİ</th>
                            <th>GÖREVİN KABUL TARİHİ</th>
                            <th>SON SÜRE</th>
                            <th>SÜREÇ BİLGİSİ</th>
                            <th>İŞLEMLER</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($lawsuits as $lawsuit)
                            <tr>
                                <td>{{ $lawsuit->claimantName }}</td>
                                <td>{{ $lawsuit->defendantName }}</td>
                                <td>{{ Carbon::parse($lawsuit->application_date)->format("Y") }}</td>
                                <td>{{ $lawsuit->application_document_no }}</td>
                                <td>{{ $lawsuit->mediation_document_number }}</td>
                                <td>{{ $lawsuit->lawsuit_subject_type->name }}</td>
                                <td>{{ Carbon::parse($lawsuit->application_date)->format("d.m.Y") }}</td>
                                <td>{{ Carbon::parse($lawsuit->job_date)->format("d.m.Y") }}</td>
                                <td>{!! $lawsuit->last_time !!}</td>
                                <td>{!! $lawsuit->getProcessStatus() !!}</td>
                                <td>@include("mediator.lawsuit.process", compact("lawsuit"))</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection