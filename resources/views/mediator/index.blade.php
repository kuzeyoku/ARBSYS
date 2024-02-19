@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        @include('layout.breadcrumb', [($url = [])])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="card mb-4">
                <div class="card-header">
                    Kullanıcı Bilgileri
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="dash-count das3 d-flex flex-row justify-content-between">
                                <div class="dash-counts">
                                    <h5>Hoşgeldiniz</h5>
                                    <h4>{{ auth()->user()->name }}</h4>
                                </div>
                                <div class="dash-imgs">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="dash-count das1 d-flex flex-row justify-content-between">
                                <div class="dash-counts">
                                    <h5>Kalan Kullanım Süreniz</h5>
                                    <h4>{{ auth()->user()->remainingDay }} Gün</h4>
                                    </h4>
                                </div>
                                <div class="dash-imgs">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    Dosyalarım
                </div>
                <div class="card-body pb-0">

                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="dash-count d-flex flex-row justify-content-between">
                                <div class="dash-counts">
                                    <h4>{{ $lawsuits->count() }}</h4>
                                    <h5>Toplam Dosya</h5>
                                </div>
                                <div class="dash-imgs">
                                    <i class="fas fa-folder"></i>
                                </div>
                            </div>
                        </div>
                        @foreach ($lawsuitProcessTypes as $key => $title)
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="dash-count das2 d-flex flex-row justify-content-between">
                                    <div class="dash-counts">
                                        <h4>{{ $lawsuitProcessTypesCount[$key] ?? 0 }}</h4>
                                        <h5>{{ $title }}</h5>
                                    </div>
                                    <div class="dash-imgs">
                                        <i class="fas fa-file"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Belgeler
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="dash-count d-flex flex-row justify-content-between align-items-center">
                                <h5>Toplam Oluşturulan Belge</h5>
                                <h1>{{ $documents->count() }}</h1>
                            </div>
                        </div>
                        @foreach ($documentTypes as $key => $title)
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="dash-count das2 d-flex flex-row justify-content-between align-items-center">
                                    <h5>{{ $title }}</h5>
                                    <h4>{{ $documentTypesCount[$key] ?? 0 }}</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
