<html>
<title>SoundBook</title>
<body>
<div>
    <p>
    {{$song->title}}</p>
    <p>{{$song->artist}}</p>
</div>
<div>
    <h1>Comentarios</h1>
    @foreach ($comments as $c)
        <p>{{$c->comment}}-----likes {{$c->likes}}</p>
    @endforeach


</div>

</body>
</html>