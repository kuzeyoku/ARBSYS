@extends('layout.main')
@section('content')
<div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid row">
            <div class="kt-subheader__main col-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-1" style="background-color: white;">
                        <li class="breadcrumb-item"><a href="/home">Anasayfa</a></li>
                        <li class="breadcrumb-item"><a href="/dosyalar">Dosya Listele</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Arşivlenmiş Dosyalar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @include("admin.alert")
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Arşivlenmiş Dosyalar
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body px-4 py-4">
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
                        @foreach($items as $item)
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
                            <td><a href="{{ route('lawsuit.unArchive', $item) }}" class="btn btn-primary">Arşivden Kaldır</a>
                                <form class="d-inline" action="{{ route('lawsuit.destroy', $item) }}" method="post">
                                    <button type="button" class="btn btn-danger delete-btn"></i> Dosyayı Sil</button>
                                    @csrf
                                    @method('DELETE')
                                </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#kt_table_archive').DataTable({
            responsive: true,
            "order": [
                [2, "desc"]
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Turkish.json"
            },
            "columnDefs": [{
                "targets": 3,
                "orderable": false
            }]
        });
    });
    $(".delete-btn").on('click', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');
        swal.fire({
            title: "Emin misiniz?",
            text: "Bu işlemi geri alamayacaksınız!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Evet, sil!",
            cancelButtonText: "Hayır, iptal et!",
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                form.submit();
            } else if (result.dismiss === "cancel") {
                swal.fire(
                    "İptal edildi",
                    "Dosya silme işlemi iptal edildi.",
                    "error"
                )
            }
        });
    });
</script>
@endsection