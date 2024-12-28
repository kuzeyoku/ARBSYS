    <div style="margin-bottom:30px;margin-top:30px" id="content" identifier="content">{!! $document_content !!}</div>
    @if (isset($lawsuit) && isset($sides))
        <table class="sides" style="margin-bottom:20px">
            <tr>
                <td class="left">
                    @foreach ($lawsuit->claimants() as $claimant)
                        <h1 class="title">TARAF</h1>
                        <div class="line">{{ $claimant->detail->name }}</div>
                        @if ($claimant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL && in_array($claimant->id, $sides))
                            <br><br>
                        @endif

                        @foreach ($claimant->sub_sides as $side)
                            @if (in_array($side->id, $sides))
                                <div class="side" identifier="randomUuid1side">
                                    <div class="line">{{ $side->applicant_title }}</div>
                                    <div class="line">
                                        {{ $side->detail->name }}</div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </td>
                <td class="right">
                    @foreach ($lawsuit->defendants() as $defendant)
                        <h1 class="title">TARAF</h1>
                        <div class="line">{{ $defendant->detail->name }}</div>
                        @if ($defendant->side_applicant_type_id == ApplicantTypeOptions::INDIVIDUAL && in_array($defendant->id, $sides))
                            <br><br>
                        @endif
                        @foreach ($defendant->sub_sides as $side)
                            @if (!in_array($side->id, $sides))
                                @continue
                            @endif
                            <div class="side" identifier="randomUuid2side">
                                <div class="line">{{ $side->applicant_title }}</div>
                                <div class="line">{{ $side->detail->name }}
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </td>
            </tr>
        </table>
    @endif
    <div class="text-center" id="sub-bottom" identifier="sub-bottom">
        @include('mediator.document.mediator_info', ['phone' => true])
    </div>
