@extends('main')

@section('title', '| Все добавленные места')

@section('content')


<body>

<div class="container">
    <h2>Dropdowns</h2>
    <p>The .dropdown class is used to indicate a dropdown menu.</p>
    <p>Use the .dropdown-menu class to actually build the dropdown menu.</p>
    <p>To open the dropdown menu, use a button or a link with a class of .dropdown-toggle and data-toggle="dropdown".</p>
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
            <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a href="#">HTML</a></li>
            <li><a href="#">CSS</a></li>
            <li><a href="#">JavaScript</a></li>
        </ul>
    </div>
</div>

</body>

    <div class="row">
        <div class="col-md-10">
            <h1>Все добавленные места</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ route('places.create') }}" class="btn btn-primary">Добавить место</a>
        </div>
        <div class="com-md-2">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <th>id</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Дата создания</th>
                <th></th>
                </thead>
                <tbody>
                @foreach($places as $place)
                    <tr>
                        <th>{{$place->id}}</th>
                        <td>{{$place->title}}</td>
                        <td>{{substr($place->description, 0, 50)}}{{strlen($place->description) > 50 ? "..." : ""}}</td>
                        <td>{{date("Y-m-d H:i:s", strtotime($place->created_at))}}</td>
                        <td><a href="{{route('places.show', $place->id)}}" class="btn btn-default btn-sm">Посмотреть</a><a href="{{route('places.edit', $place->id)}}" class="btn btn-default btn-sm" >Редактировать</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@stop