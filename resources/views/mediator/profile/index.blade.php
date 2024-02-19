@extends('layout.main')
@section('content')
    @include('layout.breadcrumb', ['url' => [null => 'Profilim']])
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0">{{ $user->name }}</h4>
                        <p class="card-text">
                            Arabulucu Profili
                        </p>
                    </div>
                    <hr>
                    @if ($user->getChange())
                        <div class="alert alert-danger">
                            Göndermiş olduğunuz değişiklik talebininz inceleniyor. Lütfen yeni talep
                            göndermeden önce eski talebinizin değerlendirilmesini bekleyiniz. Ard arda gönderilen talepler
                            değerlendirilmeyecektir. <br>Yaptığınız değişiklikler onaylandığında profilinizde
                            görüntülenecektir.
                        </div>
                    @endif
                    {{ Form::open(['url' => route('mediator.update', $user), 'method' => 'PUT']) }}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Ad Soyad') }}
                                {{ Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Ad Soyad Giriniz']) }}
                                @if ($errors->has('name'))
                                    <span class="form-text text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('T.C. Kimlik No') }}
                                {{ Form::text('identification', $user->mediator->identification, ['class' => 'form-control tcmask', 'placeholder' => 'T.C. Kimlik No']) }}
                                @if ($errors->has('identification'))
                                    <span class="form-text text-danger">{{ $errors->first('identification') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('ADB Sicil No') }}
                                {{ Form::text('registration_no', $user->mediator->registration_no, ['class' => 'form-control registrationmask', 'placeholder' => 'Sicil No Giriniz']) }}
                                @if ($errors->has('registration_no'))
                                    <span class="form-text text-danger">{{ $errors->first('registration_no') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('IBAN') }}
                                {{ Form::text('iban', $user->mediator->iban, ['class' => 'form-control ibanmask', 'placeholder' => 'IBAN Numarası Giriniz']) }}
                                @if ($errors->has('iban'))
                                    <span class="form-text text-danger">{{ $errors->first('iban') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('E-Posta') }}
                                {{ Form::text('email', $user->email, ['class' => 'form-control emailmask']) }}
                                @if ($errors->has('email'))
                                    <span class="form-text text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Telefon') }}
                                {{ Form::text('phone', $user->phone, ['class' => 'form-control phonemask']) }}
                                @if ($errors->has('phone'))
                                    <span class="form-text text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Arabuluculuk Merkezi') }}
                                {{ Form::select('mediation_center', App\Models\MediationCenter::selectToArray(), $user->mediator->mediation_center_id, ['class' => 'form-control selectSearch', 'placeholder' => '--Seçiniz--', 'id' => 'mediation_center', 'data-url' => route('get_mediation_center_address')]) }}
                                @if ($errors->has('mediation_center'))
                                    <span class="form-text text-danger">{{ $errors->first('mediation_center') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group" style="margin-top:30px">
                                <label class="kt-checkbox">
                                    {{ Form::checkbox('meeting_address_proposal', true, $user->mediator->meeting_address_proposal) }}Toplantı
                                    Yerini Her Dosyada Sabit
                                    Olarak Öner <span></span>
                                </label>
                                @if ($errors->has('meeting_address_proposal'))
                                    <span class="form-text text-danger">{{ $errors->first('meeting_addre') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Toplantı Yeri') }}
                                {{ Form::textarea('meeting_address', $user->mediator->meeting_address, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Toplantı Yeri Adresi Giriniz', 'id' => 'meeting_address']) }}
                                @if ($errors->has('meeting_address'))
                                    <span class="form-text text-danger">{{ $errors->first('meeting_address') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('Tebligat Adresi') }}
                                {{ Form::textarea('address', $user->address, ['class' => 'form-control', 'placeholder' => 'Tebligat Adresi Giriniz', 'rows' => 3]) }}
                                @if ($errors->has('address'))
                                    <span class="form-text text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{ Form::Submit('Kaydet', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
