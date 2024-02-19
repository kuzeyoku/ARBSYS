@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', ['url' => [null => 'Mesajlar']])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Mesajlar
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <ul class="nav nav-pills mb-3 d-flex justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">Mesajlar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Okunmuş Mesajlar</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            @forelse ($notReadMessages as $message)
                                <form action="{{ route('notification.read', $message) }}">
                                    <div class="card mb-4">
                                        <div1
                                            class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                                            <h3 class="inline-text">Bildirim Mesajı</h3>
                                            <button type="submit"
                                                style="padding: 0; background: none; background-color: none; border: none; color: #f1f1f1;"
                                                class="d-flex align-items-center">
                                                Okundu olarak işaretle
                                                <i class="fa-sharp fa-solid fa-circle-check ml-2"
                                                    style="cursor: pointer; font-size: 1.2rem; color: #f1f1f1;"></i>
                                            </button>
                                        </div1>
                                        <div class="card-body">
                                            {!! $message->text !!}
                                        </div>
                                    </div>
                                </form>
                            @empty
                                <div class="card-body text-center">
                                    <strong class="card-text">Mesajınız Bulunmamaktadır...</strong>
                                </div>
                            @endforelse
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            @foreach ($messages as $message)
                                <div class="card mb-4">
                                    <div class="card-header d-flex align-items-center bg-primary text-white">
                                        <h3 class="inline-text">Bildirim Mesajı</h3>
                                    </div>
                                    <div class="card-body">
                                        {!! $message->text !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
