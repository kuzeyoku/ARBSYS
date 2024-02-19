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
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_archive" data-token="{{ csrf_token() }}">
                    <thead>
                        <tr>
                            <th>DOSYA NUMARASI</th>
                            <th>ARABULUCULUK BÜROSU</th>
                            <th>SON SÜRE</th>
                            <th style="width:230px">İŞLEMLER</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr role="row" class="odd">
                            <td>{{ $item->firm_document_no }}</td>
                            <td>{{ $item->firm }}</td>
                            <td>{{ $item->result_date }}</td>
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