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
                    <div class="dropdown mb-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                            Sütunları Seç
                        </button>
                        <ul class="dropdown-menu" id="columnToggleMenu">
                            <!-- JS ile otomatik olarak doldurulacak -->
                        </ul>
                    </div>
                    <table class="table table-striped table-bordered" id="dataTable1">
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
                                <td>{{ \Carbon\Carbon::parse($lawsuit->application_date)->format('Y') }}</td>
                                <td>{{ $lawsuit->application_document_no }}</td>
                                <td>{{ $lawsuit->mediation_document_no }}</td>
                                <td>{{ $lawsuit->lawsuit_subject_type->name ?? null }}</td>
                                <td>{{ $lawsuit->application_date }}</td>
                                <td>{{ $lawsuit->job_date }}</td>
                                <td>{!! $lawsuit->dead_line['code'] !!}</td>
                                <td>{!! $lawsuit->getProcessStatus() !!}</td>
                                <td>
                                    <button data-id="{{$lawsuit->id}}" class="btn btn-sm btn-primary lawsuit-detail"><i
                                                class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="lawsuit-detail-area" id=""></div>
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
    <script src="{{ asset('js/printThis.js') }}?v={{ time() }}"></script>
    <script>
        $(document).on("click", ".print-btn", function (e) {
            url = $(this).data('url');
            $.get(url, function (response) {
                if (response.status)
                    $(response.content).printThis({
                        importCSS: false,
                        loadCSS: "/css/print.css"
                    });
                else
                    swal.fire({
                        title: 'Hata!',
                        text: "Bir Hata Oluştu!",
                        type: 'error',
                        confirmButtonText: 'Tamam'
                    });
            });
        });
    </script>
    @if (Request::get('tutanak'))
        <script>
            $('#tutanak').modal('show')
        </script>
    @endif

    <script>
        $(document).on("click", ".lawsuit-detail", function () {
            let lawsuitId = $(this).data('id');
            let lawsuitDetailArea = $(".lawsuit-detail-area");
            if (lawsuitDetailArea.attr("id") === lawsuitId.toString()) {
                lawsuitDetailArea.html('');
                lawsuitDetailArea.removeAttr("id");
                return;
            }
            let url = "{{ route('lawsuit.getDetail') }}";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    lawsuit_id: lawsuitId
                },
                success: function (response) {
                    lawsuitDetailArea.html(response);
                    lawsuitDetailArea.attr("id", lawsuitId);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            const table = $('#dataTable1').DataTable();
            table.columns().every(function (index) {
                const column = this;
                const title = $(column.header()).text();
                const checkbox = $(`
            <li>
                <label class="dropdown-item">
                    <input type="checkbox" class="toggle-column" data-column-index="${index}" checked>
                    ${title}
                </label>
            </li>
        `);

                $('#columnToggleMenu').append(checkbox);
            });

            // Checkbox değişiminde sütunu göster/gizle
            $('#columnToggleMenu').on('change', '.toggle-column', function () {
                const column = table.column($(this).data('column-index'));
                column.visible(this.checked);
            });
        });
    </script>
@endsection
