@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', ['url' => [null => 'Şablon İşlemleri']])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label w-100  d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand flaticon2-line-chart"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Şablon İşlemleri {{ isset($lawsuitSubjectType) ? '-' . $lawsuitSubjectType->name : '' }}
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                @if (isset($subjectTypes))
                                    <th>Uyuşmazlık Türleri</th>
                                @endif
                                @if (isset($lawsuitSubjectType))
                                    <th>Uyuşmazlık Konuları</th>
                                @endif
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($lawsuitSubjectType))
                                <tr>
                                    <td>
                                        Genel Şablonlar
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.template.edit', $lawsuitSubjectType) }}"
                                            class="btn btn-primary btn-sm">Düzenle</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th col="2">
                                        Uyuşmazlık Konuları
                                    </th>
                                </tr>
                                @foreach ($lawsuitSubjectType->lawsuitSubjects as $item)
                                    <tr>
                                        <td>
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.template.edit', [$lawsuitSubjectType, $item]) }}"
                                                class="btn btn-primary btn-sm">Düzenle</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if (isset($subjectTypes))
                                @foreach ($subjectTypes as $item)
                                    <tr>
                                        <td>
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.template.subjects', $item) }}"
                                                class="btn btn-primary btn-sm">Düzenle</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
