@extends('emails.layout.layout-email')

@section('content')
    <table style="margin-top: 10px;padding: 0 30px">
        <tr>
            <td>
                <p>Dear <strong>{{ $ticket->user->name }}</strong>,</p>
                <p>A new ticket has been added to your tickets at the Landa Trip platform.</p>
                <p>Ticket Number: <strong>{{ $ticket->id }}</strong></p>
                <p>Title: <strong>{{ $ticket->title }}</strong></p>
                <p>Our team is actively reviewing the details of the ticket and working diligently to address the matter promptly. We will keep you informed about the progress and updates related to this ticket.</p>
            </td>
        </tr>
    </table>
@endsection
