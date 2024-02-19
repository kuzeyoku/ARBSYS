@extends('auth.layout')
@section('title', 'Şifre Sıfırlama')
@section('content')
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title">Şifremi Unuttum ?</h3>
        </div>
        {{ Form::open(['url' => route('password.email'), 'method' => 'post']) }}
        <div class="form-group">
            {{ Form::label('E-Mail Adresiniz') }}
            {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-Mail Adresinizi Girin']) }}
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
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
            {{ Form::submit('Şifremi Sıfırla', ['class' => 'btn btn-brand kt-login__btn-primary']) }}
        </div>
        {{ Form::close() }}
    </div>
@endsection
