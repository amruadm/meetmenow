@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        <strong>Успех:</strong> {{ Session::get('success') }}
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <strong>Ошибки:</strong>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif