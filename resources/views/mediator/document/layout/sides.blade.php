@foreach ($lawsuit->sides as $side)
    @if ($side->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL)
        <strong>{{ $loop->iteration . ') ' . $side->detail->name}}</strong>
        (T.C. Kimlik No: <strong>{{ $side->detail->identification }}</strong>)<br>
    @elseif($side->side_applicant_type_id == ApplicantTypeOptions::COMPANY)
        <strong>{{ $loop->iteration . ') ' . $side->detail->name }}</strong><br>
        @if($side->detail->mersus_number)
            (Mersis No: <strong>{{ $side->detail->mersis_number }}</strong>)
        @endif
        @if($side->detail->detsis_number)
            (Detsis No: <strong>{{ $side->detail->detsis_number }}</strong>)
        @endif
        @if($side->detail->taxOffice || $side->detail->tax_number)
            (<strong>{{ $side->detail->taxOffice->name ?? null }}</strong> V.D. <strong>{{ $side->detail->tax_number }}</strong>)
        @endif
        <br>
    @endif
    {{ $side->detail->address }}
    @if ($side->sub_sides->count() > 0)
        @if ($side->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL)
            <strong>Vekili</strong> <br>
        @elseif($side->side_applicant_type_id == ApplicantTypeOptions::COMPANY)
            <strong>Vekili/Yetkilisi</strong> <br>
        @endif
        @foreach ($side->sub_sides as $sub_side)
            <strong>{{ $sub_side->detail->name }}</strong> (T.C. Kimlik
            No: <strong>{{ $sub_side->detail->identification }}</strong>)
            {{$sub_side->detail->address}}
        @endforeach
    @endif
    @if (!$loop->last)
        <br><br>
    @endif
@endforeach
