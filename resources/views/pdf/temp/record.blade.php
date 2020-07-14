<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temparature Record {{today()}}</title>
</head>
<style>
    /* @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap'); */

    :root {
        --primary-color: #f5826e;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Roboto', sans-serif;
        letter-spacing: 0.5px;
    }

    body {
        background-color: var(--primary-color);
    }

    .invoice-card {
        display: flex;
        flex-direction: column;
        position: absolute;
        padding: 10px 2em;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        min-height: 25em;
        width: 22em;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 10px 30px 5px rgba(0, 0, 0, 0.15);
    }

    .invoice-card>div {
        margin: 5px 0;
    }

    .invoice-title {
        flex: 3;
    }

    .invoice-title #date {
        display: block;
        margin: 8px 0;
        font-size: 12px;
    }

    .invoice-title #main-title {
        display: flex;
        justify-content: space-between;
        margin-top: 2em;
    }

    .invoice-title #main-title h4 {
        letter-spacing: 2.5px;
    }

    .invoice-title span {
        color: rgba(0, 0, 0, 0.4);
    }

    .invoice-details {
        flex: 1;
        border-top: 0.5px dashed grey;
        border-bottom: 0.5px dashed grey;
        display: flex;
        align-items: center;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
    }

    .invoice-table thead tr td {
        font-size: 12px;
        letter-spacing: 1px;
        color: grey;
        padding: 8px 0;
    }

    .invoice-table thead tr td:nth-last-child(1),
    .row-data td:nth-last-child(1),
    .calc-row td:nth-last-child(1) {
        text-align: right;
    }

    .invoice-table tbody tr td {
        padding: 8px 0;
        letter-spacing: 0;
    }

    .invoice-table .row-data #unit {
        text-align: center;
    }

    .invoice-table .row-data span {
        font-size: 13px;
        color: rgba(0, 0, 0, 0.6);
    }

    .invoice-footer {
        flex: 1;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .invoice-footer #later {
        margin-right: 5px;
    }

    .btn {
        border: none;
        padding: 5px 0px;
        background: none;
        cursor: pointer;
        letter-spacing: 1px;
        outline: none;
    }

    .btn.btn-secondary {
        color: rgba(0, 0, 0, 0.3);
    }

    .btn.btn-primary {
        color: var(--primary-color);
    }

    .btn#later {
        margin-right: 2em;
    }
</style>

<body>
    <div>


        <table
            style='border-top: 2px solid #0280BB; font-family: Arial; border-collapse: collapse; margin: 50px 50px 0 50px;'
            width=600>
            <tr>
                <td width=412></td>
                <td width=138
                    style='background: #0280BB; color: #fff; text-align: center; font-size: 14px; height: 30px;'>
                    {{date('d M, Y')}}</td>
            </tr>
        </table>

        <table style='font-family: Arial; border-collapse: collapse; color: #505050;margin: 0 50px 0 50px;' width=600>
            <tr>
                <td style='text-align: left; padding-right: 10px;  padding-bottom: 10px;  width:350px'>
                    <b>{{auth()->user()->name}}<b /></td>
            </tr>
            <tr>
                <td style='text-align: left; padding-right: 10px;'><b>Room:</b>
                    {{$room}}
                </td>
            </tr>
        </table>

        <table style='font-family: Arial; margin: 20px 50px 0 50px;' width=600 cellpadding="0" cellspacing="0"
            border="0">
            <thead>
                <tr>
                    <th
                        style='height: 30px; color: #fff; background: #074695; font-size: 14px; border: 1px solid #fff;'>
                        No</th>
                    <th
                        style='height: 30px; color: #fff; background: #074695; font-size: 14px; border: 1px solid #fff;'>
                        Name</th>
                    <th
                        style='height: 30px; color: #fff; background: #074695; font-size: 14px; border: 1px solid #fff;'>
                        Id/PIN</th>
                    <th
                        style='height: 30px; color: #fff; background: #074695; font-size: 14px; border: 1px solid #fff;'>
                        Morning</th>
                    <th
                        style='height: 30px; color: #fff; background: #074695; font-size: 14px; border: 1px solid #fff;'>
                        Evenning</th>

                </tr>
            </thead>
            <tbody style='font-size: 12px; text-align: center;'>
                @foreach($records as $key => $person)
                <tr
                    style='background: {{($person->morning > 37.3) || ($person->evenning > 37.3) ? '#ff9992' : '#fff' }}; height: 40px; '>
                    <td style='border-bottom: 1px solid #bbb;'>{{ $key+1 }}</td>
                    <td style='border-bottom: 1px solid #bbb;'>{{ Str::limit($person->people->name, 32) }}</td>
                    <td style='border-bottom: 1px solid #bbb;'>{{ $person->people->indentity }}</td>
                    <td style='border-bottom: 1px solid #bbb;'>{{ $person->morning }}</td>
                    <td style='border-bottom: 1px solid #bbb;'>{{ $person->evenning }}</td>
                </tr>
                @endforeach
                {{-- <tr style='background: #fff; height: 30px;'>
                    <td colspan=4>&nbsp;</td>
                    <td style='border: 1px solid #fff; background: #0080c4; color: #fff; border: 1px solid #fff;'>
                        <b>TOTAL:</b></td>
                    <td style='background: #daecf6; color: #0080c4; border: 1px solid #fff;'><b>R$ 135,99</b></td>
                </tr> --}}
            </tbody>
        </table>
    </div>
</body>

</html>