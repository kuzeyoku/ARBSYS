@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', ['url' => [null => 'Bakanlık Görüşleri']])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Bakanlık Görüşleri
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-striped table-hover text-center table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <td>Başlık</td>
                                <td>Durum</td>
                                <td>Sıra</td>
                                <td>İşlem</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        {{ $item->title }}
                                    </td>
                                    <td>
                                        @if ($item->status)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Pasif</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->order }}
                                    </td>
                                    <td style="width:100px">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.ministeries_opinions.edit', $item) }}"
                                                class="btn btn-primary btn-sm">Düzenle</a>
                                            {{ Form::open(['url' => route('admin.ministeries_opinions.destroy', $item), 'method' => 'delete']) }}
                                            <button type="button" class="btn btn-danger btn-sm delete-btn">Sil</button>
                                            {{ Form::close() }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
