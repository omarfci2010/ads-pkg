@component('mail::message')
    Hi {{$user->full_name}}

    Your Next Ad Tomorrow
    Ad Tile: {{$ad->title}}
    Start Date: {{$ad->start_date}}
    {{ config('app.name') }}
@endcomponent
