@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', [
            'url' => [
                '/hesaplama-araclari' => 'Hesaplamua Araçları',
                null => 'Arabuluculuk Serbest Meslek Makbuzu Hesaplama',
            ],
        ])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Arabuluculuk Serbest Meslek Makbuzu Hesaplama
                        </h3>
                    </div>
                </div>
                {{ Form::open(['url' => route('calculation.serbest_meslek_makbuzu'), 'method' => 'post']) }}
                <div class="kt-portlet__body">
                    <div class="form-group">
                        {{ Form::label('Ücret') }}
                        {{ Form::text('fee', old('fee') ?? null, ['class' => 'form-control pricemask', 'data-suffix' => ' ₺', 'data-thousands' => '.', 'data-decimal' => ',', 'required' => '']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Hesaplama Yöntemi') }}
                        {{ Form::select('opt', $selectMethodArray, $opt ?? old('opt'), ['class' => 'form-control', 'placeholder' => '--Seçiniz--']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('KDV') }}
                        {{ Form::select('kdv', [0 => '%0', 1 => '%1', 8 => '%8', 10 => '%10', 18 => '%18', 20 => '%20'], 20, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Stopaj') }}
                        {{ Form::select('stopaj', [0 => '%0', 1 => '%1', 2 => '%2', 3 => '%3', 4 => '%4', 5 => '%5', 10 => '%10', 15 => '%15', 17 => '%17', 20 => '%20'], 0, ['class' => 'form-control']) }}
                    </div>
                    {{ Form::submit('Hesapla', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                    <hr>
                    @if (isset($goster) && $goster)
                        @if ($opt == 'b')
                            <table class="table table-striped table-bordered">
                                <caption style="caption-side: top;">{!! $message !!}</caption>
                                <tr>
                                    <th>Makbuza Yazılacak</th>
                                    <th>Vergi Mükellefi Olan Kişi</th>
                                    <th>Vergi Mükellefi Olmayan Kişi</th>
                                </tr>
                                <tr>
                                    <td>Brüt (KDV Hariç)</td>
                                    <td>{!! GlobalFunction::format($a1) !!}</td>
                                    <td>{!! GlobalFunction::format($b1) !!}</td>
                                </tr>
                                <tr>
                                    <td>Gelir Vergisi Stopajı (%{{ $stopaj * 100 }})</td>
                                    <td>{!! GlobalFunction::format($a4) !!}</td>
                                    <td>{!! GlobalFunction::format($b4) !!}</td>
                                </tr>
                                <tr>
                                    <td>Alınan Net Ücret</td>
                                    <td>{!! GlobalFunction::format($a5 - $a2) !!}</td>
                                    <td>{!! GlobalFunction::format($b3) !!}</td>
                                </tr>
                                <tr>
                                    <td>KDV (%{{ $kdv * 100 }}) (Brüt Tutar Üzerinden)</td>
                                    <td>{!! GlobalFunction::format($a2) !!}</td>
                                    <td>{!! GlobalFunction::format($b2) !!}</td>
                                </tr>
                                <tr>
                                    <td>Tahsil Edilen Ücret</td>
                                    <td>{!! GlobalFunction::format($a5) !!}</td>
                                    <td>{!! GlobalFunction::format($b5) !!}</td>
                                </tr>
                            </table>
                        @else
                            <table class="table table-hover">
                                <caption>{!! $message !!}</caption>
                                <tr>
                                    <th>Makbuza Yazılacak</th>
                                    <th>Vergi Mükellefi Olan Kişi</th>
                                    <th>Vergi Mükellefi Olmayan Kişi</th>
                                </tr>
                                <tr>
                                    <td>Brüt (KDV Hariç)</td>
                                    <td>{!! GlobalFunction::format($a1) !!}</td>
                                    <td>{!! GlobalFunction::format($b1) !!}</td>
                                </tr>
                                <tr>
                                    <td>Gelir Vergisi Stopajı (%{{ $stopaj * 100 }})</td>
                                    <td>{!! GlobalFunction::format($a2) !!}</td>
                                    <td>{!! GlobalFunction::format($b2) !!}</td>
                                </tr>
                                <tr>
                                    <td>Alınan Net Ücret</td>
                                    <td>{!! GlobalFunction::format($a3) !!}</td>
                                    <td>{!! GlobalFunction::format($b3) !!}</td>
                                </tr>
                                <tr>
                                    <td>KDV (%{{ $kdv * 100 }}) (Brüt Tutar Üzerinden)</td>
                                    <td>{!! GlobalFunction::format($a4) !!}</td>
                                    <td>{!! GlobalFunction::format($b4) !!}</td>
                                </tr>
                                <tr>
                                    <td>Tahsil Edilen Ücret</td>
                                    <td>{!! GlobalFunction::format($a5) !!}</td>
                                    <td>{!! GlobalFunction::format($b5) !!}</td>
                                </tr>
                            </table>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/plugins/mask-money.js') }}?v={{ time() }}"></script>
    <script>
        $(document).ready(function() {
            $('.pricemask').inputmask({
                alias: 'currency',
                prefix: '₺',
                groupSeparator: '.',
                autoGroup: true,
                digits: 2,
                digitsOptional: false,
                allowMinus: false,
                rightAlign: false
            });
        });
    </script>
@endsection
