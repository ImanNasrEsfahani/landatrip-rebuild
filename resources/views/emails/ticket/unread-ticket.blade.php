@extends('emails.layout.layout-email')

@section('content')
    <table style="margin-top: 10px;padding: 0 30px">
        <tr>
            <td>
                <p>Dear {{ $ticket->user->name }},</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    It appears that there are unread messages on your support ticket {{ $ticket->id }}, and we haven't received any response from you yet. Our support team is eager to assist you and address any concerns or inquiries you may have.
                    Check Your Ticket: Please log in to your account on our platform and navigate to your support ticket section to read the messages from our team.
                </p>
            </td>
        </tr>
    </table>
@endsection
