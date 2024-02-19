@extends('layouts.app')
@section('title', 'Главная')
@section('content')
	<h1>Модели</h1>
	<table class="table table-striped table-borderless">
		<thead>
			<tr>
				<th>Название модели</th>
				<th>Описание</th>
				<th>Стоимость</th>
				<th>Автор</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($ads as $ad)
			<tr>
				<th><h4>{{$ad->title}}</h4></th>
				<th>{{$ad->description}}</th>
				<th>{{$ad->price}}</th>
				<th>{{$ad->author}}</th>
					<a href="{{ route('ad-detail', ['ad' => $ad]) }}">Подробнее...</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@endsection('content')