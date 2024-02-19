@extends('layouts.app')

@section('title', 'Панель администратора')

@section('content')
<div class='row justify-content-center'>
	<div class='col-3'>
		<a href="{{ route('ad-editor') }}" class="button">Модели</a>
	</div>
</div>
<div class='row justify-content-center'>
	<div class='col-3'>
		<a href="{{ route('review-editor') }}" class="button">Отзывы</a>
	</div>
</div>
@endsection('content')