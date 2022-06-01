<!DOCTYPE html>
<html>
<head>
    <title>KWM GO Student</title>
</head>
<body>
<h1>KWM GO Student</h1>
<ul>
    @foreach ($offers as $offer)
        <li><a href="offers/{{$offer->id}}">
                {{$offer->subject}}</a></li>
    @endforeach
</ul>
</body>
</html>
