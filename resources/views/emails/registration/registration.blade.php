@extends('emails.layout.layout-email')

@section('content')
    <table style="margin-top: 10px;padding: 0 30px">
        <tr>
            <td>
                <p>
                    <p>Dear {{ $user->fname }},</p>
                    Your registration process has been completed successfully.
                    Thank you for choosing Landa Trip for experiencing our amazing educational tours.
                </p>
            </td>
        </tr>
    </table>
@endsection
