@extends('main')

@section('title', '| Контактная информация')

@section('content')
    <div class="row">
        <div class="col-md-12">
            MeetMe.
            Пока мы небольшая команда из 5 человек.
            Напишите нам!
            <form action="{{ url('contact') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label name="email">Email:</label>
                    <input id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label name="subject">Тема:</label>
                    <input id="subject" name="subject" class="form-control">
                </div>
                <div class="form-group">
                    <label name="message">Сообщение:</label>
                    <textarea id="message" name="message" class="form-control" placeholder="Напишите здесь ваше сообщение...">

                    </textarea>
                </div>
                <input type="submit" value="Послать сообщение" class="btn btn-success">
            </form>
        </div>
    </div>
@endsection