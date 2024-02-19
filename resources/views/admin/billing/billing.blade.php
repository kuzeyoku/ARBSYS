@extends('layout.main')
@section('content')

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-1" style="background-color: white;">
                        <li class="breadcrumb-item"><a href="/home">Anasayfa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Faturalar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Faturalar
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body text-center">
                <strong style="font-size: 1.1rem;">Fatura bilgisi bulunmamaktadır...</strong>
            </div>
        </div>
    </div>
</div>
@endsection
