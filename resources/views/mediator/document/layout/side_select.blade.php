<div class="kt-form__section kt-form__section--first">
    <div class="kt-wizard-v4__form">
        <div class="row">
            <div class="col-md-6">
                <div class="kt-heading kt-heading--md">Başvurucu</div>
                @foreach ($lawsuit->sides->where("side_type_id",SideTypeOptions::CLAIMANT) as $claimant)
                    <div class="form-group">
                        <div class="kt-checkbox-list">
                            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                <input type="checkbox" name="side_ids[]" value="{{ $claimant->id }}"
                                       data-name="{{ $claimant->detail->name }}">
                                {{ $claimant->detail->name }}
                                <span></span>
                            </label>
                        </div>
                    </div>
                    @foreach ($claimant->sub_sides as $side)
                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"
                               id="checkbox-{{ $side->id }}">
                            <input type="checkbox" name="side_ids[]" value="{{ $side->id }}"
                                   data-name="{{ $side->detail->name }}">
                            <strong class="text-capitalize">{{ $side->applicant_title }} - </strong>
                            {{ $side->detail->name }}
                            <span></span>
                        </label>
                    @endforeach
                @endforeach
            </div>
            <div class="col-md-6">
                <div class="kt-heading kt-heading--md">Diğer Taraf</div>
                @foreach ($lawsuit->sides->where("side_type_id", SideTypeOptions::DEFENDANT) as $defendant)
                    <div class="form-group">
                        <div class="kt-checkbox-list">
                            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                                <input type="checkbox" name="side_ids[]" value="{{ $defendant->id }}"
                                       data-name="{{ $defendant->detail->name }}">
                                {{ $defendant->detail->name }}
                                <span></span>
                            </label>
                        </div>
                    </div>
                    @foreach ($defendant->sub_sides as $index => $side)
                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"
                               id="checkbox-{{ $side->id }}">
                            <input type="checkbox" name="side_ids[]" value="{{ $side->id }}"
                                   data-name="{{ $side->detail->name }}"
                                    {{ $defendant->side_applicant_type_id == ApplicantTypeOptions::COMPANY && $index == 0 ? 'checked' : '' }}>
                            {{ $side->applicant_title }} -
                            {{ $side->detail->name  }}
                            <span></span>
                        </label>
                    @endforeach
                @endforeach
                <div>
                </div>
            </div>
        </div>
    </div>
</div>
