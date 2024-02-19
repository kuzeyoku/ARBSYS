<div class="kt-wizard-v4__nav">
    <div class="kt-wizard-v4__nav-items kt-wizard-v4__nav-items--clickable">
        @foreach ($nav as $key => $value)
            <div class="kt-wizard-v4__nav-item" data-ktwizard-type="step"
                @if ($loop->first) data-ktwizard-state="current" @endif>
                <div class="kt-wizard-v4__nav-body">
                    <div class="kt-wizard-v4__nav-number">
                        {{ $key }}
                    </div>
                    <div class="kt-wizard-v4__nav-label">
                        <div class="kt-wizard-v4__nav-label-title">
                            {{ $value }}
                        </div>
                        <div class="kt-wizard-v4__nav-label-desc">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
