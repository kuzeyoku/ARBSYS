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
                            <li class="breadcrumb-item active" aria-current="page">Görüş ve Öneri Kategorileri Düzenle</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-12">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Düzenle
                                </h3>
                            </div>
                        </div>

                        <!--begin::Form-->
                        <form class="kt-form kt-form--label-right" action="/system_request_category/{{$system_request_category->id}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="kt-portlet__body">
                                @if(session()->has('message.status'))
                                    <div class="alert alert-{{ session()->get('message.status') }}">
                                        {!! session('message.content') !!}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Başlık</label>
                                            <input class="form-control" type="text" name="name" autocomplete="off" required value="{{ $system_request_category->name }}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-12 ml-lg-auto">
                                            <button type="submit" class="btn btn-brand btn-block">Gönder</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!--end::Form-->
                    </div>

                    <!--end::Portlet-->
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/plugins/summernote/summernote.js') }}"></script>
    <script src="{{ asset('js/plugins/summernote/summernote-tr-TR.js') }}"></script>
@endsection
