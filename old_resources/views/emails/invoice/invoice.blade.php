@extends('emails.layout.layout-email')

@section('content')
    <table style="margin-top: 10px;padding: 0 30px">
        <tr>
            <td style="color: #666;font-weight: 700;margin-bottom: 10px">
                <img src="{{Storage::url("/website/emails/calendar.png")}}">
                Jun/12
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    Dear {{ $invoice->user->name }},
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    We hope you had an amazing time on our recent Landa Trip tour . We would like to appreciate you for choosing us to be a part of your memorable journey.
                    According to your request, we are pleased to provide you with the details of the tour costs and the invoice for your records:
                </p>
            </td>
        </tr>
        <tr>
            <td>
                Tour: [Tour Name]
            </td>
        </tr>
        <tr>
            <td>
                Tour Date: [Tour Date]
            </td>
        </tr>
        <tr>
            <td>
                Total Cost: [Total Amount]
            </td>
        </tr>
        <tr>
            <td>
                Payment Details:
            </td>
        </tr>
        <tr>
            <td>
                Invoice Number: [Invoice Number]
            </td>
        </tr>
        <tr>
            <td>
                Issue Date: [Issue Date]
            </td>
        </tr>
        <tr>
            <td>
                Due Date: [Due Date]
            </td>
        </tr>
        <tr>
            <td>
                Payment Method: [Payment Method]
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
