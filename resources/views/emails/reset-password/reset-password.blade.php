@extends('emails.layout.layout-email')

@section('content')
    <table style="margin-top: 10px;padding: 0 30px">
        <tr>
            <td>
                <p>Dear <strong>{{ $user->name }}</strong>,</p>
                <p>
                    We have received a request to reset your password for your account at Landa Trip Platform.
                    If you did not initiate this request, ignore this email.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>To proceed with the password reset, please click on the following Button:</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="text-align: center">
                    <a href="{{ $token }}" target="_blank" style="background-color: #FF8C00; color: #FFFFFF;border-radius: 50px; padding: 10px 50px; text-decoration: none; ">Reset Password</a>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>You will be directed to a secure page where you can set a new password.</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>In case the link does not work, you can copy and paste the URL below into your web browser:</p>
                <p>{{ $token }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>If you require any assistance or have any concerns, please do not hesitate to contact our support team at</p>
                <p style="margin: 3px">Email: Info@landatrip.com</p>
                <p style="margin: 3px">Phone: +98 31 3131 1914</p>
                <p>We're here to help!</p>
            </td>
        </tr>
    </table>
@endsection
