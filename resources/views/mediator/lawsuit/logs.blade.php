@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        @include('layout.breadcrumb', [
            'url' => [route('lawsuit.index') => 'Dosya Listele', null => 'İşlem Logları'],
        ])

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            İşlemler
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Yapılan İşlem</th>
                                <th scope="col">İşlemin Tarihi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lawsuit->logs as $key => $value)
                                <tr>
                                    <th>{{ $value->event }}</th>
                                    <td>{{ $value->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
