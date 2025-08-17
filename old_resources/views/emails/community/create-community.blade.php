@extends('emails.layout.layout-email')

@section('content')
    <table style="margin-top: 10px;padding: 0 30px">
        <tr>
            <td style="color: #666;font-weight: 700;margin-bottom: 10px">
                <img src="{{Storage::url("/email/calendar.png")}}">
                Jun/12
            </td>
        </tr>
        <tr>
            <td style="font-weight: bold;color: #403F3F;font-size: 20px;">
                <p>
                    Community Email:
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    Your verification code is …
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    We can’t give you access until we make sure the email belongs to you.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <a href="#" style="color:black;text-decoration: none;">
                    Click here to confirm your account.
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    Ignore this email if you don’t create an account!
                </p>
            </td>
        </tr>
    </table>
    {{--    {{ $contact->name }}--}}
    {{--    {{ $contact->department }}--}}
    {{--    {{ $contact->title }}--}}
    {{--    {{ $contact->phone }}--}}
    {{--    {{ $contact->email }}--}}
    {{--    {{ $contact->message }}--}}
@endsection
