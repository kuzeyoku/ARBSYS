@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', ['url' => [null => 'Hesaplama Araçları']])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Hesaplama Araçları
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    {{ Form::open(['url' => route('admin.calculation_tools.update'), 'method' => 'post']) }}
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Hesaplama Aracı Adı</th>
                                <th>Aktiflik durumu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tools as $tool)
                                <tr>
                                    <td>
                                        {{ $tool->name }}
                                    </td>
                                    <td>
                                        <span class="kt-switch kt-switch--success">
                                            <label>
                                                {{ Form::checkbox('status', 'true', $tool->status, ['class' => 'calculate-item', 'id' => $tool->id]) }}
                                                <span></span>
                                            </label>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(".calculate-item").change(function() {
            let url = $(this).closest("form").attr("action");
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    '_token': $("input[name='_token']").val(),
                    'id': $(this).attr("id"),
                    'status': $(this).is(":checked"),
                },
                success: function(data) {

                }
            });
        });
    </script>
@endsection
