@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', ['url' => [null => 'Mevzuat Sayfaları']])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Mevzuat Sayfaları
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-sm"></div>
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="dataTable">
                        <thead>
                            <tr>
                                <th>Başlık</th>
                                <th>Durum</th>
                                <th style="width:100px">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($legislations as $legislation)
                                <tr>
                                    <td>{{ $legislation->title }}</td>
                                    <td>{{ $legislation->status }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.legislation.edit', $legislation) }}"
                                                class="btn btn-sm btn-primary edit-person-btn">Düzenle</a>
                                            {!! Form::open(['url' => route('admin.legislation.destroy', $legislation), 'method' => 'delete']) !!}
                                            {!! Form::hidden('id', $legislation->id) !!}
                                            {!! Form::hidden('type', $legislation->type_id) !!}
                                            <button type="button" class="btn btn-sm btn-danger delete-btn">Sil</button>
                                            {!! Form::close() !!}
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
