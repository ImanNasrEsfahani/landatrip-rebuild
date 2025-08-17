@extends('layout.layout')

@section("title", "Contact us")

@section("keywords")
    @switch(app()->getLocale())
        @case("fr")
            <meta name="keywords" content="french">
            @break
        @case("fa")
            <meta name="keywords" content="فارسی">
            @break
        @default
            <meta name="keywords"
                  content="Landa trip contact us, Landa trip email, Landa trip location, Landa trip address, 4140 Parker Rd. Allentown, New Mexico 31134, Landa trip postal code, (406) 555-0120, Info@LandaTrip.com, Landa trip phone, Landa trip phone number, Landa trip fax, 1 888 482 7768, 1 888 Landa trip, Social Media, Landa trip Social Media, Landa trip Introduction, Landa trip office, Landa trip Instagram, Landa trio WhatsApp">
    @endswitch
@endsection


@section('content')
    <script src="https://cdn.jsdelivr.net/npm/lazysizes@5.3.2/lazysizes.min.js" defer></script>
    @includeIf('contact-us.components.header')
    @includeIf('contact-us.components.contact-form')
    @includeIf('contact-us.components.social-medias')

    {{--    @includeIf('contact-us.components.support')--}}
    {{--    @includeIf('contact-us.components.address')--}}
    {{--    @includeIf('contact-us.components.introduction')--}}
    {{--    @includeIf('contact-us.components.help')--}}
@endsection
