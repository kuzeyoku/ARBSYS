@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', ['url' => [null => 'Kullanıcı İşlemleri']])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div
                    class="kt-portlet__head kt-portlet__head--lg d-flex flex-row justify-content-between align-items-center">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            <i class="kt-font-brand flaticon2-line-chart"></i> Kullanıcı Listesi
                        </h3>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#createUserModal">Kullanıcı Ekle</button>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-striped table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Ad Soyad</th>
                                <th class="d-none d-lg-table-cell">Telefon</th>
                                <th class="d-none d-lg-table-cell">Email</th>
                                <th class="d-none d-lg-table-cell">Sicil No</th>
                                <th class="d-none d-lg-table-cell">Kalan Gün</th>
                                <th class="d-none d-lg-table-cell">Kullanım Sonu</th>
                                <th width="205">işlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td class="d-none d-lg-table-cell align-middle">{{ $user->phone }}</td>
                                    <td class="d-none d-lg-table-cell align-middle">{{ $user->email }}</td>
                                    <td class="d-none d-lg-table-cell align-middle">
                                        {{ $user->mediator->registration_no ?? null }}
                                    </td>
                                    <td class="align-middle">
                                        <strong
                                            class="{{ $user->remaining_day > 0 ? 'text-success' : 'text-danger' }}">{{ $user->remaining_day }}</strong>
                                    </td>
                                    <td class="align-middle">
                                        {{ Form::open(['url' => route('admin.user.date.update', $user)]) }}
                                        <div class="input-group">
                                            {{ Form::date('date', $user->end, ['class' => 'form-control d-inline']) }}
                                            <div class="input-group-append">
                                                {{ Form::submit('Güncelle', ['class' => 'btn btn-primary d-inline']) }}
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            {{ Form::open(['url' => route('admin.user.destroy', $user), 'method' => 'DELETE']) }}
                                            <button type="button"
                                                class="btn btn-danger btn-elevate delete-btn kt-login__btn-primary"
                                                style="color: white;">Sil</button>
                                            {{ Form::close() }}
                                            @if ($user->is_active == 0)
                                                <a href="{{ route('admin.user.confirm', $user) }}"
                                                    class="btn btn-success btn-elevate kt-login__btn-primary"
                                                    style="color: white;">
                                                    Onayla
                                                </a>
                                            @elseif ($user->is_active == 2)
                                                <a href="{{ route('admin.user.confirm', $user) }}"
                                                    class="btn btn-success btn-elevate kt-login__btn-primary"
                                                    style="color: white;">
                                                    Onayla
                                                </a>
                                            @elseif ($user->is_active == 1)
                                                <a href="{{ route('admin.user.ban', $user) }}"
                                                    class="btn btn-warning btn-elevate kt-login__btn-primary"
                                                    style="color: white;">
                                                    <small>Askıya Al</small>
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.user.edit', $user) }}"
                                                class="btn btn-primary btn-elevate kt-login__btn-primary"
                                                style="color: white;">
                                                <small>Düzenle</small>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Kullanıcı Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['url' => route('admin.user.store')]) }}
                    <div class="form-group">
                        {{ Form::label('Ad Soyad') }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ad Soyad Giriniz', 'required' => '']) }}
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Cinsiyet') }}
                                {{ Form::select('gender', ['erkek' => 'Erkek', 'kadın' => 'Kadın'], 'default', ['class' => 'form-control', 'placeholder' => '--Seçiniz--']) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Doğum Tarihi') }}
                                {{ Form::date('borndate', null, ['class' => 'form-control', 'placeholder' => 'Doğum Tarihi Giriniz', 'required' => '']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Telefon') }}
                                {{ Form::text('phone', null, ['class' => 'form-control phonemask', 'placeholder' => 'Telefon Giriniz', 'required' => '']) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('E-Mail') }}
                                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-Mail Giriniz', 'required' => '']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Şifre') }}
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Şifre Giriniz', 'required' => '']) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Şifre Tekrar') }}
                                {{ Form::password('rpassword', ['class' => 'form-control', 'placeholder' => 'Şifre Tekrar Giriniz', 'required' => '']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('Tebligat Adresi') }}
                        {{ Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Tebligat Adresi Giriniz', 'rows' => 3]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Sicil No') }}
                        {{ Form::text('registration_no', null, ['class' => 'form-control registrationmask', 'placeholder' => 'Sicil No Giriniz', 'required' => '']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('iban') }}
                        {{ Form::text('iban', null, ['class' => 'form-control ibanmask', 'placeholder' => 'IBAN']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Toplantı Yeri (Adresi)') }}
                        {{ Form::textarea('meeting_address', null, ['class' => 'form-control', 'placeholder' => 'Toplantı Yeri (Adresi)', 'rows' => 3]) }}
                    </div>
                    <div class="form-group">
                        <label class="kt-checkbox">
                            {{ Form::checkbox('meeting_address_proposal') }}Toplantı Yerini Her Dosyada Sabit
                            Olarak Öner <span></span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                    {{ Form::submit('Ekle', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
