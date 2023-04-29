@component('mail::message')
# Dear Concern,

You have received email from Contact from.
@component('mail::table')
| Type       | Description    |
| ------------- |:-------------:|
| Name          | {{$data['name']}}     |
| Address       | {{$data['address']}}  |
| Phone         | {{$data['phone']}}    |
| Email         | {{$data['email']}}    |
| Message       | {{$data['message']}}  |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
