@extends('main')

@section('title', '| View place')

@section('content')

    {!! $data !!}
    <div class="row">
        <div class="col-md-8">
            <h1 class="title">{{ $place->title }}</h1>
            <p class="lead">{!! $place->description !!}</p>
            <p class="lead">{!! $place->whatsapp !!}</p>
            <p class="lead">{!! $place->telegram !!}</p>

        </div>

        <div class="col-md-4">
            <div class="well">
                 {{--<dl class="dl-horizontal">--}}
                    {{--<label>Категория:</label>--}}
                    {{--<p>{{ $place->category->name }}</p>--}}
                {{--</dl>--}}

                <dl class="dl-horizontal">
                    <label>Создан:</label>
                    <p>{{ date('Y-m-d H:i:s', strtotime($place->created_at)) }}</p>
                </dl>

                <dl class="dl-horizontal">
                    <label>Обновлен:</label>
                    <p>{{ date('Y-m-d H:i:s', strtotime($place->updated_at)) }}</p>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('places.edit', 'Редактировать', array($place->id), array('class' => 'btn btn-primary btn-block')) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['route' => ['places.destroy', $place->id], 'method' => 'DELETE']) !!}

                        {!! Form::submit('Удалить', ['class' => 'btn btn-danger btn-block']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{ Html::linkRoute('places.index', 'Посмотреть все места', array(), ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
@endsection