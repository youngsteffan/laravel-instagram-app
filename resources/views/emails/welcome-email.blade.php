@component('mail::message')
# Hi, {{ $user->name }}


Welcome to {{ config('app.name', 'Laravel') }}

@component('mail::button', ['url' => 'http://laravel-instagram/profile/' . $user->profile->id])
Go to profile
@endcomponent

Thanks for using our web-service,<br>
{{ config('app.name') }} team
@endcomponent
