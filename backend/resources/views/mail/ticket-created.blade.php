@extends('mail.message')

@section('body')
    <tr>
        <td style="padding: 25px;">
            <table cellpadding="0" cellspacing="0" width="100%" style="text-align: center;">
                <tr>
                    <td align="center"
                        style="color: #132747; font-family: Arial, sans-serif; font-size: 18px; font-weight: 700; line-height: 24px;">
                        Новая заявка: {{ $title }}
                    </td>
                </tr>
                <tr>
                    <td style="color: #047857;">
                        <a href="{{ $link }}" style=" display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #047857;
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
@endsection
