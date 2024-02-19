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
                <form class="kt-form kt-form--fit" action="{{ route('lawsuit.report') }}" method="post">
                    @csrf
                    <div class="row kt-margin-b-20">
                        <div class="col-lg-4 kt-margin-b-10-tablet-and-mobile">
                            <label>Başvuru Dosya No:</label>
                            <input type="text" class="form-control kt-input" name="firm_document_no">
                        </div>
                        <div class="col-lg-4 kt-margin-b-10-tablet-and-mobile">
                            <label>Arabuluculuk Dosya No:</label>
                            <input type="text" class="form-control kt-input" name="soother_document_no">
                        </div>
                        <div class="col-lg-4 kt-margin-b-10-tablet-and-mobile">
                            <label>Başvuru Tarihi:</label>
                            <div class="input-daterange input-group kt_datepicker">
                                <input type="text" class="form-control kt-input" name="application_date[start]" placeholder="Başlangıç" autocomplete="off" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                </div>
                                <input type="text" class="form-control kt-input" name="application_date[end]" placeholder="Bitiş" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="row kt-margin-b-20">
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <label>Görevin Kabul Tarihi:</label>
                            <div class="input-daterange input-group kt_datepicker">
                                <input type="text" class="form-control kt-input" name="job_date[start]" placeholder="Başlangıç" autocomplete="off" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                </div>
                                <input type="text" class="form-control kt-input" name="job_date[end]" placeholder="Bitiş" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
                            <label>Sonuç Türü:</label>
                            <select class="form-control kt-input" name="result_type_id">
                                <option value="">Hepsi</option>
                                @foreach($result_types as $result_type)
                                <option value="{{ $result_type->id }}">{{ $result_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 kt-margin-b-10-tablet-and-mobile">
                            <label>Arşivli:</label>
                            <select class="form-control kt-input" name="is_archive">
                                <option value="">Hepsi</option>
                                <option value="0">Derdest</option>
                                <option value="1">Arşivli</option>
                            </select>
                        </div>
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <label>Sonuç Tarihi:</label>
                            <div class="input-daterange input-group kt_datepicker">
                                <input type="text" class="form-control kt-input" name="result_date[start]" placeholder="Başlangıç" autocomplete="off" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                </div>
                                <input type="text" class="form-control kt-input" name="result_date[end]" placeholder="Bitiş" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-lg-2 kt-margin-t-10-tablet-and-mobile" style="margin-top: 24px;">
                            <button type="submit" class="btn btn-primary btn-brand--icon">
                                <span>
                                    <i class="la la-search"></i>
                                    <span>Ara</span>
                                </span>
                            </button>
                            &nbsp;&nbsp;
                            <button class="btn btn-secondary btn-secondary--icon" type="reset">
                                <span>
                                    <i class="la la-close"></i>
                                    <span>Sıfırla</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
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
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->claimantName }}</td>
                            <td>{{ $item->defendantName }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->application_date)->format("Y") }}</td>
                            <td>{{ $item->firm_document_number }}</td>
                            <td>{{ $item->soother_document_number }}</td>
                            <td>{{ $item->lawsuit_subject_type->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->application_date)->format("d.m.Y") }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->job_date)->format("d.m.Y") }}</td>
                            <td>{!! $item->last_time !!}</td>
                            <td>{!! $item->getProcessStatus() !!}</td>
                            <td>@include("backend.pages.lawsuit.process", compact("item"))</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="dosya-sistemden-kapatildi">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Dosya Sistemden Kapatıldı?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Son Tutanak, arabulucu Portal üzerinden Hukuk İşleri Genel Müdürlüğü’ne gönderildi mi?
                    <form action="lawsuit_process_type_update" method="POST" id="dosya-sistemden-kapatildi-form">
                        @csrf
                        <input type="hidden" name="lawsuit_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır</button>
                    <button type="button" class="btn btn-success" id="dosya-sistemden-kapatildi-evet">Evet</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="agreement_type_modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Toplantı Tutanağı Sonucu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="lawsuit_agreement_type_update" method="POST" id="agreement-type-form">
                        @csrf
                        <input type="hidden" name="lawsuit_id">
                        <input type="hidden" name="agreement_type_id">
                    </form>
                    <div class="form-group">
                        <label>Hangi konuda anlaşma sağlandı?</label>
                        <div class="kt-checkbox-list">
                            @foreach($agreement_types->where('back_to_work', true) as $type)
                            <label class="kt-checkbox">
                                <input type="radio" name="subject_answer" value="{{ $type->id }}" data-template="{{ $type->description }}"> {{ $type->name }}
                                <span></span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Sonuç</label>
                        <textarea class="form-control subject_answer_result" disabled></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-lg agreement_type_modal_ok">Tamam</button>
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">İptal</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection