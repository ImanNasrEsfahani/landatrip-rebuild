<table style="margin-top: 80px;">
    <tr>
        <td>
            <p style="margin-top: 20px;font-size: 24px;font-weight: 700;text-align: center;">
                Tours this month
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <table>
                <tr>
                    @forelse($thisMonthTour as $item)
                        <td style="padding: 10px;">
                            <table style="background-color: #EDEAEA;padding: 10px;border-radius: 5%;position: relative;">
                                <tr>
                                    <td>
                                        <img style="width: 250px;object-fit: cover;height: 250px; border-radius: 12px" src="{{Storage::url("/groups/thumbnails/". $item->thumbnailImage->url)}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="font-weight: bold;text-align: center; min-height: 2rem">
                                            {{ $item->title }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table style="margin: auto;">
                                            <tr>
                                                <td style="padding-right: 20px">
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <img src="{{Storage::url("/website/emails/skype_picture.png")}}">
                                                            </td>
                                                            <td style="color:#FF8C00;font-weight: 500;font-size:12px">
                                                                {{ $item->capacity }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="padding-left: 20px">
                                                    <table>
                                                        <tr >
                                                            <td>
                                                                <img src="{{Storage::url("/website/emails/calender2.png")}}">
                                                            </td>
                                                            <td style="color:#666;font-weight: 500;font-size:12px">
                                                                {{ Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::create($item->start_date)) }} Days Left
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
                                        <a href="{{ config('app.url')."/tour/".$item->tour->slug }}" style="background-color: #007560;color: #FFFFFF; border-radius: 40px; width: 75%; padding:5px 0;display: block; margin: auto; border: none; text-decoration: none; text-align: center">
                                            More
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    @empty
                    @endforelse
                </tr>
            </table>
        </td>
    </tr>
</table>
