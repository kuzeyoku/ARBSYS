<!doctype html>
<html lang="tr">
<head>
    <style>
        .page-header, .page-header-space {
            height: 50px;
            font-family: "Times New Roman";
            font-size: 9pt;
        }

        .page-footer, .page-footer-space {
            height: 50px;
            font-family: "Times New Roman";
            font-size: 9pt;
        }

        .page-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            border-top: 1px solid #b5bbc0;
            text-align: center;
        }

        .page-header {
            position: fixed;
            top: 0;
            width: 100%;
            border-bottom: 1px solid #b5bbc0;
            text-align: center;
        }

        thead {display: table-header-group;}
        tfoot {display: table-footer-group;}

        .page {
            margin-left: 50px;
        }

        body {
            background: rgb(204,204,204);
            font-size: 10pt;
        }

        p.paragraph:first-letter {
            margin-left: 35px;
        }
        table tr td
        {
            vertical-align: top;
            padding: 4px;
            margin: 0;
        }
        table {
            border: none;
            width: 100%;
        }
        .template table tr td:first-child
        {
            font-weight: bold;
            width: 25%;
        }
        .text-left {
            text-align: left;
            float: none;
        }
        .text-right {
            text-align: right;
            float: none;
        }
        .text-center {
            text-align: center;
            float: none;
        }
        .text-justify {
            text-align: justify;
        }
        .sides {
            width: 100%;
        }
        .side {
            margin-bottom: 50px;
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
        .page-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 50px;
        }
        .font-bold {
            font-weight: bold;
        }
        .vertical-top {
            vertical-align: top;
        }
        .line {
            display: block;
        }
        .logo {
            width: auto;
            height: 80%;
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>
<body>
    {!! $document_content !!}
</body>
</html>
