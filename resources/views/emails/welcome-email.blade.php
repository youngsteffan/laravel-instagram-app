@component('mail::message')
# Introduction

Welcome to Portraitgram

@component('mail::button', ['url' => ''])
I got it!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
