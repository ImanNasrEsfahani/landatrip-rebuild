@extends('emails.layout.layout-email')

@section('content')
    <table style="margin-top: 10px;padding: 0 30px">
        <tr>
            <td>
                <p>Dear <strong>{{ $user->name }}</strong>,</p>
                @if($user->hasRole('agent'))
                   <p>As a travel agency, you now have access to our exciting benefits and you can expand your market by offering and operating exciting tours around your region to international students.</p>
                @else
                    @if($user->hasrole('teacher'))
                        <p>As a teacher, you now have access to our exciting benefits and you can upload your educational tours on our platform. Students who need to acquire skills in your field of study will register for your exciting tour.</p>
                    @else
                        <p>As a student, you now have access to our exciting benefits, including special discounts, exclusive content, and priority access to new releases and you can explore for your favorite educational tour.</p>
                    @endif
                @endif
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    To get started, simply log in to your account on our website using the credentials you provided during registration. Your membership dashboard awaits you with all the details you need to make the most of your membership.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>If you have any questions or need assistance, don't hesitate to reach out to our support team at</p>
                <p style="margin: 3px">Email: Info@landatrip.com</p>
                <p style="margin: 3px">Phone: +98 31 3131 1914</p>
                <p>We're here to help!</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    Thank you for joining us on this journey, and we look forward to providing you with a fantastic membership experience.
                </p>
            </td>
        </tr>
    </table>
@endsection

