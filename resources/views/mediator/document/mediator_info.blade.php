<h1 class="title">ARABULUCU</h1>
<p>
    Arb. Av. {{ App\Services\HelperService::nameFormat(auth()->user()->name) }} <br />
    (ADB Sicil No: {{ auth()->user()->mediator->registration_no }})<br />
    {{-- @if (isset($phone) && $phone)
        (ADB Tel: {{ auth()->user()->phone }})
    @endif --}}
</p>
