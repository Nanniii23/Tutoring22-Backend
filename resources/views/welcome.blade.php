<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<h1>KWM Go Student</h1>
<ul>
    @foreach ($offers as $offer)
        <li>{{$offer->subejct}} {{$offer->description}}</li>
    @endforeach
</ul>
</body>
</html>
