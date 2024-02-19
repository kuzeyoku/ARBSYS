<!doctype html>
<html lang="en">

<head>
    <style>
        @page {
            header: page-header;
            footer: page-footer;
        }

        body {
            text-align: justify;
        }

        header {
            position: fixed;
            top: 0px;
            left: 0px;
            right: 0px;
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #000;
        }
    

        footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            text-align: center;
            padding-top: 10px;
            border-top: 1px solid #000;
        }

        .text-center {
            text-align: center;
            float: none;
        }

        .left {
            width: 50%;
            text-align: center;
        }

        .right {
            width: 50%;
            text-align: center;
        }

        .title {
            text-decoration: underline;
            margin-bottom: 10px;
            font-size: 10pt;
        }

        .logo {
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>

<body>
    <htmlpageheader name="page-header">
        <header><img src="{{ asset('assets/media/logos/logo-c.png') }}" alt="" height="50"></header>
    </htmlpageheader>
    <htmlpagefooter name="page-footer">
        <footer>{{ auth()->user()->email . '-' . auth()->user()->phone }}<br>{{ auth()->user()->address }}</footer>
    </htmlpagefooter>
    {!! $document_content !!}
</body>

</html>
