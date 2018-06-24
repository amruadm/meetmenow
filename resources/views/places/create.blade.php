@extends('main')

@section('title', '| Create New Post')

@section('stylesheets')

    {!! Html::style('css/parsley.css') !!}

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'link code',
            menubar: false
        });
    </script>

@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Добавить место</h1>
            <hr>
            {!! Form::open(array('route' => 'places.store', 'data-parsley-validate' => '')) !!}
            {{ Form::label('title', 'Название:') }}
            {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

            {{--{{ Form::label('category_id', "Категория:", ['class' => 'form-spacing-top']) }}--}}
            {{--{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}      --}}

            {{ Form::label('whatsapp', 'WhatsApp:') }}
            {{ Form::text('whatsapp', null, array('class' => 'form-control', 'maxlength' => '255')) }}

            {{ Form::label('telegram', 'Telegram:') }}
            {{ Form::text('telegram', null, array('class' => 'form-control', 'maxlength' => '255')) }}

            {{ Form::label('description', "Описание:") }}
            {{ Form::textarea('description', null, array('class' => 'form-control')) }}

            {{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
            {!! Form::close() !!}
        </div>
    </div>

@endsection


@section('scripts')

    {!! Html::script('js/parsley.min.js') !!}

@endsection
