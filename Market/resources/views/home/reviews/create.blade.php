@extends('layouts.app')

@section('title', 'Добавление отзыва')

@section('content')
<form action="{{ route('reviews.create.method') }}" method="POST">
	@csrf
	<div class="mb-3">
		<label for="txtTitle" class="form-label">Название</label>
		<input name="title" id="txtTitle" class="form-control">
	</div>
	<div class="mb-3">
		<label for="txtText" class="form-label">Текст</label>
		<textarea name="text" id="txtText" class="form-control" row="3"></textarea>
	</div>
	<div class="mb-3">
		<input type="checkbox" name="is_recommended" id="txtRecommended" checked class="form-check-input"/>
		<label for="txtRecommended" class="form-check-label">Рекомендуется</label>
	</div>
	<div class="mb-3">
		<label for="txtRate" class="form-label">Оценка</label>
	</div>
	<div class="mb-3">
		<input class="form-check-input" type="radio" name="rate" id="rate" checked value="5">
		<label class="form-check-label" for="rate">
			5
		</label>
	</div>
	<div class="mb-3">
		<input class="form-check-input" type="radio" name="rate" id="rate" value="4">
		<label class="form-check-label" for="rate">
			4
		</label>
	</div>
	<div class="mb-3">
		<input class="form-check-input" type="radio" name="rate" id="rate" value="3">
		<label class="form-check-label" for="rate">
			3
		</label>
	</div>
	<div class="mb-3">
		<input class="form-check-input" type="radio" name="rate" id="rate" value="2">
		<label class="form-check-label" for="rate">
			2
		</label>
	</div>
	<div class="mb-3">
		<input class="form-check-input" type="radio" name="rate" id="rate" value="1">
		<label class="form-check-label" for="rate">
			1
		</label>
	</div>
	<input type="submit" class="btn btn-primary" value="Добавить">
</form>
@endsection('content')