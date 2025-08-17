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
                    Tomorrow is the day of your educational Trip:
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    Dear <strong>{{ $user->name }}</strong>,
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    <strong>Tour Details:</strong>
                </p>
                <p>
                    Tour Name: {{ $group->tour->title }}
                    Date: {{ $group->start_date }}
                    Meeting Time: [Meeting Time]
                    Meeting Point: {{ $group->starting_location }}
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    We want to ensure that you have an enjoyable experience throughout the tour. Please make sure to bring any necessary personal items, such as comfortable clothing, water bottle, and any specific items mentioned in the tour description.
                    If you have any last-minute questions or need further assistance, feel free to reach out to us at [contact information]. Our team will be more than happy to assist you.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Get ready for an amazing adventure!</p>
                <p>See you tomorrow!</p>
            </td>
        </tr>
    </table>
@endsection
