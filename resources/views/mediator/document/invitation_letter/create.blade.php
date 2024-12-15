@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor invitation_letter" id="kt_content">

        @include('layout.breadcrumb', [
            'url' => [route('lawsuit.index') => 'Dosyalar', null => 'Davet Mektubu Oluştur'],
        ])

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

                @include('mediator.document.nav', [
                    'nav' => [
                        1 => 'Taraf Seçimi',
                        2 => 'Toplantı Bilgileri',
                        3 => 'Uyuşmazlık Özeti',
                        4 => 'Önizleme',
                        5 => 'Bitir',
                    ],
                ])

                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                {{ Form::open(['url' => route('invitation_letter.store', $lawsuit), 'method' => 'POST', 'class' => 'kt-form', 'id' => 'kt_form']) }}
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                     data-ktwizard-state="current">
                                    <div class="kt-heading kt-heading--md">Hangi taraf(lar) için davet mektubu
                                        hazırlamak istiyorsunuz?
                                    </div>
                                    @include('mediator.document.layout.side_select')
                                </div>
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Toplantı Bilgileri</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group">
                                                {{ Form::label('Toplantı Tarihi') }}
                                                {{ Form::text('meeting_date', $lawsuit->meeting_date, ['class' => 'form-control datepicker']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('Toplantı Saati') }}
                                                {{ Form::text('meeting_start_hour', $lawsuit->meeting_start_hour, ['class' => 'form-control timepicker']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('Toplantı Yeri') }}
                                                {{ Form::select('mediation_center', App\Models\MediationCenter::selectToArray(), $lawsuit->mediation_center ?? auth()->user()->mediator->meeting_address_proposal ? auth()->user()->mediator->mediation_center_id : null, ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::checkbox('meeting_address_check', true, false, ['id' => 'meeting_address_check']) }}
                                                {{ Form::label('Adresi Elle Gir') }}
                                            </div>
                                            <div class="form-group" style="display: none" id="meeting_address">
                                                {{ Form::label('Toplantı Adresi') }}
                                                {{ Form::text('meeting_address', null, ['class' => 'form-control', 'placeholder' => 'Açık Adres Giriniz']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Uyuşmazlık Özeti</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group">
                                                <label>Uyuşmazlık özeti yazmak ister misiniz?</label>
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox">
                                                        <input type="radio" name="want_write" value="1"> Evet
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox">
                                                        <input type="radio" name="want_write" value="0"> Hayır
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group" style="display: none;"
                                                 id="each_side_write_question">
                                                <label>Her taraf için ayrı uyuşmazlık özeti yazmak ister
                                                    misiniz?</label>
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox">
                                                        <input type="radio" name="each_side_write" value="1">
                                                        Evet
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox">
                                                        <input type="radio" name="each_side_write" value="0">
                                                        Hayır
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="want_write">
                                                <div id="disagreement_template" style="display: none">
                                                    {!! $lawsuit->disagreement_template !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Detaylarınızı İnceleyin ve Gönderin</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form" id="preview-content"
                                             data-url="{{ route('invitation_letter.preview', $lawsuit) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Bitir</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <p class="kt-font-bold" id="before_saved">
                                            Çıktı almak ve daha sonradan evraklarım sekmesinden evraklarınızı
                                            görüntülemek için kaydet butonu ile kaydedebilirsiniz.
                                        </p>
                                        <div class="kt-wizard-v4__review" id="saved" style="display: none;">
                                            <div class="kt-wizard-v4__review-item">
                                                <div class="neo-notification row">
                                                    <i class="material-icons col-1 align-middle my-auto">notifications</i>
                                                    <div class="col-11">
                                                        Evrak başarıyla kaydedilmiştir. Evraklarım sekmesinden
                                                        dilediginiz zaman erişebilirsiniz.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-wizard-v4__review-item">
                                                <div class="kt-wizard-v4__review-title" id="side_email_control"
                                                     data-url="{{ route('invitation_letter.isnull_side_email') }}">
                                                    Taraflar için mail gönderin.
                                                </div>
                                                <div class="kt-wizard-v4__review-content d-flex flex-column">
                                                    <strong>Gönderilecek E-postalar;</strong>
                                                    <div>
                                                        @foreach ($lawsuit->getClaimants() as $claimant)
                                                            <input class="form-control w-25 mb-3" type="text"
                                                                   name="flower[]" id="values[]"
                                                                   value="{{ $claimant->detail->email }}">
                                                        @endforeach
                                                        @foreach ($lawsuit->getDefendants() as $defendant)
                                                            <input class="form-control w-25 mb-3" type="text"
                                                                   name="flower[]" id="values[]"
                                                                   value="{{ $defendant->detail->email }}">
                                                        @endforeach
                                                    </div>
                                                    <div class="mt-4">
                                                        <button
                                                                class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                                                id="send_email"
                                                                data-url="{{ route('invitation_letter.send_email') }}"
                                                                style="display: none;">
                                                            <i class="far fa-envelope"></i> E-posta Gönder
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-wizard-v4__review-item">
                                                <div class="kt-wizard-v4__review-title">
                                                    Taraflar için çıktı alın. <br/>
                                                </div>
                                                <div class="kt-wizard-v4__review-content" id="cikti">
                                                </div>
                                            </div>

                                            <div class="kt-wizard-v4__review-content">
                                                <h1 class="kt-heading kt-heading--lg">Sürece Devam Etmek istiyor
                                                    musunuz?</h1>
                                                <a class="btn btn-danger btn-lg"
                                                   href="{{ route('lawsuit.index') }}">İptal</a>
                                                <a class="btn btn-success btn-lg" href="#next_level"
                                                   data-toggle="modal">Evet</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="matters_discussed" style="display:none">

                                </div>
                                @include('layout.form_actions')
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="next_level">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Arabuluculuk Sürecine İlişkin Bilgilendirme Tutanağı hazırlamak istiyor musunuz?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('arbiter_process_info_protocol.create', $lawsuit->id) }}"
                           class="btn btn-success btn-lg">Evet</a>
                        <a href="{{ route('lawsuit.index') }}" class="btn btn-primary btn-lg">Hayır</a>
                    </div>
                </div>
            </div>
        </div>
        @include('mediator.document.layout.matters_discussed_modal')
        @include('mediator.document.layout.result_modal')
    </div>
@endsection
@section('script')
    <script>
        var email_count = 0;
    </script>
    <script src="{{ asset('js/page/invitation_letter/wizard.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/printThis.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/side_management_functions.js') }}?v={{ time() }}"></script>
    <script>
        function sendEmail(btn) {
            KTApp.progress(btn);

            $("#kt_form").ajaxSubmit({
                url: btn.data('url'),
                success: function (data) {
                    KTApp.unprogress(btn);
                    swal.fire({
                        "title": "",
                        "text": "Davet mektubu başarıyla gönderildi.",
                        "type": "success",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }
            });
        }

        $(document).on('click', '.print', function () {
            var side_id = $(this).data('id');

            $("#print-" + side_id).printThis({
                importCSS: false,
                loadCSS: "css/print.css"
            });
        });

        $("#send_email").on('click', function () {
            var btn = $(this);

            if (email_count > 0) {
                sendEmail(btn);
            } else {
                var isset = 0;

                $('.send_email_inputs').each(function () {
                    if ($(this).val() != "") {
                        isset = 1;
                    }
                });

                if (isset == 1) {
                    sendEmail(btn);
                } else {
                    KTApp.unprogress(btn);
                    swal.fire({
                        "title": "",
                        "text": "Davet mektubu göndermek için lütfen en az bir email adresi yazınız!",
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }
            }

        });
    </script>
    <script>
        var bookIndex = 0;
        var want_write = $("#want_write");

        $("input[name='want_write']").on('change', function () {
            if ($(this).val() == 1) {
                $("#each_side_write_question").show();
            } else {
                want_write.hide();
                $("#each_side_write_question").hide();
            }
        });
        var disagreement_template = $("#disagreement_template").html();
        $("input[name='each_side_write']").on('change', function () {
            if ($(this).val() == 1) {
                $.each($("input[name='side_ids[]']:checked"), function () {
                    var textarea = $("<textarea>").attr({
                        "id": "disagreement-" + $(this).val(),
                        "name": "disagreement-" + $(this).val()
                    });
                    textarea.html(disagreement_template);
                    want_write.append("</br><p><strong>" + $(this).data("name") +
                        "</strong> için uyuşmazlık özeti</p>");
                    want_write.append(textarea);
                    $('#disagreement-' + $(this).val()).summernote();
                });
                want_write.show();
            } else {
                want_write.show();
                want_write.html("");
                var template = disagreement_template;
                var textarea = $("<textarea>").attr({
                    "id": "disagreement",
                    "name": "disagreement"
                });
                textarea.html(disagreement_template);
                want_write.append(textarea);
                textarea.summernote();
            }
        });
    </script>
@endsection
