<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Estadisticas de la encuesta</title>
</head>

<body>
    @foreach($statistics as $key => $commune)
    <p>{{$key}}</p>
    <ul>
        <li>Medicina: {{$commune->Medicina}} </li>
        <li>Ingenieria: {{$commune->Ingenieria}} </li>
        <li>Derecho: {{$commune->Derecho}} </li>
        <li>Licenciatura: {{$commune->Licenciatura}} </li>
    </ul>
    @endforeach
</body>

</html>