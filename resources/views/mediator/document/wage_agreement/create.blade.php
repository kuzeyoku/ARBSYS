@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        @include('layout.breadcrumb', [
            'url' => [
                route('lawsuit.index') => 'Dosya Listele',
                null => 'Ücret Sözleşmesi Oluştur',
            ],
        ])

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

                @include('mediator.document.nav', [
                    'nav' => [
                        1 => 'Ücret Tipi',
                        2 => 'Anlaşma Tutarı',
                        3 => 'Önizleme',
                        4 => 'Bitir',
                    ],
                ])

                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                {{ Form::open(['url' => route('wage_agreement.store', $lawsuit), 'method' => 'POST', 'class' => 'kt-form', 'id' => 'kt_form']) }}

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                    data-ktwizard-state="current">
                                    <div class="kt-heading kt-heading--md">Ücret Tipi</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="form-group">
                                                <label>Arabuluculuk ücreti nasıl belirlenecek?</label>
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                        <input type="radio" name="wage_type" value="aaut"> AAÜT
                                                        Hükümlerine Göre
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                        <input type="radio" name="wage_type" value="side"> Taraf
                                                        İradelerine Göre
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Uyuşmazlık konusu para mı veya para ile değerlendirilebiliyor
                                                    mu?</label>
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                        <input type="radio" name="money" value="yes"> Evet
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                        <input type="radio" name="money" value="no"> Hayır
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Anlaşma Tutarı</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <div class="if_aaut_answer_no" style="display: none;" id="aaut_first_form">
                                                <div class="form-group ">
                                                    <label>Arabuluculuk Sürecinin Kaç Saat Sürdüğünü Giriniz</label>
                                                    <input type="text" name="saat" class="form-control"
                                                        autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="opt1">
                                                        <option value="">Seçiniz</option>
                                                        <option value="a">Aile Hukuku ile ilgili uyuşmazlıklarda
                                                        </option>
                                                        <option value="b">Ticari uyuşmazlıklarda</option>
                                                        <option value="c">İşçi - işveren uyuşmazlıklarında
                                                        </option>
                                                        <option value="d">Tüketici uyuşmazlıklarında</option>
                                                        <option value="e">Diğer tür uyuşmazlıklarda ise</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="opt2">
                                                        <option value="">Seçiniz</option>
                                                        <option value="i">2 taraflı</option>
                                                        <option value="ii">3-5 taraflı</option>
                                                        <option value="iii">6-10 taraflı</option>
                                                        <option value="iv">11+ taraflı</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <a href="javascript:;" id="aaut_first"
                                                        data-action="{{ route('wage_agreement.aaut_first') }}"
                                                        class="btn btn-brand">Hesapla</a>
                                                </div>
                                            </div>
                                            <div class="if_aaut_answer_yes" style="display: none;" id="aaut_second_form">
                                                <div class="form-group">
                                                    <input class="form-control pricemask" data-suffix=" ₺"
                                                        data-thousands="." data-decimal="," type="text"
                                                        placeholder="Hesaplanacak Ücret" name="ucret" autocomplete="off"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="opt" required>
                                                        <option value="">Seçiniz</option>
                                                        <option value="a">Bir arabulucu görev yaparsa</option>
                                                        <option value="b">Birden fazla arabulucu görev yaparsa
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="uyusmazlikturu" required>
                                                        <option value="">Seçiniz</option>
                                                        <option value="d">Dava Şartı Kapsamındaki Uyuşmazlıklar
                                                        </option>
                                                        <option value="c">İhtiyari Uyuşmazlık</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="altsecenekler1"
                                                        style="display: none;">
                                                        <option value="">Seçiniz</option>
                                                        <option value="a">İş / Tüketici Hukuku Uyuşmazlığı
                                                        </option>
                                                        <option value="b">Ticari Uyuşmazlık</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="altsecenekler"
                                                        style="display: none;">
                                                        <option value="">Seçiniz</option>
                                                        <option value="1">Aile Hukuku Uyuşmazlıkları</option>
                                                        <option value="2">Ticari Uyuşmazlıklar</option>
                                                        <option value="3">İş Hukuku Uyuşmazlıkları</option>
                                                        <option value="4">Tüketici Uyuşmazlıkları</option>
                                                        <option value="5">Diğer Tür Uyuşmazlıklar</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" name="tarafli" required>
                                                        <option value="">Seçiniz</option>
                                                        <option value="0">2 taraflı işlerde</option>
                                                        <option value="1">3 - 5 taraflı işlerde</option>
                                                        <option value="2">6 - 10 taraflı işlerde</option>
                                                        <option value="3">11+ taraflı işlerde</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <a href="javascript:;" id="aaut_second"
                                                        data-action="{{ route('wage_agreement.aaut_second') }}"
                                                        class="btn btn-brand">Hesapla</a>
                                                </div>
                                            </div>
                                            <div class="if_side_answer_yes" style="display: none;" id="side_third_form">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <input class="form-control" type="number"
                                                                placeholder="Yüzdelik Dilim" name="a"
                                                                autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <input class="form-control pricemask" data-suffix=" ₺"
                                                                data-thousands="." data-decimal="," type="text"
                                                                placeholder="Toplam Ücret" name="b"
                                                                autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <a href="javascript:;" id="side_third_form_button"
                                                        class="btn btn-brand">Hesapla</a>
                                                </div>
                                            </div>
                                            <div class="if_side_answer_no" style="display: none;" id="side_fourth_form">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <input class="form-control pricemask" data-suffix=" ₺"
                                                                data-thousands="." data-decimal="," type="text"
                                                                placeholder="Saatlik Ücret" name="a"
                                                                autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <input class="form-control" type="number"
                                                                placeholder="Kaç Saat" name="b" autocomplete="off"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <a href="javascript:;" id="side_fourth_form_button"
                                                        class="btn btn-brand">Hesapla</a>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Taraflarca Ödenmesi gereken toplam Arabuluculuk Ücreti</label>
                                                <input type="text" name="price" class="form-control pricemask"
                                                    data-suffix=" ₺" data-thousands="." data-decimal="," data-price=""
                                                    autocomplete="off">
                                            </div>
                                            <div id="sides">
                                                <p>Ödemeyi yapacak kişilerin ödeyecekleri tutarları ve ödeme tarihlerini
                                                    giriniz</p>
                                                <table class="table table-hover">
                                                    <tr>
                                                        <th>Taraf</th>
                                                        <th>Odeme Tutari</th>
                                                        <th>Odeme Tarihi</th>
                                                    </tr>
                                                    @foreach ($lawsuit->sides() as $side)
                                                        <tr>
                                                            <td>{{ $side->detail->name }}</td>
                                                            <td>
                                                                <input type="text"
                                                                    name="side_payment_price_{{ $side->id }}"
                                                                    data-id="{{ $side->id }}"
                                                                    class="form-control side_payment_price pricemaskallowzero"
                                                                    data-suffix=" ₺" data-thousands="." data-decimal=","
                                                                    data-allowZero="true" autocomplete="off">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                    name="side_payment_date_{{ $side->id }}"
                                                                    data-id="{{ $side->id }}"
                                                                    class="form-control datepicker datedotmask"
                                                                    autocomplete="off">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Detaylarınızı İnceleyin</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__form">
                                            <p class="red-text"><strong>Not:</strong> @ İşareti ile başlayan
                                                değişkenler kaydet butonuna tıkladığınızda taraf ve alıcı bilgileri ile
                                                değiştirilecektir.</p>
                                            <textarea class="preview_area" name="preview" id="preview_area"
                                                data-url="{{ route('wage_agreement.preview', $lawsuit) }}">
                                                </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Bitir</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v4__review">
                                            <p class="kt-font-bold" id="before_saved">
                                                Çıktı almak ve daha sonradan evraklarım sekmesinden evraklarınızı
                                                görüntülemek için kaydet butonu ile kaydedebilirsiniz.
                                            </p>
                                            <div class="kt-wizard-v4__review-item" id="saved" style="display: none;">
                                                <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
                                                    rel="stylesheet">
                                                <div class="neo-notification row">
                                                    <i class="material-icons col-1 align-middle my-auto">notifications</i>
                                                    <div class="col-11">
                                                        Evrak başarıyla kaydedilmiştir. Evraklarım sekmesinden
                                                        dilediginiz zaman erişebilirsiniz.
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="kt-wizard-v4__review-content">
                                                    <a href="/dosyalar" class="btn btn-danger btn-lg">Çık</a>
                                                    <a href="javascript:;" class="btn btn-success float-right"
                                                        id="cikti_btn">
                                                        <i class="fas fa-print"></i> Çıktı Al
                                                    </a>
                                                    <div class="print_side"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @include('layout.form_actions')

                                {{ Form::close() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/page/wage_agreement/wizard.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/printThis.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/plugins/mask-money.js') }}?v={{ time() }}"></script>
    <script>
        $(document).ready(function() {



            $('.pricemask').maskMoney();
            $('.pricemaskallowzero').maskMoney({
                allowZero: true
            });

            $("[name='uyusmazlikturu']").on('change', function() {
                if ($("[name='uyusmazlikturu'] option:selected").val() == 'c') {
                    $("[name='altsecenekler']").show();
                    $("[name='altsecenekler']").attr('required', true);
                    $("[name='altsecenekler1']").hide();
                    $("[name='altsecenekler1']").attr('required', false);
                } else if ($("[name='uyusmazlikturu'] option:selected").val() == 'd') {
                    $("[name='altsecenekler']").hide();
                    $("[name='altsecenekler']").attr('required', false);
                    $("[name='altsecenekler1']").show();
                    $("[name='altsecenekler1']").attr('required', true);
                }
            });
        });

        function showInput() {
            $(".if_aaut_answer_yes").hide();
            $(".if_aaut_answer_no").hide();
            $(".if_side_answer_no").hide();
            $(".if_side_answer_yes").hide();

            var wage_type = $("[name='wage_type']:checked").val();
            var answer = $("[name='money']:checked").val();

            if (wage_type == "aaut" && answer == "no") {
                $(".if_aaut_answer_no").show();
            } else if (wage_type == "aaut" && answer == "yes") {
                $(".if_aaut_answer_yes").show();
            } else if (wage_type == "side" && answer == "yes") {
                $(".if_side_answer_yes").show();
            } else if (wage_type == "side" && answer == "no") {
                $(".if_side_answer_no").show();
            }
        }

        $("[name='money']").on('change', function() {
            showInput();
        });

        $("[name='wage_type']").on('change', function() {
            showInput();
        });

        $("#aaut_first").on('click', function() {
            var form = $('#aaut_first_form').find('select, textarea, input').serialize();
            var url = $(this).data('action');
            
            $.ajax({
                url: url,
                type: "POST",
                data: form,
                success: function(data) {
                    $("input[name='price']").val(data.total);
                    <?php foreach($lawsuit->sides() as $side) { ?>
                    $(`input[name='side_payment_price_<?= $side->id ?>']`).val(data.totalHalf);
                    <?php } ?>
                }
            });
        });

        $("#aaut_second").on('click', function() {
            var form = $('#aaut_second_form').find('select, textarea, input').serialize();
            var url = $(this).data('action');

            $.ajax({
                url: url,
                type: "POST",
                data: form,
                success: function(data) {
                    $("input[name='price']").val(data.total);
                }
            });
        });

        $("#side_third_form_button").on('click', function() {
            var a = parseFloat($('#side_third_form input[name="a"]').val());
            var b = parseFloat($('#side_third_form input[name="b"]').maskMoney('unmasked')[0]);

            console.log(a);
            console.log(b);

            $("input[name='price']").val(b * a / 100);
            $("input[name='price']").maskMoney('mask');
        });

        $("#side_fourth_form_button").on('click', function() {
            var a = parseFloat($('#side_fourth_form input[name="a"]').maskMoney('unmasked')[0]);
            var b = parseFloat($('#side_fourth_form input[name="b"]').val());

            console.log(a);
            console.log(b);

            $("input[name='price']").val(b * a);
            $("input[name='price']").maskMoney('mask');

        });
    </script>
@endsection
