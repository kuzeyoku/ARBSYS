@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', [
            'url' => [route('lawsuit.index') => 'Dosyalar', 0 => 'Dosya Notları'],
        ])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid lawsuit_edit">
            <div class="row">
                <div class="col-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Dosya Notları
                                </h3>
                            </div>
                        </div>
                        {{ Form::open(['url' => route('lawsuit.note.save', $lawsuit)]) }}
                        <div class="kt-portlet__body noteEditor">
                            @if (session()->has('message.status'))
                                <div class="alert alert-{{ session()->get('message.status') }}">
                                    {!! session('message.content') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                {{ Form::textarea('notes', $lawsuit->notes->note ?? null, ['class' => 'summernote']) }}
                            </div>
                            {{ Form::submit('Kaydet', ['class' => 'btn btn-primary']) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $(".noteEditor").hide();
            swal.fire({
                title: 'Dikkat!',
                text: "Bu sayfada yer alan detayların sadece arabulucu tarafından görüntülenmesi gerekebilir. Devam etmek istediğinize eminmisiniz ?",
                type: 'warning',
                icon: "warning",
                confirmButtonText: 'Evet, devam et!',
                cancelButtonText: 'Hayır, iptal et!',
                showCancelButton: true,
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $(".noteEditor").show();
                } else if (result.dismiss === "cancel") {
                    swal.fire(
                        "İptal edildi",
                        "Dosya notları sayfasına giriş işlemi iptal edildi.",
                        "error"
                    ).then(function () {
                        window.location.href = "{{ route('lawsuit.index') }}";
                    });
                }
            });
        });
    </script>
@endsection
