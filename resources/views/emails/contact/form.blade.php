<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>
@component('mail::message')
    # Contact From

    <h1>{{ $name }}</h1>
    <p>email:{{ $from }}</p>
    <p>phone:{{ $phone }}</p>

    {{--    <h2>{{$subject}}</h2>--}}
    <p>{{$messages}}</p><br>

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent

</body>
</html>
