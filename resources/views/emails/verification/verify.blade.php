@extends('emails.layout.layout-email')

@section('content')
    <table style="margin-top: 10px;padding: 0 30px">
        <tr>
            <td>
                <p>Dear <strong>{{ $name }}</strong>,</p>
                <p>
                    Thank you for signing up at Landa Trip. To ensure the security of your account and complete the registration process, we kindly ask you to verify your email address.
                </p>
                <p>Use this code to finish setting up this verify email:</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="text-align: center; margin-bottom: 10px; font-size: larger;">
                    {{ $verification_code }}
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    This code will expire in 3 hours.
                </p>
                <p>
                    Once your email address is verified, you will gain full access to your account and all its features. Ignore this email if you don’t create an account!
                </p>
                <p style="margin: 0px">
                    Thank you for choosing the Landa Trip platform. We look forward to serving you.
                </p>
            </td>



        </tr>
    </table>
@endsection

