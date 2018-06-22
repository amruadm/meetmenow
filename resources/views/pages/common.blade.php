@extends('main')

@section('title', '| Yesss')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'link code',
        menubar: false
    });
</script>
@section('content')
    <div class="row">
        <div class="col-md-8">
            @foreach($posts as $post)

                <div class="post">
                    <h3>{{ $post->title }}</h3>
                    <p>{!! $post->body !!}</p>
                    @if (Auth::check())
                        <a href="{{ url('posts/'.$post->id) }}" class="btn btn-primary">Редактировать</a>
                    @endif
                </div>

                <hr>

            @endforeach
        </div>

    </div> <!-- end of header .row -->

@stop