@extends('main')

@section('title', '| Все добавленные места')

@section('content')

<div class="row">
    {!! Form::model($place, ['route' => ['places.update', $place->id], 'method' => 'PUT']) !!}
    <div class="col-md-8">
        {{ Form::label('title', 'Название:') }}
        {{ Form::text('title', null, ["class" => 'form-control input-lg']) }}

        {{--{{ Form::label('category_id', "Категория:", ['class' => 'form-spacing-top']) }}--}}
        {{--{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}      --}}

        {{ Form::label('whatsapp', 'WhatsApp:') }}
        {{ Form::text('whatsapp', null, array('class' => 'form-control', 'maxlength' => '255')) }}

        {{ Form::label('telegram', 'Telegram:') }}
        {{ Form::text('telegram', null, array('class' => 'form-control', 'maxlength' => '255')) }}



        {{ Form::label('description', "Описание:", ['class' => 'form-spacing-top']) }}
        {{ Form::textarea('description', null, ['class' => 'form-control']) }}
    </div>

    <div class="col-md-4">
        <div class="well">
            <dl class="dl-horizontal">
                <dt>Создан:</dt>
                <dd>{{ date("Y-m-d H:i:s", strtotime($place->created_at)) }}</dd>
            </dl>

            <dl class="dl-horizontal">
                <dt>Обновлен:</dt>
                <dd>{{ date('Y-m-d H:i:s', strtotime($place->updated_at)) }}</dd>
            </dl>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('places.index', 'Отменить', array($place->id), array('class' => 'btn btn-danger btn-block')) !!}
                </div>
                <div class="col-sm-6">
                    {{ Form::submit('Сохранить', ['class' => 'btn btn-success btn-block']) }}
                </div>
            </div>

        </div>
    </div>
    {!! Form::close() !!}
</div>	<!-- end of .row (form) -->



@stop