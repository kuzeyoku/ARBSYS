@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-1" style="background-color: white;">
                            <li class="breadcrumb-item"><a href="/home">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="/hesaplama-araclari">Hesaplama Araçları</a></li>
                            <li class="breadcrumb-item active" aria-current="page">İşçilik Alacakları (İşe İade)</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-12">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    İşçilik Alacakları (İşe İade)
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            @if ($errors->any())
                                <div class="alert alert-primary d-flex flex-column" role="alert">
                                    <p>arabulucunun re’sen anlaşmama yönünde son tutanak hazırlaması gerekmektedir.
                                        Hazırlamak İstiyor Musunuz ?</p>
                                    <div>
                                        <a href="/dosyalar" class="btn btn-success">EVET</a>
                                        <a href="/dosyalar" class="btn btn-danger">HAYIR</a>
                                    </div>
                                </div>
                            @endif

                            <strong>Taraflar işçinin işe iade edilmesi konusunda anlaşmışlardır. Buna göre;</strong>
                            <form action="/iscilik_alacaklari_sayfasi_hesaplama" method="post">
                                @csrf
                                <div class="form-group mt-4">
                                    <label for="exampleInputEmail1">İşçinin İşe Başlayacağı Tarih</label>
                                    <input type="text" name="tarih" class="form-control datepicker"
                                        id="exampleInputEmail1" />
                                </div>
                                <div class="form-group mt-1">
                                    <label for="tutar">İşçinin boşta kaldığı süreye ilişkin olarak işveren
                                        tarafından ödenmesi gereken ücret ve diğer haklarına ilişkin tutarlar
                                        toplamı</label>
                                    <input class="form-control w-25" name="sure_tutar" type="text"
                                        placeholder="Tutar Girin Örnek ( 3214.52 )" id="tutar">
                                </div>
                                <div class="form-group mt-1">
                                    <label for="tutar">İşçinin işe başlatılmaması halinde işveren tarafından ödenmesi
                                        gereken tazminat tutarı net</label>
                                    <input class="form-control pricemask w-25" name="tazminat_tutar" type="text"
                                        placeholder="Tutar Girin Örnek ( 3214.52 )" id="tutar">
                                </div>
                                <button type="submit" class="btn btn-success">TAMAMLA</button>
                            </form>
                            @if (isset($sure_tutar) || isset($tazminat_tutar))
                                <table class="table table-bordered mt-4">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tutar (₺)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"></th>
                                            <td>{{ $sure_tutar }} ₺</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td>{{ $tazminat_tutar }} ₺</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="row">Toplam Tutar</th>
                                            <th>{{ (float) $sure_tutar + (float) $tazminat_tutar }} ₺</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            @endif
                        </div>
                    </div>

                    <!--end::Portlet-->
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>
@endsection
<script src="{{ asset('js/plugins/mask-money.js') }}?v={{ time() }}"></script>
<script>
    $('.pricemask').maskMoney();
</script>
