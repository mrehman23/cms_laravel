@component('mail::message')
# Dear Concern,

You have received email from Contact from.
@component('mail::table')
| Type       | Description    |
| ------------- |:-------------:|
| Name          | {{$data['name']}}     |
| Email         | {{$data['email']}}    |
| Phone         | {{$data['phone']}}   |
| Message       | {{$data['message']}}  |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
