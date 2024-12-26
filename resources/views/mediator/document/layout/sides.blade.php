@foreach ($lawsuit->sides as $side)
    @if ($side->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL)
        <strong>{{ $loop->iteration . ') ' . App\Services\HelperService::nameFormat($side->detail->name) }}</strong>
        (T.C. Kimlik No: <strong>{{ $side->detail->identification }}</strong>)<br>
    @elseif($side->side_applicant_type_id == ApplicantTypeOptions::COMPANY)
        <strong>{{ $loop->iteration . ') ' . App\Services\HelperService::nameFormat($side->detail->name) }}</strong><br>
        (Mersis No: <strong>{{ $side->detail->mersis_number }}</strong>)
        (<strong>{{ $side->detail->taxOffice->name }}</strong> V.D. <strong>{{ $side->detail->tax_number }}</strong>)<br>
    @endif
    {{ App\Services\HelperService::addressFormat($side->detail->address) }}
    <br>
    @if ($side->sub_sides->count() > 0)
        @if ($side->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL)
            <strong>Vekili</strong> <br>
        @elseif($side->side_applicant_type_id == ApplicantTypeOptions::COMPANY)
            <strong>Vekili/Yetkilisi</strong> <br>
        @endif
        @foreach ($side->sub_sides as $sub_side)
            <strong>{{ App\Services\HelperService::nameFormat($sub_side->detail->name) }}</strong> (T.C. Kimlik
            No: <strong>{{ $sub_side->detail->identification }}</strong>)
            {{ App\Services\HelperService::addressFormat($sub_side->detail->address) }}
        @endforeach
    @endif
    @if (!$loop->last)
        <br><br>
    @endif
@endforeach
