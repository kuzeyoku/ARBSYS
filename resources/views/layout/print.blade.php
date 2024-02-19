@if (auth()->user()->mediator->letter_option_id == LetterOptions::CUSTOM)
    <div class="page-header" identifier="page-header"
        style="display: flex; flex-direction: row; background-color: #1a9ff1;">
        <img class="logo" width="200" height="50" src="{{ auth()->user()->mediator->logo }}"
            id="{{ auth()->user()->mediator->path_logo }}-200-50" style="margin-left: 50px; margin-top: 9px;">
        <p style="margin-right: 50px; color: #f1f1f1;">{{ auth()->user()->mediator->letter_top }}</p>
    </div>
    <div class="page-footer" identifier="page-footer" style="background-color: #00aff0;">
        <p style="color: #f1f1f1;">{!! auth()->user()->mediator->letter_bottom !!}</p>
    </div>
@elseif(auth()->user()->mediator->letter_option_id == LetterOptions::STANDARD)
    <div class="page-header" identifier="page-header">
        <p style="font-family:Times New Roman;font-style: italic;font-size:16pt;">Arb. Av. {{ auth()->user()->name }}
        </p>
    </div>
    <div class="page-footer" identifier="page-footer">
        <p>
            {{ auth()->user()->address }}<br>
            Tel: {{ auth()->user()->phone }} E-Posta: {{ auth()->user()->email }}
        </p>
    </div>
@endif
<table>
    <thead>
        <tr>
            <td>
                <div class="page-header-space" identifier="page-header-space"></div>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <div class="page" identifier="page">
                    @yield('content')
                </div>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>
                <div class="page-footer-space" identifier="page-footer-space2"></div>
            </td>
        </tr>
    </tfoot>
</table>
