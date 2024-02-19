@extends('backend.document.template.print')
@section('content')
    <div id="content" identifier="content">{!! $document_content !!}</div>
    <table class="sides">
        <tr>
            <td class="left">
                @foreach($claimants as $claimant)
                    <h1 class="title">TARAF</h1>
                    <div class="line">{{ $claimant->detail->name }}</div>
                    @if($claimant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL)
                        <br><br><br><br>
                    @endif
                    @foreach($claimant->sub_sides as $side)
                        <div class="side" identifier="randomUuid1side">
                            <div class="line">{{ $side->applicant_title }}</div>
                            <div class="line">{{ $side->detail->name }}</div>
                        </div>
                    @endforeach
                @endforeach
            </td>
            <td class="right">
                @foreach($defendants as $defendant)
                    <h1 class="title">TARAF</h1>
                    <div class="line">{{ $defendant->detail->name }}</div>
                    @if($defendant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL)
                        <br><br><br><br>
                    @endif
                    @foreach($defendant->sub_sides as $side)
                        <div class="side" identifier="randomUuid2side">
                            <div class="line">{{ $side->applicant_title }}</div>
                            <div class="line">{{ $side->detail->name }}</div>
                        </div>
                    @endforeach
                @endforeach
            </td>
        </tr>
    </table>
    <div class="text-center" id="sub-bottom" identifier="sub-bottom">
        @include('backend.document.partials.soother_info')
    </div>
@endsection
