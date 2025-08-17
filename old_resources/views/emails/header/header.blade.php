<table>
    <tr>
        <td>
            <table style="width: 100%;">
                <tr>
                    <td>
                        <img style="width: 50%" src="{{Storage::url("/website/emails/LandaTrip.png")}}">
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <p style="font-weight: 500;font-size: 13px;margin: 1px 0;">Education and Trip beyond
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-weight: 500;font-size: 13px;margin: 1px 0;">the borders with the best
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <img style="width: 100%" src="{{Storage::url("/website/emails/email-header.png")}}">
        </td>
    </tr>
    <tr>
        <td>
            <table>
                <tr>
                    <td>
                        <img src="{{Storage::url("/website/emails/calendar.svg")}}">
                    </td>
                    <td>
                        <p>{{Carbon\Carbon::now()->toDateTimeString()}}</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
