@extends('layouts.app')
@section('title', 'Редактор объявления')
@section('content')
<a href="{{ route('ad-create')}}">Создать модель</a>
<table class="table table-striped table-borderless">
	<thead>
		<tr>
			<th>Название модели</th>
			<th>Стоимость</th>
			<th>Автор</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($ads as $ad)
		<tr>
			<th><h4>{{$ad->title}}</h4></th>
			<th>{{$ad->price}}</th>
			<th>{{$ad->user->name}}</th>
			<td>
				<a href="{{ route('ad-edit', ['ad' => $ad]) }}">Редактировать</a>
			</td>
			<td>
				<form action="{{ route('ad-delete', ['ad' => $ad]) }}" method="post">
					@csrf
					@method('DELETE')
					<input type="submit" value="Удалить">
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
{{ $ads->links('pagination::bootstrap-4') }}
@endsection('content')