@extends('layout.print')
@section('content')
    <div style="text-align: justify">{!! $document_content !!}</div>
    @if (isset($lawsuit) && isset($sides))
        <table>
            <tr>
                <td class="left">
                    @foreach ($lawsuit->getClaimants() as $claimant)
                        <h1 class="title">TARAF</h1>
                        <div class="line">{{ $claimant->detail->name }}</div>
                        @if ($claimant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL && in_array($claimant->id, $side_ids))
                            <br><br>
                        @endif
                        @foreach ($claimant->sub_sides as $side)
                            @if (in_array($side->id, $side_ids))
                                <div class="side" identifier="randomUuid1side">
                                    <div class="line">{{ $side->applicant_title }}</div>
                                    <div class="line">{{ $side->detail->name }}</div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </td>
                <td class="right">
                    @foreach ($lawsuit->getDefendants() as $defendant)
                        <h1 class="title">TARAF</h1>
                        <div class="line">{{ $defendant->detail->name }}</div>
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
            </tr>
        </table>
    @endif
@endsection
