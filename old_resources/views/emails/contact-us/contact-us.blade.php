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
            <td>
                <p>
                    Thank you so much for taking the time to share your invaluable suggestions with us! We really appreciate your input and want you to know that we will prioritize your comments and requests. You can rest assured that we will follow up on them as soon as possible. Your contribution is incredibly valuable to us and will definitely help us improve our services.                 </p>
            </td>
        </tr>
    </table>
@endsection
