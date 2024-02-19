@extends('layout.main')
@section('content')
    <div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid row">
                <div class="kt-subheader__main col-10">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-1" style="background-color: white;">
                            <li class="breadcrumb-item"><a href="/home">Anasayfa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dosya Listele</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-2">
                    <div class="kt-form__actions mt-2">
                        <a href="{{ route('lawsuit.archive_index') }}" style="width: 100%;"
                            class="btn btn-warning justify-content-center align-items-center">Arşivlenmiş Dosyalar</a>
                    </div>
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
                            Dosyalarım
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body py-4 px-4">
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
                                    <td>{{ \Carbon\Carbon::parse($item->application_date)->format('Y') }}</td>
                                    <td>{{ $item->application_document_no }}</td>
                                    <td>{{ $item->mediation_document_no }}</td>
                                    <td>{{ $item->lawsuit_subject_type->name ?? null }}</td>
                                    <td>{{ $item->application_date }}</td>
                                    <td>{{ $item->job_date }}</td>
                                    <td>{!! $item->last_time !!}</td>
                                    <td>{!! $item->getProcessStatus() !!}</td>
                                    <td>@include('mediator.lawsuit.process', compact('item'))</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
            id="dosya-sistemden-kapatildi">
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
                                @foreach ($agreement_types->where('back_to_work', true) as $type)
                                    <label class="kt-checkbox">
                                        <input type="radio" name="subject_answer" value="{{ $type->id }}"
                                            data-template="{{ $type->description }}"> {{ $type->name }}
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
    @if (Request::get('tutanak'))
        <div class="modal fade" id="tutanak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bilgilendirme Tutanağı</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Dosyanıza arabuluculuk sürecine ilişkin bilgilendirme tutanağı oluşturarak
                        devam etmek ister misiniz ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">HAYIR</button>
                        <a href="{{ route('arbiter_process_info_protocol.create', Request::get('tutanak')) }}"
                            class="btn btn-success">EVET</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('script')
    <script>
        $("body").addClass("kt-aside--minimize");
    </script>
    @if (Request::get('tutanak'))
        <script>
            $('#tutanak').modal('show')
        </script>
    @endif
@endsection
