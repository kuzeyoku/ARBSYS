<div class="page-title">
    ARABULUCU BELİRLEME TUTANAĞI
</div>
<div class="template text-justify" identifier="template">
    <table>
        @foreach ($lawsuit->claimants as $claimant)
            <tr>
                <td>BAŞVURUCU</td>
                <td>:</td>
                <td>
                    @if ($claimant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL)
                        {{ $claimant->detail->name }} (T.C. Kimlik No:{{ $claimant->detail->identification }})<br>
                    @elseif($claimant->side_applicant_type_id == ApplicantTypeOptions::COMPANY)
                        {{ $claimant->detail->name }}<br>
                        (Mersis No: {{ $claimant->detail->mersis_number }}) ({{ $claimant->detail->tax_office }} V.D.
                        {{ $claimant->detail->tax_number }})<br>
                    @endif
                </td>
            </tr>
            <tr>
                <td>ADRESİ</td>
                <td>:</td>
                <td>
                    {{ $claimant->detail->address }}
                </td>
            </tr>
            <tr>
                <td>İLETİŞİM</td>
                <td>:</td>
                <td>
                    {{ !is_null($claimant->detail->phone) ? $claimant->detail->phone . ' - ' : '' }}
                    {{ $claimant->detail->email }}
                </td>
            </tr>
            @foreach ($claimant->sub_sides as $side)
                <tr>
                    <td>{{ Str::upper($side->applicant_title) }}</td>
                    <td>:</td>
                    <td>
                        {{ $side->detail->name }} (T.C. Kimlik No:{{ $side->detail->identification }})
                    </td>
                </tr>
                <tr>
                    <td>ADRESİ</td>
                    <td>:</td>
                    <td>
                        {{ $side->detail->address }}
                    </td>
                </tr>
                <tr>
                    <td>İLETİŞİM</td>
                    <td>:</td>
                    <td>
                        {{ !is_null($side->detail->phone) ? $side->detail->phone . ' - ' : '' }}
                        {{ $side->detail->email }}
                    </td>
                </tr>
            @endforeach
        @endforeach
        @foreach ($lawsuit->defendants as $defendant)
            <tr>
                <td>DİĞER TARAF</td>
                <td>:</td>
                <td>
                    @if ($defendant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL)
                        {{ $defendant->detail->name }} (T.C. Kimlik No:{{ $defendant->detail->identification }})<br>
                    @elseif($defendant->side_applicant_type_id == ApplicantTypeOptions::COMPANY)
                        {{ $defendant->detail->name }}<br>
                        (Mersis No: {{ $defendant->detail->mersis_number }}) ({{ $defendant->detail->tax_office }}
                        V.D. {{ $defendant->detail->tax_number }})<br>
                    @endif
                </td>
            </tr>
            <tr>
                <td>ADRESİ</td>
                <td>:</td>
                <td>
                    {{ $defendant->detail->address }}
                </td>
            </tr>
            <tr>
                <td>İLETİŞİM</td>
                <td>:</td>
                <td>
                    {{ !is_null($defendant->detail->phone) ? $defendant->detail->phone . ' - ' : '' }}
                    {{ $defendant->detail->email }}
                </td>
            </tr>
            @foreach ($defendant->sub_sides as $side)
                <tr>
                    <td>{{ ucwords($side->applicant_title) }}</td>
                    <td>:</td>
                    <td>
                        {{ $side->detail->name }} (T.C. Kimlik No:{{ $side->detail->identification }})
                    </td>
                </tr>
                <tr>
                    <td>ADRESİ</td>
                    <td>:</td>
                    <td>
                        {{ $side->detail->address }}
                    </td>
                </tr>
                <tr>
                    <td>İLETİŞİM</td>
                    <td>:</td>
                    <td>
                        {{ !is_null($side->detail->phone) ? $side->detail->phone . ' - ' : '' }}
                        {{ $side->detail->email }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
        <tr>
            <td>UYUŞMAZLIK TÜRÜ</td>
            <td>:</td>
            <td>@UyusmazlikTuru</td>
        </tr>
        <tr>
            <td>UYUŞMAZLIK KONUSU</td>
            <td>:</td>
            <td>@UyusmazlıkKonu</td>
        </tr>
    </table>
</div>
<p class="paragraph" style="margin-top: 20px;">
    {!! $result ?? '' !!}
</p>
<p class="paragraph">
    Arabuluculuk Bürosu’ndaki başvuru ve kayıt işlemlerinin bu bilgiler ışığında yapılmasını talep ederiz. @BugunTarih
</p>
<table>
    <tr class="vertical-top font-bold">
        <td>Başvurucu</td>
        <td>Muhatap</td>
        <td>Arabulucu</td>
    </tr>
    <tr class="vertical-top">
        <td>
            @foreach ($lawsuit->claimants as $claimant)
                <h1 class="title">TARAF</h1>
                <div class="line">{{ $claimant->detail->name }}</div>
                @if ($claimant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL && in_array($claimant->id, $side_ids))
                    <br><br><br><br>
                @endif
                @foreach ($claimant->sub_sides as $side)
                    @if (!in_array($side->id, $side_ids))
                        @continue
                    @endif
                    <div class="side" identifier="randomUuid1side">
                        <div class="line">{{ $side->applicant_title }}</div>
                        <div class="line">{{ $side->detail->name }}</div>
                    </div>
                @endforeach
            @endforeach
        </td>
        <td>
            @foreach ($lawsuit->defendants as $defendant)
                <h1 class="title">TARAF</h1>
                <p>{{ $defendant->detail->name }}</p>
                @if ($defendant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL && in_array($defendant->id, $side_ids))
                    <br><br><br><br>
                @endif
                @foreach ($defendant->sub_sides as $side)
                    @if (!in_array($side->id, $side_ids))
                        @continue
                    @endif
                    <div class="side" identifier="randomUuid2side">
                        <div class="line">{{ $side->applicant_title }}</div>
                        <div class="line">{{ $side->detail->name }}</div>
                    </div>
                @endforeach
            @endforeach
        </td>
        <td>
            <p>Arb. Av. {{ auth()->user()->name }} <br />(ADB Sicil No:
                {{ auth()->user()->mediator->registration_no }}) </p>
        </td>
    </tr>
</table>
<p class="text-center font-bold" style="margin-top: 50px;">
    İşbu tutanak @TeslimEdenAdSoyad (T.C. Kimlik No: @TeslimEdenTCKNo) tarafından teslim edilecektir.
</p>
