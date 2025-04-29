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
                                    Код подтверждения: {!! html_entity_decode($code) !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 0; line-height: 0;" height="16">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #4e5d75;">
                                    Используйте этот код для завершения входа в систему.
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 0; line-height: 0;" height="16">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #4e5d75;">
                                    Срок действия: {!! html_entity_decode($expireMinutes) !!} минут
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection
