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
                            <li class="breadcrumb-item active" aria-current="page">Dava Şartı Uygulamalarında Süre Hesaplama</li>
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
                                    Dava Şartı Uygulamalarında Süre Hesaplama
                                </h3>
                            </div>
                        </div>

                        <!--begin::Form-->
                        <form class="kt-form kt-form--label-right" action="/dava-sarti-uygulamalarinda-sure-hesaplama" method="post">
                            @csrf
                            <div class="kt-portlet__body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Arabuluculuk Görevinin Kabul Edildiği Tarih:</label>
                                            <input class="form-control datepicker datedotmask" type="text" name="tarih" placeholder="Tarih Giriniz." required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        @if (isset($goster) && $goster)
                                            <table class="table table-hover">
                                                <tr>
                                                    <th></th>
                                                    <th class="text-center">3. Hafta</th>
                                                    <th class="text-center">4. Hafta</th>
                                                    <th class="text-center">6. Hafta</th>
                                                    <th class="text-center">8. Hafta</th>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">İş Hukuku Uyuşmazlıkları</td>
                                                    <td>{{ $first }}</td>
                                                    <td class="text-danger font-weight-bold">{{ $second }}</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Ticari Uyuşmazlıklar</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>{{ $third }}</td>
                                                    <td class="text-danger font-weight-bold">{{ $fourth }}</td>
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
                        </form>

                        <!--end::Form-->
                    </div>

                    <!--end::Portlet-->
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>
@endsection
@section('script')
    <script>
        $("select[name='uyusmazlikturu']").on('change', function ()
        {
            if ($(this).val() ==  "c")
            {
                $("select[name='altsecenekler_c']").show();
                $("select[name='altsecenekler_d']").hide();
            }
            else  if ($(this).val() ==  "d")
            {
                $("select[name='altsecenekler_d']").show();
                $("select[name='altsecenekler_c']").hide();
            }
        });
    </script>
@endsection
