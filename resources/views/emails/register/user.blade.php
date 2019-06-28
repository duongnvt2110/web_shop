@component('mail::message')
# Introduction
This is verification email. Please click on the button below.

@component('mail::button', ['url' => route("register.confirm").'?token='.auth()->user()->confirmation_token])
    Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

