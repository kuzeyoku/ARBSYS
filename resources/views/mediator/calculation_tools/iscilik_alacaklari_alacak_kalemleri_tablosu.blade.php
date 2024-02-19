@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-1" style="background-color: white;">
                            <li class="breadcrumb-item"><a href="/home">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="/hesaplama-araclari">Hesaplama Araçları</a></li>
                            <li class="breadcrumb-item active" aria-current="page">İşçilik Alacakları ( Kalemleri Tablosu )
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    İşçilik Alacakları ( Kalemleri Tablosu )
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="/iscilik_alacaklari_alacak_kalemleri_tablosu_hesaplama" method="post">
                                @csrf
                                <table id="dataTables" class="display my-2" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Tarih</th>
                                            <th>Net/Bürüt</th>
                                            <th>Tutar</th>
                                            <th>Para Birimi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control datepicker datedotmask"
                                                    name="tarih[]"></td>
                                            <td>
                                                <select class="form-control" size="1" id="row-56-office"
                                                    name="net_burut[]">
                                                    <option value="Net">
                                                        Net
                                                    </option>
                                                    <option value="Bürüt">
                                                        Bürüt
                                                    </option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control pricemask" name="tutar[]"></td>
                                            <td><select class="form-control" size="1" id="row-56-office"
                                                    name="para_birimi[]">
                                                    <option value="TL">
                                                        TL
                                                    </option>
                                                    <option value="Dolar">
                                                        $
                                                    </option>
                                                    <option value="Euro">
                                                        €
                                                    </option>
                                                </select></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Tarih</th>
                                            <th>Net/Bürüt</th>
                                            <th>Ödenecek Tutar</th>
                                            <th>Para Birimi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <button type="submit" class="btn btn-success">Tamam</button>
                            </form>
                            <button class="btn btn-primary my-4" id="addRow" style="width: 10%">Alacak Kalemi
                                Ekle</button>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tarih</th>
                                        <th scope="col">Net/Bürüt</th>
                                        <th scope="col">Tutar</th>
                                        <th scope="col">Para Birimi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payChart as $item)
                                        <tr>
                                            <th scope="row"></th>
                                            <td>{{ $item->date }}</td>
                                            <td>{{ $item->net_burut }}</td>
                                            <td>{{ $item->tutar }}</td>
                                            <td>{{ $item->para_birimi }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tarih</th>
                                        <th scope="col">Net/Bürüt</th>
                                        <th scope="col">Tutar</th>
                                        <th scope="col">Para Birimi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/plugins/mask-money.js') }}?v={{ time() }}"></script>
    <script>
        $('.pricemask').maskMoney();
        $('#dataTables').DataTable();

        $('#addRow').on('click', function() {
            var table = $('#dataTables').DataTable();
            table.row.add([
                '<input type="text" class="form-control datepicker datedotmask" name="tarih[]">',
                `<select class="form-control" size="1" id="row-56-office"
                                                    name="net_burut[]">
                                                    <option value="TL">
                                                        Net
                                                    </option>
                                                    <option value="Dolar">
                                                        Bürüt
                                                    </option>
                                                </select>`,
                '<input type="text" class="form-control pricemask" name="tutar[]">',
                `<select size="1" class="form-control" id="row-56-office" name="para_birimi[]">
                                                <option value="TL">
                                                    TL
                                                </option>
                                                <option value="Dolar">
                                                    $
                                                </option>
                                                <option value="Euro">
                                                    €
                                                </option>
                                            </select>`
            ]).draw();

            $('.pricemask').maskMoney();
            $('.datepicker').datepicker({
                format: 'dd.mm.yyyy',
            });
        });
    </script>
@endsection
