@extends('main')

@section('title', '| Все категории')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>Категории</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Название</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($categories as $category)
					<tr>
						<th>{{ $category->id }}</th>
						<td>{{ $category->name }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- end of .col-md-8 -->

		<div class="col-md-3">
			<div class="well">
				{!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
					<h2>Новая категория</h2>
					{{ Form::label('name', 'Название:') }}
					{{ Form::text('name', null, ['class' => 'form-control']) }}

					{{ Form::submit('Создать', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
				
				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection