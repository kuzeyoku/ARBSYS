@php
    use Illuminate\Support\Facades\DB;
    $php = Blade::compileString(
        DB::table('documents_template_html')
            ->where('id', '=', 16)
            ->get()[0]->html,
    );
    echo eval(
    ' @endphp' .
        $php .
        '
@php'
    );
@endphp
