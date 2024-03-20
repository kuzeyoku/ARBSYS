<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>ARBSYS</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="/assets/media/logos/arbsysLOGO.png" />
</head>

<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
                style="background-image: url(assets/media/bg/bg-3.jpg);">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('/assets/media/logos/arbsysLOGO2.png') }}">
                            </a>
                        </div>
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Kayıt Ol</h3>
                            <div class="kt-login__desc">Kullanıcı detaylarını girin:</div>
                        </div>
                        @include('layout.form_error')
                        {{ Form::open(['url' => route('register'), 'method' => 'POST', 'class' => 'kt-form']) }}
                        <div class="form-group">
                            {{ Form::label('Adınız ve Soyadınız') }}
                            {{ Form::text('name', null, ['class' => 'form-control border', 'placeholder' => 'Ad Soyad Giriniz', 'required' => '']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('Doğum Tarihiniz') }}
                            {{ Form::date('borndate', null, ['class' => 'form-control border', 'placeholder' => 'Doğum Tarihi']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('Cinsiyetiniz') }}
                            {{ Form::select('gender', ['erkek' => 'Erkek', 'kadın' => 'Kadın', null => 'Belirtmek İstemiyorum'], 'default', ['class' => 'form-control border']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('Telefon Numaranız') }}
                            {{ Form::text('phone', null, ['class' => 'form-control border phonemask', 'placeholder' => 'Telefon', 'required' => '']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('E-Mail Adresiniz') }}
                            {{ Form::email('email', null, ['class' => 'form-control border emailmask', 'placeholder' => 'Email', 'required' => '']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('Parola') }}
                            {{ Form::password('password', ['class' => 'form-control border', 'placeholder' => 'Parola']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('Parola Tekrar') }}
                            {{ Form::password('password_confirm', ['class' => 'form-control border', 'placeholder' => 'Parola Tekrar']) }}
                        </div>
                        <div class="g-recaptcha" data-sitekey="{{ config('recaptcha.site_key') }}"></div>
                        <div class="kt-login__actions">
                            {{ Form::submit('Kayıt Ol', ['class' => 'btn btn-brand kt-login__btn-primary']) }}
                            {{ Form::reset('Vazgeç', ['class' => 'btn btn-light kt-login__btn-secondary border']) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    @include('layout.alert')
    <script>
        $(document).ready(function() {
            $(".phonemask").inputmask("9999999999");
        });
    </script>
</body>

</html>
