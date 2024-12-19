@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', ['url' => [null => 'Kullanıcı Düzenle']])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Kişi Düzenle
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    {{ Form::open(['url' => route('admin.user.update', $user), 'method' => 'PUT']) }}
                    <div class="form-group">
                        {{ Form::label('Ad Soyad') }}
                        {{ Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Ad Soyad Giriniz']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Cinsiyeti') }}
                        {{ Form::select('gender', [null => 'Belirtmek İstemiyorum', 'erkek' => 'Erkek', 'kadın' => 'Kadın'], $user->gender, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Doğum Tarihi') }}
                        {{ Form::date('borndate', $user->borndate, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Telefon') }}
                        {{ Form::text('phone', $user->phone, ['class' => 'form-control phonemask']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('EMail') }}
                        {{ Form::email('email', $user->email, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Şifre') }}
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Şifre Giriniz']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Şifre Tekrar') }}
                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Şifre Tekrar Giriniz']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Tebligat Adresi') }}
                        {{ Form::textarea('address', $user->address, ['class' => 'form-control', 'placeholder' => 'Tebligat Adresinizi Giriniz', 'rows' => 3]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Sicil No') }}
                        {{ Form::text('registration_no', $user->mediator->registration_no, ['class' => 'form-control registrationmask']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('IBAN') }}
                        {{ Form::text('iban', $user->mediator->iban, ['class' => 'form-control ibanmask']) }}
                    </div>
                    <div class="form-group mb-3">
                        {{ Form::label('Toplatı Yeri (Adresi)') }}
                        {{ Form::textarea('meeting_address', $user->mediator->meeting_address, ['class' => 'form-control', 'placeholder' => 'Toplantı Yeri (Adresi) Giriniz', 'rows' => 3]) }}
                    </div>
                    <div class="kt-login__actions mt-4">
                        {{ Form::submit('Güncelle', ['class' => 'btn btn-primary']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/localization.js') }}"></script>
    <script src="{{ asset('js/enums.js') }}"></script>
@endsection
