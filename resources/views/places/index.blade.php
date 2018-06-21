@extends('main')

@section('title', '| All Posts')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>Все добавленные места</h1>
        </div>
        <div class="col-md-2">
            <a href="{{ route('places.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Добавить место на карту</a>
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