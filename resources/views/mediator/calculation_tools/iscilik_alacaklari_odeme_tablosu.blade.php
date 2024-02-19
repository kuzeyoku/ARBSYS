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
                            <li class="breadcrumb-item active" aria-current="page">İşçilik Alacakları ( Ödeme Tablosu )</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    İşçilik Alacakları ( Ödeme Tablosu )
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
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <form action="/iscilik_alacaklari_odeme_tablosu_hesaplama" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="ödeme_turu">Ödeme Türü</label>
                                    <select class="custom-select" multiple name="odeme_turu" id="ödeme_turu">
                                        <option value="Banka Hesabı" selected>Banka Hesabı</option>
                                        <option value="Elden Ödeme">Elden Ödeme</option>
                                        <option value="Posta Çeki">Posta Çeki</option>
                                        <option value="Bono / Çek">Bono / Çek</option>
                                    </select>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1">Ödeyecek Kişi</label>
                                    <input type="text" class="form-control" name="odeyecek_kisi"
                                        id="exampleFormControlInput1" placeholder="Ad Soyad">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Ödemeyi Alacak Kişi</label>
                                    <input type="text" class="form-control" name="odemeyi_alacak_kisi"
                                        id="exampleFormControlInput2" placeholder="Ad Soyad">
                                </div>
                                <table id="dataTables" class="display my-2" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Tarih</th>
                                            <th>Tutar</th>
                                            <th>Para Birimi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control datepicker datedotmask"
                                                    name="tarih[]"></td>
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
                                            <th>Tutar</th>
                                            <th>Para Birimi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <button type="submit" class="btn btn-success">ONAYLA</button>
                            </form>
                            <button class="btn btn-primary my-4" id="addRow" style="width: 10%">Taksit Ekle</button>


                            @foreach ($paymentCalculate as $item)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">tarih</th>
                                            <th scope="col">Ücret</th>
                                            <th scope="col">Para Türü</th>
                                            <th scope="col">Ödeme Türü</th>
                                            <th scope="col">Ödeyecek Kişi Adı</th>
                                            <th scope="col">Ödemeyi Alacak Kişi Adı</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td>{{ $item->amount_date }}</td>
                                            <th scope="row">{{ $item->amount }}</th>
                                            <td>{{ $item->amount_type }}</td>
                                            <td>{{ $item->payment_type }}</td>
                                            <td>{{ $item->person_from_pay }}</td>
                                            <td>{{ $item->person_to_pay }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
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
