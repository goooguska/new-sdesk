@extends('mail.message')

@section('body')
    <tr>
        <td style="padding: 25px;">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td align="center"
                        style="color: #132747; font-family: Arial, sans-serif; font-size: 18px; font-weight: 700; line-height: 24px;">
                        {{ $title }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 0; line-height: 0;" height="16">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table cellpadding="0" cellspacing="0" width="100%"
                               style="max-width: 448px;  font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; text-align: center;">
                            <tr>
                                <td style="color: #4e5d75;">
                                    У вашей заявки: {{ $ticket }}
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #4e5d75;">
                                    обновлен статус на:
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 0; line-height: 0;" height="16">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #4e5d75; font-size: 16px; font-weight: 700;">
                                    {{ $status }}
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #047857;">
                                    <a href="{{ $link }}" style=" display: inline-block; margin-top: 20px; padding: 10px 20px;
                                            background-color: #047857;
                                            color: #ffffff;
                                            text-decoration: none;
                                            border-radius: 4px;
                                            font-weight: bold;
                                        ">
                                        Перейти к заявке
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection
