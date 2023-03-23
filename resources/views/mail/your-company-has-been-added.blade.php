<x-mail::message>

<img src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name') }}" width="100" height="100">

# You have been added to the {{ config('app.name') }} platform.

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
