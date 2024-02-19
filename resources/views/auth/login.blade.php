@extends('auth.main')
@section('title', 'Oturum Açın')
@section('content')
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title">Oturum Açın</h3>
        </div>
        {{ Form::open(['url' => route('login'), 'method' => 'post', 'class' => 'kt-form']) }}
        <div class="form-group">
            {{ Form::email('email', null, ['class' => 'form-control border', 'placeholder' => 'E-Posta', 'required' => '']) }}
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group">
            {{ Form::password('password', ['class' => 'form-control border', 'placeholder' => 'Şifre']) }}
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="g-recaptcha {{ $errors->has('g-recaptcha-response') ? 'mb-1' : 'mb-3' }}"
            data-sitekey="{{ config('recaptcha.site_key') }}"></div>
        @if ($errors->has('g-recaptcha-response'))
            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
        @endif
        <div class="row">
            <div class="col">
                <label class="kt-checkbox">
                    {{ Form::checkbox('rememberMe', true, false, ['class' => 'form-control']) }}
                    Beni Hatırla <span></span>
                </label>
            </div>
            <div class="col kt-align-right">
                <a class="kt-login__link" href="{{ route('password.request') }}">Şifremi Unuttum ?</a>
            </div>
        </div>
        <div class="kt-login__actions">
            {{ Form::submit('Giriş Yap', ['class' => 'btn btn-brand kt-login__btn-primary']) }}
        </div>
        {{ Form::close() }}
    </div>
    <div class="kt-login__account">
        <span class="kt-login__account-msg">
            Henüz bir hesabınız yokmu ?
        </span>
        <a href="{{ route('register') }}" class="kt-login__account-link">Kayıt Ol!</a>
    </div>
@endsection
