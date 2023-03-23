<x-mail::message>

# {{ $company->name }} has been added to the {{ config('app.name') }} platform.

Easy Company is a neat and tidy way to manage companies and employees. Check it out:

<x-mail::button :url="config('app.url') . '/companies/' . $company->id">
View your profile
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
