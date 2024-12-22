@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', [
            'url' => [route('lawsuit.index') => 'Dosyalar', null => 'Evraklar'],
        ])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Liste
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                UDF Dönüştürücü
                            </button>
                            <div class="kt-portlet__head-actions">&nbsp;
                                <a href="#" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal"
                                    data-target="#document_type">
                                    <i class="la la-plus"></i>
                                    Yeni Evrak
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="udf-spinner"></div>
                    <table class="table table-striped table-bordered"
                        id="dataTable">
                        <thead>
                            <tr>
                                <th>Sistem No</th>
                                <th>Oluşturulma Zamanı</th>
                                <th>Evrak</th>
                                <th>Başvurucu</th>
                                <th>Diğer Taraf</th>
                                <th style="width: 120px">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lawsuit->documents as $document)
                                <tr>
                                    <td>{{ $document->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($document->created_at)->format('d.m.Y h:i') }}</td>
                                    <td>
                                        {{ $document->document_type_id == 8 ? $document->name : $document->document_type->name }}
                                    </td>
                                    <td>{{ $lawsuit->claimantName }}</td>
                                    <td>{{ $lawsuit->defendantName }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm"
                                            data-toggle="dropdown">@svg('fas-ellipsis-v')</button>
                                        {{-- <a href="#" class="btn btn-success btn-sm edit_btn">@svg('fas-edit')</a> --}}
                                        {{ Form::open(['url' => route('document.destroy', $document), 'method' => 'DELETE', 'class' => 'd-inline']) }}
                                        <button type="button"
                                            class="btn btn-danger btn-sm delete-btn">@svg('fas-trash-alt')</button>
                                        {{ Form::close() }}
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button type="button" class="dropdown-item print-btn"
                                                data-url="{{ route('document.getcontent', $document) }}">
                                                @svg('fas-print') Yazdır
                                            </button>
                                            <a href="{{ route('document.docx_download', $document) }}"
                                                class="dropdown-item">
                                                @svg('fas-file-word') Word
                                            </a>
                                            <button class="dropdown-item udf_btn" data-id="{{ $document->id }}">
                                                @svg('fas-passport') UDF
                                            </button>
                                            <a href="{{ route('document.pdf_download', $document) }}"
                                                class="dropdown-item">
                                                @svg('fas-file-pdf') PDF
                                            </a>
                                            <a href="{{ route('document.xml_download', $document) }}"
                                                class="dropdown-item">
                                                @svg('fas-file-export') XML
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="next_level">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('document.file_upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="lawsuit_id" value="{{ $lawsuit->id }}">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold">Yeni Evrak</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label">Yüklemek istediğiniz dosyaları seçip ekle butonuna
                                    tıklayın.</label>
                                <input type="file" name="documents[]" multiple>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Ekle</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">İptal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">UDF Dönüştürücü</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="udf-format-file" method="POST" action={{ url('/udf-donusturucu') }}
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" />
                            <button type="submit" class="btn btn-primary">Dönüştür</button>
                        </form>
                        <div class="spinner-border custom-spinner" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
            id="document_type">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">Yeni Evrak Tipi Seçin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <a class="btn btn-primary" href="{{ route('invitation_letter.create', $lawsuit->id) }}">Davet
                            Mektubu</a>
                        <br><br>
                        <a class="btn btn-primary"
                            href="{{ route('arbiter_process_info_protocol.create', $lawsuit->id) }}">Arabuluculuk
                            Sürecine İlişkin Bilgilendirme Tutanağı Oluştur</a>
                        <br><br>
                        <a class="btn btn-primary" href="{{ route('meeting_protocol.create', $lawsuit->id) }}">Toplantı
                            Tutanağı Oluştur</a>
                        <br><br>
                        <a class="btn btn-primary" href="{{ route('agreement_document.create', $lawsuit->id) }}">Anlaşma
                            Belgesi Oluştur</a>
                        <br><br>
                        <a class="btn btn-primary" href="{{ route('wage_agreement.create', $lawsuit->id) }}">Ücret
                            Sözleşmesi Oluştur</a>
                        <br><br>
                        <a class="btn btn-primary" href="{{ route('final_protocol.create', $lawsuit->id) }}">Son Tutanak
                            Oluştur</a>
                        <br><br>
                        <a class="btn btn-primary" href="{{ route('kvkk.create', $lawsuit->id) }}">KVKK Belgesi
                            Oluştur</a>
                        <br><br>
                        <a href="#" class="btn btn-primary" id="next_level_modal_open">
                            <i class="la la-plus"></i>
                            Yeni Evrak Yükle
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if ($lawsuit->documents->count() > 0)
            <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
                id="edit_modal">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{ route('document.update', $document) }}" method="post" id="update_form">
                            @csrf
                            <input type="hidden" name="document_id" value="">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold">Evrak Düzenle</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <textarea id="summernote_template" name="html"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">İptal</button>
                                <a href="javascript:;" class="btn btn-success save_btn" data-id="">Kaydet</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
                id="side_select">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="{{ route('document.update', $document) }}" method="post" id="update_form">
                            @csrf
                            <input type="hidden" name="document_id" value="">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold">Taraf Seçimi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="action" value="print">
                                <div class="kt-checkbox-list" id="document_sides">
                                </div>
                                <div class="print_side" id="print_content"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">İptal</button>
                                <a href="javascript:;" class="btn btn-success side_select">Seç</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif



        <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
            id="preview_modal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">Döküman Önizleme</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body preview_iframe">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/printThis.js') }}?v={{ time() }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("auto-download").click();
        });
    </script>
    <script>

        //docx belge indirme script kodları

        $("#next_level_modal_open").on('click', function(e) {
            e.preventDefault();
            $("#next_level").modal('show');
            $("#document_type").modal('hide');
        });

        $("body").on("click", ".print-btn", function(e) {
            url = $(this).data('url');
            $.get(url, function(response) {
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

        $(".side_select").on("click", function() {
            var side_id = $("input[name='side_id']:checked").val();
            var document_id = $("input[name='side_id']:checked").data('id');

            if ($("input[name='action']").val() == "print") {
                $.ajax({
                    url: '/print_side',
                    type: 'POST',
                    data: {
                        'document_id': document_id,
                        'side_id': side_id,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $("#print_content").html(data);
                        $('#print_content').printThis({
                            importCSS: false,
                            loadCSS: "/css/print.css"
                        });
                    }
                });
            } else {
                download(document_id, $("input[name='action']").val(), side_id);
            }
        });

        $("body").delegate(".pdf_btn", "click", function() {
            var id = $(this).data('id');
            download(id, "pdf");
        });

        $("body").delegate(".word_btn", "click", function() {
            var id = $(this).data('id');
            download(id, "word");
        });

        var preview_modal = $("#preview_modal");

        $("body").delegate(".preview_btn", "click", function() {
            var file_url = $(this).data('url');
            var extension = file_url.split('.').pop();
            $(".preview_iframe").html('Yükleniyor...');
            KTApp.block($("#preview_modal .modal-body"));
            preview_modal.modal('show');
            setTimeout(function() {
                if (extension === "png" || extension === "jpg" || extension === "jpeg") {
                    $(".preview_iframe").html('<img src="' + file_url + '" width="100%">');
                } else {
                    $(".preview_iframe").html(
                        '<iframe style="height:500px;width:100%;" src="https://docs.google.com/viewer?url=' +
                        file_url + '&embedded=true"></iframe>');
                }
            }, 3000);
            KTApp.block($("#preview_modal .modal-body"));
        });

        preview_modal.on('hidden.bs.modal', function() {
            $(".preview_iframe").html('');
        });

        $("body").delegate(".edit_btn", "click", function() {
            var id = $(this).data('id');

            $("input[name='document_id']").val(id);
            $(".save_btn").attr("data-id", id);

            $("#summernote_template").val($('#document-' + id + " #content").html());
            createEditor("#summernote_template");

            $('#edit_modal').modal("show");
        });

        $("body").delegate(".save_btn", "click", function() {
            //$('#edit_modal').modal("hide");

            var id = $(this).data('id');

            $('#document-' + id).find('#content').html($("#summernote_template").val());

            $("#summernote_template").val($('#document-' + id).html());

            $("#update_form").submit();
        });


        function getSides(lawsuit_id, id) {
            $.ajax({
                url: '/document_sides/' + lawsuit_id,
                type: 'GET',
                success: function(data) {
                    var html = '';

                    $.each(data, function(index, value) {
                        html +=
                            '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
                        html += '<input type="radio" name="side_id" value="' + value.id +
                            '" data-id="' + id + '" required>' + value.name;
                        html += '<span></span>';
                        html += '</label>';
                    });

                    $("#document_sides").html(html);
                    $("#side_select").modal("show");
                }
            });
        }
    </script>
@endsection
@section('style')
@endsection
