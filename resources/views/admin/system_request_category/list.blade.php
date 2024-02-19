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
                            <li class="breadcrumb-item active" aria-current="page">Görüş ve Öneri Kategorileri Listesi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Liste
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="dropdown dropdown-inline">
                                <a href="{{ route('system_request_category.create') }}" class="btn btn-brand btn-icon-sm">
                                    <i class="flaticon2-plus"></i> Yeni
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                        <tr>
                            <th>Sistem No</th>
                            <th>Başlık</th>
                            <th>İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($system_request_categories as $system_request_category)
                            <tr>
                                <td>{{$system_request_category->id}}</td>
                                <td>{{$system_request_category->name}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sistem No</th>
                            <th>Başlık</th>
                            <th>İşlemler</th>
                        </tr>
                        </tfoot>
                    </table>

                    <!--end: Datatable -->
                </div>
            </div>
        </div>

        <!-- end:: Content -->
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/page/system_request_category/datatable.js') }}"></script>
@endsection
@section('style')
@endsection
