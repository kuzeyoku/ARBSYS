<tr>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td class="vertical-top">TARAFLAR</td>
    <td class="vertical-top">:</td>
    <td>
        @php $count = 1 @endphp
        @foreach ($lawsuit->getClaimants() as $claimant)
            @if ($claimant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL)
                <strong>{!! $count != 1 ? '<br>' : '' !!}{{ $count }}
                    {{ App\Services\HelperService::nameFormat($claimant->detail->name) }} (T.C. Kimlik No:
                    {{ $claimant->detail->identification }})</strong><br>
                {{ App\Services\HelperService::addressFormat($claimant->detail->address) }}<br>
            @elseif($claimant->side_applicant_type_id == ApplicantTypeOptions::COMPANY)
                <strong>{!! $count != 1 ? '<br>' : '' !!}{{ $count }}
                    {{ App\Services\HelperService::nameFormat($claimant->detail->name) }}</strong><br>
                <strong>(Mersis No: {{ $claimant->detail->mersis_number }}) ({{ $claimant->detail->tax_office }} V.D.
                    {{ $claimant->detail->tax_number }})</strong><br>
                {{ App\Services\HelperService::addressFormat($claimant->detail->address) }}<br>
            @endif
            @foreach ($claimant->sub_sides as $side)
                <strong>{{ $side->applicant_title_case }}</strong><br>
                <strong>{{ $side->detail->name }} (T.C. Kimlik No: {{ $side->detail->identification }})</strong><br>
                {!! !is_null($side->detail->address)
                    ? App\Services\HelperService::addressFormat($side->detail->address) . '<br>'
                    : '' !!}
            @endforeach
            @if (isset($sides) && !is_null($sides))
                @foreach ($sides as $side)
                    @if ($side['side_id'] == $claimant->id)
                        <strong>{{ $side['title'] }}</strong><br>
                        <strong>{{ $side['name'] }}</strong><br>
                        {{ $side['address'] }}<br>
                    @endif
                @endforeach
            @endif
            @php $count++ @endphp
        @endforeach
        @foreach ($lawsuit->getDefendants() as $defendant)
            @if ($defendant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL)
                <strong>{!! $count != 1 ? '<br>' : '' !!}{{ $count }}
                    {{ App\Services\HelperService::nameFormat($defendant->detail->name) }} (T.C. Kimlik No:
                    {{ $defendant->detail->identification }})</strong><br>
                {{ App\Services\HelperService::addressFormat($defendant->detail->address) }}<br>
            @elseif($defendant->side_applicant_type_id == ApplicantTypeOptions::COMPANY)
                <strong>{!! $count != 1 ? '<br>' : '' !!}{{ $count }}
                    {{ App\Services\HelperService::nameFormat($defendant->detail->name) }}</strong><br>
                <strong>(Mersis No: {{ $defendant->detail->mersis_number }}) ({{ $defendant->detail->tax_office }}
                    V.D. {{ $defendant->detail->tax_number }})</strong><br>
                {{ App\Services\HelperService::addressFormat($defendant->detail->address) }}<br>
            @endif
            @foreach ($defendant->sub_sides as $side)
                <strong>{{ $side->applicant_title_case }}</strong><br>
                <strong>{{ App\Service\HelperService::nameFormat($side->detail->name) }} (T.C. Kimlik No:
                    {{ $side->detail->identification }})</strong><br>
                {!! !is_null($side->detail->address)
                    ? App\Services\HelperService::addressFormat($side->detail->address) . '<br>'
                    : '' !!}
            @endforeach
            @if (isset($sides) && !is_null($sides))
                @foreach ($sides as $side)
                    @if ($side['side_id'] == $defendant->id)
                        <strong>{{ $side['title'] }}</strong><br>
                        <strong>{{ $side['name'] }}</strong><br>
                        {{ $side['address'] }}<br>
                    @endif
                @endforeach
            @endif
            @php $count++ @endphp
        @endforeach
    </td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
</tr>
