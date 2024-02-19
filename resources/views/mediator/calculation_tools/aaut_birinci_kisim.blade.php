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
                            <li class="breadcrumb-item active" aria-current="page">Saat Ücreti - AAÜT Birinci Kısım</li>
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
                                    Saat Ücreti - AAÜT Birinci Kısım
                                </h3>
                            </div>
                        </div>

                        <!--begin::Form-->
                        <form class="kt-form kt-form--label-right" id="kt_form_1" action="{{ route("calculation.aaut_birinci_kisim") }}" method="post">
                            @csrf
                            <div class="kt-portlet__body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Saat Giriniz" name="saat" autocomplete="off" required value="{{ $saat??"" }}">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="opt1" required>
                                                <option value="" {{ (isset($opt1) && $opt1 === '') ? "selected" : "" }}>Seçiniz</option>
                                                <option value="a" {{ (isset($opt1) && $opt1 === 'a') ? "selected" : "" }}>Aile Hukuku ile ilgili uyuşmazlıklarda</option>
                                                <option value="b" {{ (isset($opt1) && $opt1 === 'b') ? "selected" : "" }}>Ticari uyuşmazlıklarda</option>
                                                <option value="c" {{ (isset($opt1) && $opt1 === 'c') ? "selected" : "" }}>İşçi - işveren uyuşmazlıklarında</option>
                                                <option value="d" {{ (isset($opt1) && $opt1 === 'd') ? "selected" : "" }}>Tüketici uyuşmazlıklarında</option>
                                                <option value="e" {{ (isset($opt1) && $opt1 === 'e') ? "selected" : "" }}>Diğer tür uyuşmazlıklarda ise</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="opt2" required>
                                                <option value="" {{ (isset($opt2) && $opt2 === '') ? "selected" : "" }}>Seçiniz</option>
                                                <option value="i" {{ (isset($opt2) && $opt2 === 'i') ? "selected" : "" }}>2 taraflı</option>
                                                <option value="ii" {{ (isset($opt2) && $opt2 === 'ii') ? "selected" : "" }}>3-5 taraflı</option>
                                                <option value="iii" {{ (isset($opt2) && $opt2 === 'iii') ? "selected" : "" }}>6-10 taraflı</option>
                                                <option value="iv" {{ (isset($opt2) && $opt2 === 'iv') ? "selected" : "" }}>11+ taraflı</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        @if (isset($goster) && $goster)
                                            <table class="table table-hover">
                                                <tr>
                                                    <th >Açıklama</th>
                                                    <th >Arabuluculuk Ücreti</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $aciklama }}</td>
                                                    <td>{!! GlobalFunction::format($rakam) !!}</td>
                                                </tr>
                                                <tr class="kt-font-bold">
                                                    <td>Toplam Ücret</td>
                                                    <td>{!! GlobalFunction::format($rakam) !!}</td>
                                                </tr>
                                                <tr>
                                                    {!! ($minimessagegoster) ? $minimessage : '' !!}
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
