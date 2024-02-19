@extends('layout.main')
@section('style')
    <link href="{{ asset('css/typeahead.css') }}" rel="stylesheet" type="text/css" >
@endsection
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Arabulucu </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="/arabulucu-liste" class="kt-subheader__breadcrumbs-link">
                            Arabulucu Değişiklik Talepleri
                        </a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Arabulucu Değişiklik Talep Düzenle</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_2" role="tab">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                            <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg> Arabulucu Bilgileri
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_user_edit_tab_2" role="tabpanel">
                            <div class="kt-form kt-form--label-right">
                                <div class="kt-form__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <form action="/arabulucu/{{ $user->parent_id }}" method="POST" id="step1_form" name="change_request">
                                                @method('PUT')
                                                @csrf
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <h3 class="kt-section__title kt-section__title-sm">Arabulucu Bilgileri:</h3>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Ad Soyad</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control" type="text" name="name" value="{{ $user->name }}" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Telefon</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                            <input type="text" class="form-control phonemask" name="phone" value="{{ $user->phone }}" placeholder="Telefon" autocomplete="off" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                            <input type="email" class="form-control emailmask" name="email" value="{{ $user->request_email ?? $user->email }}" placeholder="Email" autocomplete="off" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Adres</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <textarea class="form-control" name="address" autocomplete="off" >{{ $user->address }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Sicil No</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control" type="text" name="registration_no" value="{{ $user->soother->registration_no ?? "" }}" autocomplete="off">
                                                        <span class="form-text text-muted"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">IBAN</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control ibanmask" type="text" name="iban" value="{{ $user->soother->iban ?? "" }}" autocomplete="off" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Arabuluculuk Merkezi</label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <input class="form-control" name="mediation_center" value="{{ $user->soother->mediation_center ?? "" }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Toplantı Yeri</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <textarea class="form-control" name="meeting_address" autocomplete="off" >{{ $user->soother->meeting_address ?? "" }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                    </label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                                            <input type="checkbox" value="1" name="meeting_address_proposal" {{ $user->soother->meeting_address_proposal ? "checked" : "" }}>Toplantı yerini her dosyada (sabit olarak) öner.
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="kt-form__actions">
                                                    <div class="row">
                                                        <div class="col-xl-3"></div>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <button type="button" class="btn btn-label-brand btn-bold btn-block" id="step1_save">Değişiklik Talebini Onayla</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>
@endsection
@section('script')
    <script>
        $("#step1_save").on('click', function ()
        {
            var btn = $(this);
            var form = $("form[name='change_request']");

            var validator = form.validate({
                lang:"tr",
                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    name: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    email: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    registration_no: {
                        required: true,
                    },
                    iban: {
                        required: true,
                    }
                }
            });

            if (validator.form() === true)
            {
                KTApp.progress(btn);

                form.submit();
            }
        });
    </script>
@endsection
@section('style')
@endsection


