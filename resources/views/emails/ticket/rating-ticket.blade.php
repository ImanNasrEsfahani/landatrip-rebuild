@extends('emails.layout.layout-email')

@section('content')
    <table style="margin-top: 10px;padding: 0 30px">
        <tr>
            <td>
                <p>Ticket Closed Due to Inactivity.</p>
                <p>Dear <strong>{{ $ticket->user->name }}</strong>,</p>
                <p>
                    We have not received any response from you regarding Ticket: <strong>{{ $ticket->title }}</strong>.
                    Due to the lack of communication, we assume that your issue has been resolved, and the admin has
                    closed the ticket.
                    Now you can rate the admin’s function at your personal panel.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    If you still require assistance or have any other questions, feel free to contact us at <a href="mailto:info@landatrip.com">Info@landatrip.com</a> or <a href="tel:+98 31 3131 1914">+98 31 3131 1914</a>.
                </p>
            </td>
        </tr>
    </table>
@endsection
