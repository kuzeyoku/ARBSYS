@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', [
            'url' => [
                '/hesaplama-araclari' => 'Hesaplama Araçları',
                null => 'Saat Ücreti - AAÜT İkinci Kısım',
            ],
        ])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Saat Ücreti - AAÜT İkinci Kısım
                                </h3>
                            </div>
                        </div>
                        {{ Form::open(['url' => route('calculation.aaut_ikinci_kisim'), 'method' => 'POST']) }}
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <input class="form-control pricemask" data-suffix=" ₺" data-thousands="."
                                            data-decimal="," type="text" placeholder="Anlaşmanın Parasal Değeri" name="ucret"
                                            value="{{ isset($ucret) ? $ucret . ' ₺' : '' }}" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::select('opt', $optSelectArray, old('opt'), ['class' => 'form-control', 'placeholder' => '--Seçiniz--']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::select('uyusmazlikturu', $typeOfDisputeSelectArray, old('uyusmazlikturu'), ['class' => 'form-control', 'placeholder' => '--Seçiniz--']) }}
                                    </div>  
                                    <div class="form-group">
                                       
                                        <select class="form-control" name="altsecenekler1" {!! isset($uyusmazlikturu) && $uyusmazlikturu == 'd' ? 'required' : 'style="display: none;"' !!}>
                                            <option value=""
                                                {{ isset($altsecenekler1) && $altsecenekler1 == '' ? 'selected' : '' }}>
                                                Seçiniz</option>
                                            <option value="a"
                                                {{ isset($altsecenekler1) && $altsecenekler1 == 'a' ? 'selected' : '' }}>
                                                İş / Tüketici Hukuku Uyuşmazlığı </option>
                                            <option value="b"
                                                {{ isset($altsecenekler1) && $altsecenekler1 == 'b' ? 'selected' : '' }}>
                                                Ticari Uyuşmazlık</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="altsecenekler" {!! isset($uyusmazlikturu) && $uyusmazlikturu == 'c' ? 'required' : 'style="display: none;"' !!}>
                                            <option value=""
                                                {{ isset($altsecenekler) && $altsecenekler == '' ? 'selected' : '' }}>
                                                Seçiniz</option>
                                            <option value="1"
                                                {{ isset($altsecenekler) && $altsecenekler == '1' ? 'selected' : '' }}>
                                                Aile Hukuku Uyuşmazlıkları</option>
                                            <option value="2"
                                                {{ isset($altsecenekler) && $altsecenekler == '2' ? 'selected' : '' }}>
                                                Ticari Uyuşmazlıklar</option>
                                            <option value="3"
                                                {{ isset($altsecenekler) && $altsecenekler == '3' ? 'selected' : '' }}>
                                                İş Hukuku Uyuşmazlıkları</option>
                                            <option value="4"
                                                {{ isset($altsecenekler) && $altsecenekler == '4' ? 'selected' : '' }}>
                                                Tüketici Uyuşmazlıkları</option>
                                            <option value="5"
                                                {{ isset($altsecenekler) && $altsecenekler == '5' ? 'selected' : '' }}>
                                                Diğer Tür Uyuşmazlıklar</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="tarafli" required>
                                            <option value=""
                                                {{ isset($tarafli) && $tarafli == '' ? 'selected' : '' }}>Seçiniz
                                            </option>
                                            <option value="0"
                                                {{ isset($tarafli) && $tarafli == '0' ? 'selected' : '' }}>2 taraflı
                                                işlerde</option>
                                            <option value="1"
                                                {{ isset($tarafli) && $tarafli == '1' ? 'selected' : '' }}>3 - 5
                                                taraflı işlerde</option>
                                            <option value="2"
                                                {{ isset($tarafli) && $tarafli == '2' ? 'selected' : '' }}>6 - 10
                                                taraflı işlerde</option>
                                            <option value="3"
                                                {{ isset($tarafli) && $tarafli == '3' ? 'selected' : '' }}>11+
                                                taraflı işlerde</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-8">
                                    @if (isset($goster) && $goster)
                                        <table class="table table-hover">
                                            <caption style="caption-side: top;">{!! $messageNeo !!}</caption>
                                            <tr>
                                                <th>Ücret Dilimi</th>
                                                <th>Oran</th>
                                                <th>Düşen Miktar</th>
                                                <th>Arabuluculuk Ücreti</th>
                                            </tr>
                                            @for ($i = 0; $i <= $kacdilim; $i++)
                                                <tr class="el-item">
                                                    <td>
                                                        <div class="el-content">{!! $dilimaciklama[$i] != '' ? $dilimaciklama[$i] : ' - ' !!}</div>
                                                    </td>
                                                    <td>
                                                        <div class="el-content">
                                                            %{{ $dilimoran[$opt][$i] != '' ? $dilimoran[$opt][$i] : 0 }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="el-content">{!! GlobalFunction::format($dusenmiktar[$i]) !!}</div>
                                                    </td>
                                                    <td>
                                                        <div class="el-content">
                                                            @if ($i == 0)
                                                                {!! $arabuluculukucreti[$i] < $uyusmazlikasgarisi
                                                                    ? GlobalFunction::format($uyusmazlikasgarisi)
                                                                    : GlobalFunction::format($arabuluculukucreti[$i]) !!}
                                                            @else
                                                                {{ $arabuluculukucreti[$i] }}
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endfor
                                            <tr class="el-item">
                                                <td colspan="3">
                                                    <div class="el-content uk-text-bold" style="text-align: left;">
                                                        Toplam Ücret</div>
                                                </td>
                                                <td class="sagahizala">
                                                    <div class="el-content uk-text-bold">{!! GlobalFunction::format($toplamucret) !!}</div>
                                                </td>
                                            </tr>
                                            <tr class="el-item">
                                                {!! $minimessagegoster ? $minimessage : '' !!}
                                            </tr>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        <button type="submit" class="btn btn-brand">Hesapla</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/plugins/mask-money.js') }}?v={{ time() }}"></script>
    <script>
        $('.pricemask').maskMoney();
    </script>
    <script>
        $(document).ready(function() {
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
    </script>
@endsection
