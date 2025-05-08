@extends('mail.message')

@section('body')
    <tr>
        <td style="padding: 25px;">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td align="center"
                        style="color: #132747; font-family: Arial, sans-serif; font-size: 18px; font-weight: 700; line-height: 24px;">
                        Новая заявка: {{ $title }}
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        @component('mail::button', ['url' => $link])
                            Перейти к заявке
                        @endcomponent
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection
