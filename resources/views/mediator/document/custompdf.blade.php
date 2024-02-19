<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <style>
        /* Styles go here */
        .page-header,
        .page-header-space {
            height: 50px;
            font-family: "Times New Roman";
            font-size: 9pt;
        }

        .page-footer,
        .page-footer-space {
            height: 30px;
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

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }

        .page {
            margin-left: 40px;
            margin-top: 20px;
        }

        body {
            font-family: "CustomArial";
            font-size: 10pt;
        }

        .print_side {
            display: block;
        }

        table tr td {
            vertical-align: top;
            padding: 4px;
            margin: 0;
        }

        table {
            border: none;
            width: 100%;
        }

        .template table tr td:first-child {
            font-weight: bold;
            /* width: 25%; */
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
            text-justify: inter-word;
            margin-right: 10px;
        }

        .sides {
            width: 100%;
        }

        .side {
            /* margin-bottom: 50px; */
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
            /* margin-top: 100px; */
            /* margin-bottom: 25px; */
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
            margin: 0 auto;
            text-align: center;
        }

        .paragraph:before {
            content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0";
        }

        * {
            background: white;
            font-family: DejaVu Sans;
             !important;
            font-size: 9pt;
        }

        header {
            position: fixed;
            top: 0;
            text-align: center;
            border-bottom: 1px solid #b5bbc0;
            z-index: 15;
        }

        footer {
            position: fixed;
            bottom: 20px;
            border-top: 1px solid #b5bbc0;
            text-align: center;
            z-index: 15;

        }
    </style>
</head>

<body>
    <?php 
        echo $document_content;
    ?>
</body>

</html>