@extends('auth.layout')
@section('title', 'Şifre Sıfırlama')
@section('content')
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title">Yeni Şifre Oluştur</h3>
        </div>
        {{ Form::open(['url' => route('password.update'), 'method' => 'post']) }}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            {{ Form::label('E-Mail Adresiniz') }}
            {{ Form::email('email', $email ?? old('email'), ['class' => 'form-control', 'placeholder' => 'E-Mail Adresinizi Girin', 'readonly' => '']) }}
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group">
            {{ Form::label('Şifreniz') }}
            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Şifrenizi Girin']) }}
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group">
            {{ Form::label('Şifreniz Tekrar') }}
            {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Şifrenizi Tekrar Girin']) }}
            @if ($errors->has('password_confirmation'))
                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>
        <div class="form-group">
            <div class="g-recaptcha {{ $errors->has('g-recaptcha-response') ? 'mb-1' : 'mb-3' }}"
                data-sitekey="{{ config('recaptcha.site_key') }}"></div>
            @if ($errors->has('g-recaptcha-response'))
                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
            @endif
        </div>
        <div class="form-group">
            {{ Form::submit('Kaydet', ['class' => 'btn btn-brand kt-login__btn-primary']) }}
        </div>
        {{ Form::close() }}

    </div>
@endsection